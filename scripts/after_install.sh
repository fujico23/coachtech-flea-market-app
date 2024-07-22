#!/bin/bash

set -eux

cd /home/ec2-user/coachtech-flea-market-app-main
docker-compose exec coachtech-flea-market-app-main_php_1 php artisan migrate --force
docker-compose exec coachtech-flea-market-app-main_php_1 php config:cache

