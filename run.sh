#!/bin/bash

echo Uploading Application container
docker-compose up -d

echo Copying the configuration example file
docker exec -it laravel-course-app cp .env.example .env

echo Install dependencies
docker exec -it laravel-course-app composer install

echo Generate key
docker exec -it laravel-course-app php artisan key:generate

echo Make migrations
docker exec -it laravel-course-app php artisan migrate

echo Make seeds
docker exec -it laravel-course-app php artisan db:seed

#docker-compose run --rm nodejs npm install

echo Information of new containers
docker ps -a
