FROM php:8.3-cli

# Installer les dépendances système et les extensions PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    xml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installer Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail dans le conteneur
WORKDIR /var/www/html

# Démarrer le serveur de développement Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
