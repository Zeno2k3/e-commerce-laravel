# Use PHP 8.2 FPM as the base image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    libgd-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy package files first to leverage Docker cache for dependencies
COPY composer.json composer.lock ./
COPY package.json package-lock.json ./

# Install PHP dependencies (optimized for production)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Install Node.js & NPM
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install NPM dependencies and build assets
RUN npm ci && npm run build

# Copy existing application directory contents
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
