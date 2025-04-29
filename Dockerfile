# 1. PHP + Apache 기반 이미지 사용
FROM php:8.1-apache

# 2. 필요한 PHP 확장 설치 (PHPMailer용 openssl 포함)
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring openssl

# 3. composer 설치 (선택적: PHPMailer 설치할 경우)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Apache가 index.php를 기본 문서로 인식하도록 설정
RUN echo "DirectoryIndex index.php index.html" > /etc/apache2/mods-enabled/dir.conf

# 5. 소스코드를 웹 루트로 복사
COPY . /var/www/html/

# 6. 파일 권한 설정 (보안 및 실행 오류 방지)
RUN chown -R www-data:www-data /var/www/html

# 7. Apache 포트 노출
EXPOSE 80
