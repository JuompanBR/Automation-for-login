# Use PHP CLI image as the base
FROM php:8.1-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip && \
    docker-php-ext-install pdo_mysql && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ensure Composer Global Binaries are in PATH
ENV PATH="$HOME/.composer/vendor/bin:$PATH"

# Install Codeception globally
RUN composer global require codeception/codeception

# Set working directory
WORKDIR /app

# Copy the project files
COPY . /app

# Set entrypoint to use Codeception by default
ENTRYPOINT ["codecept"]
