# Usa a imagem oficial do PHP com suporte ao Laravel
FROM php:8.2-fpm

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo_mysql gd

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configura diretório da aplicação
WORKDIR /var/www

# Copia os arquivos do Laravel
COPY . .

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Garante que o nginx.conf está sendo copiado corretamente
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Permissões e configurações
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expõe a porta do PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
