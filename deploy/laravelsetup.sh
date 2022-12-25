#!/bin/bash
echo "starting setuptools"
php artisan key:generate
echo "Key Generated:finsihed"
php artisan storage:link
echo "Storage Link Created:Finished"
echo "OPTIMIZE Started"
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
 
echo "OPTIMIZE Finished"
echo "Server Ready"
echo "Do Migration and seeding." 
#sudo php artisan migrate --seed  
#yes
#"yes"
#echo "yes"
echo "migrate db from docker" 
echo "Queue start from docker "
#php artisan horizon
#command php artisan horizon -d