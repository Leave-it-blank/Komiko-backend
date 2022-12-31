ARG PHP_EXTENSIONS="mysqli pgsql pdo_mysql pdo_pgsql gd"
FROM thecodingmachine/php:8.1-v4-apache-node16

WORKDIR /workspace
COPY . .
RUN sudo chmod -R 777 /workspace 
RUN cd /workspace && composer install --ignore-platform-req=ext-gd
RUN npm install
RUN npm run production