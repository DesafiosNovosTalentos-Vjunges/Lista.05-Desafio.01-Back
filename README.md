# Lista.05-Desafio.01-Back
/*
    cp .env.example .env
    ./vendor/bin/sail up -d
    ./vendor/bin/sail down -v
    ./vendor/bin/sail artisan queue:work
    ./vendor/bin/sail artisan migrate
    ./vendor/bin/sail artisan key:generate
    ./vendor/bin/sail artisan notifications:retry-failed

    Docker:
        docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs

    Teste:
        http://localhost:8000/api/register  POST
        {
        "name": "Vinícius",
        "email": "vinicius.junges@aluno.senai.br",
        "password": "123456789",
        "password_confirmation": "123456789"
        }

        http://localhost:8000/api/login     POST
        {
        "email": "vinicius.junges@aluno.senai.br",
        "password": "123456789"
        }

        http://localhost:8000/api/orders    POST
        {
        "product_name": "...",
        "amount": ...
        }
*/