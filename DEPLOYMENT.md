# cPanel Deployment Guide

This project includes CI/CD pipelines for automated deployment to cPanel hosting. There are two deployment methods available:

## Deployment Methods

### 1. GitHub Actions (FTP/SSH) - Recommended

This method uses GitHub Actions to automatically deploy your code to cPanel via FTP and then runs post-deployment commands via SSH.

**Workflow File:** `.github/workflows/deploy-cpanel.yml`

#### Setup Instructions

1. **Add GitHub Secrets**

   Go to your GitHub repository → Settings → Secrets and variables → Actions, and add the following secrets:

   **Required Secrets:**
   - `CPANEL_FTP_HOST` - Your cPanel FTP hostname (e.g., `ftp.yourdomain.com` or `yourdomain.com`)
   - `CPANEL_FTP_USERNAME` - Your cPanel FTP username
   - `CPANEL_FTP_PASSWORD` - Your cPanel FTP password
   - `CPANEL_SSH_KEY` - Your SSH private key for cPanel (if SSH access is enabled)
   - `CPANEL_SSH_HOST` - Your cPanel SSH hostname (usually same as FTP host)
   - `CPANEL_SSH_USERNAME` - Your cPanel SSH username (usually same as FTP username)
   - `CPANEL_DEPLOY_PATH` - Deployment path (e.g., `/home/username/public_html`)

   **Optional Secrets:**
   - `CPANEL_SSH_PORT` - SSH port (default: 22)
   - `CPANEL_INSTALL_COMPOSER` - Set to `true` if you want to install Composer dependencies on the server
   - `CPANEL_AUTO_MIGRATE` - Set to `true` to automatically run migrations on each deployment

2. **Enable SSH Access in cPanel**

   - Log into your cPanel
   - Go to "SSH Access" or "Terminal"
   - Generate an SSH key pair or use an existing one
   - Add your public key to authorized_keys

3. **Configure Deployment Path**

   Update the `CPANEL_DEPLOY_PATH` secret with your actual deployment path. Common paths:
   - Main domain: `/home/username/public_html`
   - Subdomain: `/home/username/subdomain.yourdomain.com`
   - Addon domain: `/home/username/addondomain.com`

4. **Trigger Deployment**

   - **Automatic:** Push to `main` or `master` branch
   - **Manual:** Go to Actions tab → Select "Deploy to cPanel" → Click "Run workflow"

### 2. cPanel Git Deployment (`.cpanel.yml`)

This method uses cPanel's built-in Git deployment feature. When you push to your Git repository, cPanel automatically pulls and deploys.

#### Setup Instructions

1. **Enable Git in cPanel**

   - Log into your cPanel
   - Go to "Git Version Control"
   - Create a new repository or clone an existing one
   - Set the deployment path

2. **Configure `.cpanel.yml`**

   Update the `DEPLOYPATH` in `.cpanel.yml`:
   ```yaml
   - export DEPLOYPATH=/home/yourusername/public_html/
   ```

3. **Push to Repository**

   When you push to your configured branch, cPanel will automatically:
   - Pull the latest code
   - Install dependencies
   - Build assets
   - Run Laravel optimization commands

## Manual Deployment Script

If you need to manually run deployment commands on the server, use the `deploy-cpanel.sh` script:

```bash
# Make the script executable
chmod +x deploy-cpanel.sh

# Run the deployment script
./deploy-cpanel.sh

# Or with custom paths
DEPLOY_PATH=/home/username/public_html PHP_BIN=/usr/local/bin/php81 ./deploy-cpanel.sh
```

## Pre-Deployment Checklist

Before deploying, ensure:

- [ ] `.env` file is configured on the server with correct database credentials
- [ ] Database is accessible from the server
- [ ] Storage directories have proper permissions (755 for directories, 644 for files)
- [ ] `public/storage` symlink exists (created automatically by deployment)
- [ ] PHP version matches your requirements (PHP 8.2+)
- [ ] Required PHP extensions are installed
- [ ] Composer is available on the server
- [ ] Node.js and npm are available (if building assets on server)

## Post-Deployment Tasks

After deployment, verify:

1. **Check Application**
   - Visit your website to ensure it's working
   - Check for any error messages

2. **Verify Permissions**
   ```bash
   ls -la storage bootstrap/cache
   ```

3. **Check Logs**
   ```bash
   tail -f storage/logs/laravel.log
   ```

4. **Run Migrations** (if needed)
   ```bash
   php artisan migrate --force
   ```

## Troubleshooting

### Common Issues

1. **Permission Denied Errors**
   ```bash
   chmod -R 755 storage bootstrap/cache
   chmod -R 755 public
   ```

2. **Composer Not Found**
   - Use full path: `/usr/local/bin/composer`
   - Or install Composer globally

3. **PHP Version Issues**
   - Check available PHP versions: `ls /usr/local/bin/php*`
   - Update `PHP_BIN` in deployment scripts

4. **Storage Link Missing**
   ```bash
   php artisan storage:link
   ```

5. **Cache Issues**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   php artisan route:clear
   ```

### Getting Help

- Check GitHub Actions logs for detailed error messages
- Review cPanel error logs
- Check Laravel logs: `storage/logs/laravel.log`
- Verify all secrets are correctly set in GitHub

## Security Notes

- Never commit `.env` file to Git
- Use strong passwords for FTP/SSH
- Rotate SSH keys regularly
- Keep dependencies updated
- Review file permissions regularly

## Environment Variables

Make sure your `.env` file on the server includes:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Additional Resources

- [Laravel Deployment Documentation](https://laravel.com/docs/deployment)
- [cPanel Git Documentation](https://docs.cpanel.net/knowledge-base/web-services/guide-to-git/)
- [GitHub Actions Documentation](https://docs.github.com/en/actions)

