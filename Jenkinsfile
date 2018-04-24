pipeline {
  agent {
    docker {
      image 'php'
    }

  }
  stages {
    stage('install') {
      steps {
        sh 'pwd; php --version'
      }
    }
  }
}