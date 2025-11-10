#!/bin/bash

# cPanel Deployment Script
# This script can be used for manual deployment or as a post-deployment hook

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
DEPLOY_PATH="${DEPLOY_PATH:-/home/$(whoami)/public_html}"
PHP_BIN="${PHP_BIN:-/usr/local/bin/php82}"

# Detect PHP version if php82 doesn't exist
if [ ! -f "$PHP_BIN" ]; then
  if [ -f "/usr/local/bin/php83" ]; then
    PHP_BIN="/usr/local/bin/php83"
  elif [ -f "/usr/local/bin/php84" ]; then
    PHP_BIN="/usr/local/bin/php84"
  elif [ -f "/usr/local/bin/php81" ]; then
    PHP_BIN="/usr/local/bin/php81"
  else
    PHP_BIN="php"
  fi
fi

echo -e "${GREEN}Starting deployment to: $DEPLOY_PATH${NC}"
echo -e "${GREEN}Using PHP: $PHP_BIN${NC}"

# Change to deployment directory
cd "$DEPLOY_PATH" || {
  echo -e "${RED}Error: Cannot access deployment path: $DEPLOY_PATH${NC}"
  exit 1
}

# Set proper permissions
echo -e "${YELLOW}Setting permissions...${NC}"
chmod -R 755 storage bootstrap/cache public 2>/dev/null || true
chmod -R 775 storage/logs storage/framework 2>/dev/null || true

# Install/update Composer dependencies
if [ -f "composer.json" ]; then
  echo -e "${YELLOW}Installing Composer dependencies...${NC}"
  if [ -f "/usr/local/bin/composer" ]; then
    /usr/local/bin/composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist || \
    composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
  else
    composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
  fi
fi

# Install/update NPM dependencies and build assets
if [ -f "package.json" ]; then
  echo -e "${YELLOW}Installing NPM dependencies and building assets...${NC}"
  npm ci --production 2>/dev/null || npm install --production 2>/dev/null || true
  npm run production 2>/dev/null || true
fi

# Clear all caches
echo -e "${YELLOW}Clearing Laravel caches...${NC}"
$PHP_BIN artisan config:clear 2>/dev/null || true
$PHP_BIN artisan cache:clear 2>/dev/null || true
$PHP_BIN artisan view:clear 2>/dev/null || true
$PHP_BIN artisan route:clear 2>/dev/null || true

# Run migrations (optional - uncomment if needed)
# echo -e "${YELLOW}Running database migrations...${NC}"
# $PHP_BIN artisan migrate --force || echo "Migration failed or no migrations to run"

# Cache for production
echo -e "${YELLOW}Caching for production...${NC}"
$PHP_BIN artisan config:cache 2>/dev/null || true
$PHP_BIN artisan route:cache 2>/dev/null || true
$PHP_BIN artisan view:cache 2>/dev/null || true
$PHP_BIN artisan optimize 2>/dev/null || true

# Create storage link if it doesn't exist
if [ ! -L "public/storage" ]; then
  echo -e "${YELLOW}Creating storage symlink...${NC}"
  $PHP_BIN artisan storage:link 2>/dev/null || true
fi

# Restart PHP-FPM (if needed and if you have permission)
# /usr/local/cpanel/scripts/restartsrv_php-fpm || true

echo -e "${GREEN}Deployment completed successfully!${NC}"

