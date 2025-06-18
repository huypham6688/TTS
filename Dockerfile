FROM php:8.2-apache

# Cài extension Laravel cần
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Bật mod_rewrite
RUN a2enmod rewrite

# Sao chép toàn bộ project vào container
COPY . /var/www/html

# Di chuyển tới thư mục project
WORKDIR /var/www/html

# ✅ Chạy composer install để tạo vendor/
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Thiết lập quyền
RUN chown -R www-data:www-data /var/www/html

# Cập nhật DocumentRoot để Laravel dùng thư mục public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
