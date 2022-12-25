#!/bin/bash
echo "perms"
 
cd /workspace
echo "Starting"

echo ls -la
sudo cp .env.example .env

echo "Composer Started"
sudo composer install 
echo "Composer Finished"
echo "Key Generated"
php artisan key:generate
echo "Key Generated:finsihed"
echo "NPM Started"  
sudo npm install
echo "NPM Finished"
npm run production
echo "NPM Build Finished"
echo "Storage Link Created"
php artisan storage:link
echo "Storage Link Created:Finished"
echo "OPTIMIZE Started"
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "OPTIMIZE Finished"
echo "Server Ready"
#echo "Migration Started" 
#sudo php artisan migrate --seed  
#yes
#"yes"
#echo "yes"
echo "migrate db from docker" 
echo "Queue start from docker "
#php artisan horizon
#command php artisan horizon -d