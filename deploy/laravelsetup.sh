#!/bin/bash
cd /workspace
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