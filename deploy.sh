#!/bin/bash
# Post-deployment script for DigitalOcean App Platform

echo "Running post-deployment tasks..."

# Set permissions
chmod -R 755 storage bootstrap/cache

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (optional - uncomment if needed)
# php artisan migrate --force

# Optimize
php artisan optimize

echo "Post-deployment tasks completed!"