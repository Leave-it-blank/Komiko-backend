ARG PHP_EXTENSIONS="mysqli pgsql pdo_mysql pdo_pgsql gd"
FROM thecodingmachine/php:8.1-v4-apache-node16

WORKDIR /workspace
RUN sudo chmod -R 777 /workspace 
