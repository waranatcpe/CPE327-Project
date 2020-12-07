docker-compose up -d
cp ./env-example ./src/.env
docker exec php chown -R laravel:laravel /var/www/html
