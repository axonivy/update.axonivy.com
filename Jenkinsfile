pipeline {
  agent {
    dockerfile {
      dir 'docker/apache'    
    }
  }
  triggers {
    cron '@midnight'
  }
  options {
    buildDiscarder(logRotator(artifactNumToKeepStr: '10'))
  }
  stages {
    stage('distribution') {
      steps {
      	sh 'composer install --no-dev'
        sh 'tar -cf ivy-website-update-.tar src vendor'
        archiveArtifacts 'ivy-website-update-.tar'
      }
    }
    
    stage('test') {
      steps {
      	sh 'composer install'
		// How to run also integration test, i need a mysql container for that ...
        sh './vendor/bin/phpunit --testsuite unit --log-junit phpunit-junit.xml || exit 0'
      }
      post {
        always {
          junit 'phpunit-junit.xml'
        }
      }
    }
    
    stage('deploy') {
      when {
        branch 'master'
        expression {
          currentBuild.result == null || currentBuild.result == 'SUCCESS' 
        }
      }
      steps {
        sshagent(['3015bfe2-5718-4bd4-9da0-6a5f0169cbfc']) {
          script {
          	def targetFile = "ivy-website-update-" + new Date().format("yyyy-MM-dd_HH-mm-ss-SSS");
            def targetFilename =  targetFile + ".tar"
            
            // transfer and untar
            sh "scp -o StrictHostKeyChecking=no ivy-website-update.tar axonivya@217.26.51.247:/home/axonivya/deployment/$targetFilename"
            sh "ssh -o StrictHostKeyChecking=no axonivya@217.26.51.247 mkdir /home/axonivya/deployment/$targetFile"
            sh "ssh -o StrictHostKeyChecking=no axonivya@217.26.51.247 tar -xf /home/axonivya/deployment/$targetFilename -C /home/axonivya/deployment/$targetFile"
            sh "ssh -o StrictHostKeyChecking=no axonivya@217.26.51.247 rm -f /home/axonivya/deployment/$targetFilename"
            
            // create symlinks
            sh "ssh -o StrictHostKeyChecking=no axonivya@217.26.51.247 ln -fns /home/axonivya/deployment/$targetFile/src/web /home/axonivya/www/update.axonivy.com/linktoweb"
          }
        }
      }
    }    
  }
}