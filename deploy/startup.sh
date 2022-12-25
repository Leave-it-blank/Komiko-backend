#!/bin/bash
cd /workspace
echo "Starting"
echo $ls -la
sudo cp .env.example .env
echo "Composer Started"
sudo composer install 
echo "Composer Finished"
echo "NPM Started"  
sudo npm install
echo "NPM Finished"
npm run production
echo "NPM Build Finished"
echo "Storage Link Created"
 