#!/bin/bash

set -eux

cd /home/ec2-user/coachtech-flea-market-app-main
docker-compose exec app php artisan migrate --force
docker-compose exec app php config:cache

