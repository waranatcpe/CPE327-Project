docker-compose up -d
cd src
curl http://61.7.166.36/~app/env.txt > .env
docker exec php chown -R laravel:laravel /var/www/html