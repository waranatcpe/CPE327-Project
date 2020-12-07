docker-compose up -d
cd src
mv envfile ./src/.env
docker exec php chown -R laravel:laravel /var/www/html
