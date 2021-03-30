FROM php:7.3-fpm-alpine
# WORKDIR /var/www
RUN docker-php-ext-install pdo pdo_mysql

#  RUN php-xml  php-mbstring

RUN apk add --update nodejs 
RUN apk add --update npm


# RUN docker-compose exec php php /var/www/html/artisan migrate

# ADD . /var/www
# RUN chown -R $USER:www-data /var/www

# RUN chown -R www-data:www-data *
# RUN chmod 777 /var/www/html/storage

# FROM nginx:latest
# COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf