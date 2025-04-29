# 1. PHP + Apache 기반 이미지
FROM php:8.1-apache

# 2. 필요한 PHP 확장 설치 (openssl 제외)
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring

# 3. Composer 설치 (선택적)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. index.php 우선 적용
RUN echo "DirectoryIndex index.php index.html" > /etc/apache2/mods-enabled/dir.conf

# 5. 코드 복사
COPY . /var/www/html/

# 6. 권한 설정
RUN chown -R www-data:www-data /var/www/html

# 7. 포트 오픈
EXPOSE 80
