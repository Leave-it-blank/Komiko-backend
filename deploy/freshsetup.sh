#!/bin/bash

#to run this "yes Y | bash freshsetup.sh"
echo "to run this 'yes Y | bash freshsetup.sh'"
cd /workspace
echo "I sure hope you know what you just did"
php artisan migrate --seed
#alternatively migrate:fresh