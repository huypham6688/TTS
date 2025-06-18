FROM php:8.2-apache

# Cài các extension Laravel cần
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài Composer (từ image composer chính thức)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Bật mod_rewrite
RUN a2enmod rewrite

# Sao chép mã nguồn vào container
COPY . /var/www/html

# Làm việc tại thư mục project
WORKDIR /var/www/html

# Cập nhật DocumentRoot sang public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Cài đặt các package PHP của Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Thiết lập quyền truy cập
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache
