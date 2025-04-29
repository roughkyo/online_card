FROM php:8.1-apache

# 시스템 패키지 업데이트 + 필수 라이브러리 설치
RUN apt-get update && apt-get install -y \
    libonig-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install mbstring pdo pdo_mysql mysqli

# Composer 설치
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# index.php 우선 처리
RUN echo "DirectoryIndex index.php index.html" > /etc/apache2/mods-enabled/dir.conf

# 코드 복사
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
