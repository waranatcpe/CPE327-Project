docker-compose up -d
cp ./envfile ./src/.env
docker exec php chown -R laravel:laravel /var/www/html
