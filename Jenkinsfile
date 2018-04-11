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
        sh 'tar -cf update-website.tar src vendor'
        archiveArtifacts 'update-website.tar'
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
  }
}