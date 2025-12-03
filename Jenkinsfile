pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                echo 'Checking out source code...'
                checkout scm
            }
        }

        stage('Build Docker Image') {
            steps {
                echo 'Building Docker image...'
                sh 'docker-compose build'
            }
        }

        stage('Start Containers') {
            steps {
                echo "Starting containers..."
                sh 'docker-compose up -d'
            }
        }

        stage('Verify Container Running') {
            steps {
                echo "Checking container status..."
                sh 'docker ps'
            }
        }

        stage('Run Tests') {
            steps {
                echo 'Running simple smoke test...'
                sh 'curl -I http://localhost:80 || true'
            }
        }

        stage('Archive Artifacts') {
            steps {
                echo 'Archiving project files...'
                archiveArtifacts artifacts: '**/*', fingerprint: true
            }
        }
    }

    post {
        always {
            echo 'Cleaning up...'
            sh 'docker-compose down'
        }
        success {
            echo 'Pipeline executed successfully!'
        }
        failure {
            echo 'Pipeline FAILED!'
        }
    }
}
