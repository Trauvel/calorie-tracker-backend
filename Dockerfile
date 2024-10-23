# Используем PHP с поддержкой FPM
FROM php:8.2-fpm

# Устанавливаем необходимые зависимости и драйверы
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libmcrypt-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем файлы приложения
COPY . .

# Установка зависимостей
RUN composer install

# Установка прав
RUN chown -R www-data:www-data /var/www

# Запуск сервера
CMD php artisan serve --host=0.0.0.0 --port=8000

# Открываем порт 8000
EXPOSE 8000
