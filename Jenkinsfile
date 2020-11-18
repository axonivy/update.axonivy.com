pipeline {
  agent any

  triggers {
    cron '@midnight'
  }

  options {
    buildDiscarder(logRotator(artifactNumToKeepStr: '10'))
    skipStagesAfterUnstable()
  }

  environment {
    DIST_FILE = "ivy-website-update.tar"
  }

  stages {
    stage('build') {
      steps {
        script {
          docker.withRegistry('', 'docker.io') {
            docker.build('mysql', '-f docker/mysql/Dockerfile docker/mysql').withRun() { mysqlContainer ->
              docker.build('apache', '-f docker/apache/Dockerfile docker/apache').inside("--link ${mysqlContainer.id}:db") {
                sh 'composer install --no-dev --no-progress'
                sh "tar -cf ${env.DIST_FILE} src vendor"
                archiveArtifacts env.DIST_FILE
                stash name: 'website-tar', includes: env.DIST_FILE
      
                sh 'composer install --no-progress'
                sh './vendor/bin/phpunit --log-junit phpunit-junit.xml || exit 0'
                junit 'phpunit-junit.xml'
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
          image 'axonivy/build-container:ssh-client-1.0'
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
