# How to install
- We suppose you have DOCKER installed.

1) RUN docker run -it -v $(pwd):/app -w /app composer:latest bash -c "cp .env.example .env && composer install && php artisan key:generate"
1) RUN docker-compose up -d
1) RUN docker exec -it technical_test_app_1 bash -c "php artisan migrate:fresh --seed"
1) ACCESS http://localhost:8000/ (app)
1) ACCESS http://localhost:8001/ (phpMyAdmin) (user: test, pass: test)
