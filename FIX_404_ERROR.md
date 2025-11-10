# Fix 404 Error After Deployment

## Problem
After successful deployment, you're seeing a 404 error when visiting your website.

## Root Cause
Laravel requires the web server's document root to point to the `public` folder, not the project root. Your subdomain's document root is currently pointing to the project root.

## Solution: Update Document Root in cPanel

### Step 1: Access Subdomain Settings
1. Log into cPanel
2. Go to **Subdomains** (under "Domains" section)
3. Find `locumkit.murreefoods.com` in the list
4. Click the **"Manage"** button (wrench icon)

### Step 2: Update Document Root
1. In the subdomain management page, you'll see the **Document Root** field
2. Current value: `/home/username/locumkit.murreefoods.com`
3. Change it to: `/home/username/locumkit.murreefoods.com/public`
4. Click **"Change"** or **"Save"**

### Step 3: Verify
1. Visit your website: `https://locumkit.murreefoods.com`
2. The 404 error should be resolved

## Alternative: Quick Fix via File Manager

If you can't change the document root, you can create a redirect:

1. Go to **File Manager** in cPanel
2. Navigate to `/home/username/locumkit.murreefoods.com/`
3. Create a new file named `.htaccess` (if it doesn't exist)
4. Add this content:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

5. Save the file
6. Visit your website again

## Verify Deployment Structure

After deployment, your folder structure should look like:

```
/home/username/locumkit.murreefoods.com/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/          ← Document root should point here
│   ├── index.php
│   ├── .htaccess
│   └── ...
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
└── ...
```

## Still Getting 404?

1. **Check .htaccess file exists:**
   - File: `public/.htaccess`
   - Should contain Laravel rewrite rules

2. **Check index.php exists:**
   - File: `public/index.php`
   - This is Laravel's entry point

3. **Check file permissions:**
   ```bash
   chmod 644 public/index.php
   chmod 644 public/.htaccess
   ```

4. **Check Laravel logs:**
   - File: `storage/logs/laravel.log`
   - Look for any errors

5. **Verify .env file:**
   - Ensure `.env` file exists in the project root
   - Check `APP_URL` is set correctly: `APP_URL=https://locumkit.murreefoods.com`

## Need Help?

If the issue persists:
1. Check the deployment logs in GitHub Actions
2. Verify the document root path in cPanel
3. Check Laravel logs for specific error messages
4. Ensure mod_rewrite is enabled on your server

