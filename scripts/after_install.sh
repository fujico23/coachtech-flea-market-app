#!/bin/bash

set -eux

cd /var/www/grfl/src
#cd /home/ec2-user/coachtech-flea-market-app-main/src
php artisan migrate --force
php artisan config:cache
