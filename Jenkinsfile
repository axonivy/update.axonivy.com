pipeline {
  agent any

  triggers {
    cron 'H 22 * * *'
  }

  options {
    buildDiscarder(logRotator(numToKeepStr: '30', artifactNumToKeepStr: '10'))
    skipStagesAfterUnstable()
  }

  environment {
    DIST_FILE = "ivy-website-update.tar"
  }

  stages {
    stage('build') {
      steps {
        script {
          docker.build('db', '-f docker/mariadb/Dockerfile docker/mariadb').withRun() { dbContainer ->
            waitUntilDbIsReady(dbContainer.id)
            docker.build('apache', '-f docker/apache/Dockerfile docker/apache').inside("--link ${dbContainer.id}:db") {
              sh 'composer install --no-dev --no-progress'
              sh "tar -cf ${env.DIST_FILE} src vendor"
              archiveArtifacts env.DIST_FILE
              stash name: 'website-tar', includes: env.DIST_FILE
      
              sh 'composer install --no-progress'
              sh './vendor/bin/phpunit --log-junit phpunit-junit.xml || exit 0'
              junit 'phpunit-junit.xml'

              script {
                if (env.BRANCH_NAME == 'master') {
                  sh 'composer require --dev cyclonedx/cyclonedx-php-composer --no-progress'
                  sh 'composer CycloneDX:make-sbom --output-format=JSON --output-file=bom.json'
                  uploadBOM(projectName: 'update.axonivy.com', projectVersion: 'master', bomFile: 'bom.json')
                }
              }
            }
          }          
        }
      }
    }

    stage('deploy') {
      when {
        branch 'master'
      }
      agent {
        docker {
          image 'axonivy/build-container:ssh-client-1'
        }
      }
      steps {
        sshagent(['zugprojenkins-ssh']) {
          script {
            unstash 'website-tar'
                
            def targetFolder = "/home/axonivya/deployment/ivy-website-update-" + new Date().format("yyyy-MM-dd_HH-mm-ss-SSS");
            def targetFile =  targetFolder + ".tar"
            def host = 'axonivya@217.26.51.247'

            // copy
            sh "scp ivy-website-update.tar  $host:$targetFile"

            // untar
            sh "ssh $host mkdir $targetFolder"
            sh "ssh $host tar -xf $targetFile -C $targetFolder"
            sh "ssh $host rm -f $targetFile"

            // symlink
            sh "ssh $host ln -fns $targetFolder/src/web /home/axonivya/www/update.axonivy.com/linktoweb"
          }
        }
      }
    }
  }
}

def waitUntilDbIsReady(def containerId) {
  timeout(5) {
    waitUntil {
       script {
         try {
          sh "docker exec ${containerId} mysqladmin -u update -p1234 ping --host=localhost --port=3306 --silent"
          return true
         } catch (Exception e) {
          return false
         }
       }
    }
  }
}
