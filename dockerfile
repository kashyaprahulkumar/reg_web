# Stage 1: Use an official PHP image with the Apache web server
FROM php:8.2-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Install the necessary extensions: 
# 1. mysqli: needed for your database connection in config.php
# 2. pdo_mysql: a common dependency/alternative, good practice to include
RUN docker-php-ext-install mysqli pdo_mysql

# Enable the Apache Rewrite module (often useful for clean URLs/routing)
# Although not strictly needed for your current simple app, it's a good practice.
RUN a2enmod rewrite

# Copy all your application files into the container's web root
# Ensure your PHP/HTML/CSS files are in the same directory as this Dockerfile
COPY . /var/www/html

# The base image already exposes port 80 and starts Apache, so no CMD is needed.