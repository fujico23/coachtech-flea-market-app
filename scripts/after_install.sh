#!/bin/bash

set -eux

#cd /var/www/grfl/src
cd /home/ec2-user/coachtech-flea-market-app-main
docker-compose exec app php artisan migrate --force
docker-compose exec app php config:cache
#php artisan migrate --force
#php artisan config:cache
#coachtech-flea-market-app-main-php-1
