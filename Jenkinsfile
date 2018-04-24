pipeline {
  agent {
    docker {
      image 'php'
      args '--version'
    }

  }
  stages {
    stage('install') {
      steps {
        sh 'pwd'
      }
    }
  }
}