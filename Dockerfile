FROM php:8.2-apache

# Cài extension cần cho Laravel
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Bật mod_rewrite để Laravel routing hoạt động
RUN a2enmod rewrite

# Sao chép code vào container
COPY . /var/www/html

# Set quyền phù hợp
RUN chown -R www-data:www-data /var/www/html

# Cấu hình Apache để Laravel routing không bị lỗi
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expose port (dù Render tự xử lý, vẫn nên rõ ràng)
EXPOSE 80
