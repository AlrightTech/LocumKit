# Fix "MissingAppKeyException" Error

## Problem

After deployment, you see this error:
```
MissingAppKeyException
No application encryption key has been specified.
```

This means your `.env` file is missing or doesn't have an `APP_KEY`.

## ✅ Solution 1: Automatic Fix (Recommended)

The deployment workflow has been updated to automatically generate the `APP_KEY` if it's missing. Just **re-run the deployment**:

1. Go to GitHub Actions: https://github.com/AlrightTech/LocumKit/actions
2. Click "Deploy to cPanel"
3. Click "Run workflow" → Select branch → Run

The workflow will:
- Create `.env` file if it doesn't exist
- Generate `APP_KEY` automatically
- Set proper permissions

## ✅ Solution 2: Manual Fix via cPanel File Manager

1. **Log into cPanel**
2. **Open File Manager**
3. **Navigate to:** `/home/murree125/locumkit.murreefoods.com`
4. **Check if `.env` file exists:**
   - If it doesn't exist, create it (see Step 5)
   - If it exists, open it for editing

5. **Create/Edit `.env` file:**
   - Click "New File" → Name it `.env`
   - Or click on existing `.env` → Click "Edit"

6. **Add these minimum required lines:**
   ```env
   APP_NAME=LocumKit
   APP_ENV=production
   APP_KEY=
   APP_DEBUG=false
   APP_URL=https://locumkit.murreefoods.com
   ```

7. **Save the file**

8. **Generate APP_KEY via SSH** (see Solution 3 below)

## ✅ Solution 3: Generate APP_KEY via SSH/Terminal

### Option A: Using cPanel Terminal

1. **Log into cPanel**
2. **Go to "Terminal"** (under "Advanced" section)
3. **Run these commands:**
   ```bash
   cd /home/murree125/locumkit.murreefoods.com
   
   # Detect PHP version
   php82 artisan key:generate --force
   # OR if php82 doesn't work, try:
   php artisan key:generate --force
   ```

### Option B: Using SSH (if you have SSH access)

1. **Connect via SSH:**
   ```bash
   ssh username@yourdomain.com
   ```

2. **Navigate to deployment path:**
   ```bash
   cd /home/murree125/locumkit.murreefoods.com
   ```

3. **Generate the key:**
   ```bash
   /usr/local/bin/php82 artisan key:generate --force
   # OR
   php artisan key:generate --force
   ```

## ✅ Solution 4: Copy from Local Development

If you have a working `.env` file locally:

1. **Copy your local `.env` file**
2. **Upload it to cPanel:**
   - cPanel → File Manager
   - Navigate to `/home/murree125/locumkit.murreefoods.com`
   - Upload the `.env` file
   - **Important:** Update these values for production:
     - `APP_ENV=production`
     - `APP_DEBUG=false`
     - `APP_URL=https://locumkit.murreefoods.com`
     - Database credentials (DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD)

## 📋 Complete .env File Template

Here's a complete `.env` template with all required variables:

```env
APP_NAME=LocumKit
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://locumkit.murreefoods.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Important:** Replace placeholder values with your actual:
- Database credentials
- Mail settings
- Any API keys your application needs

## 🔍 Verify It's Working

After generating the `APP_KEY`:

1. **Refresh your website:** https://locumkit.murreefoods.com
2. **The error should be gone**
3. **If you still see errors**, check:
   - Database connection (if you see database errors)
   - File permissions
   - `.env` file has correct permissions (644)

## 🛡️ Security Notes

- **Never commit `.env` to Git** (it's already in `.gitignore`)
- **Keep `.env` file secure** - it contains sensitive information
- **Use different `APP_KEY` for production** - don't copy from development
- **Set `APP_DEBUG=false` in production** for security

## Still Having Issues?

1. **Check file permissions:**
   ```bash
   chmod 644 .env
   chmod -R 755 storage bootstrap/cache
   ```

2. **Verify `.env` file exists:**
   ```bash
   ls -la .env
   ```

3. **Check Laravel logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

4. **Clear config cache:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```


