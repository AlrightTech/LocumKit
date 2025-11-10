# Quick Setup Guide - cPanel CI/CD Deployment

## 🚀 Quick Start (5 minutes)

### Step 1: Add GitHub Secrets

Go to: **Repository → Settings → Secrets and variables → Actions → New repository secret**

Add these secrets:

| Secret Name | Description | Example |
|------------|-------------|---------|
| `CPANEL_FTP_HOST` | Your FTP hostname | `ftp.yourdomain.com` |
| `CPANEL_FTP_USERNAME` | Your cPanel username | `username` |
| `CPANEL_FTP_PASSWORD` | Your FTP password | `your_password` |
| `CPANEL_SSH_KEY` | Your SSH private key | `-----BEGIN OPENSSH PRIVATE KEY-----...` |
| `CPANEL_SSH_HOST` | Your SSH hostname | `yourdomain.com` |
| `CPANEL_SSH_USERNAME` | Your SSH username | `username` |
| `CPANEL_DEPLOY_PATH` | Deployment path | `/home/username/public_html` |

### Step 2: Get SSH Key

**Option A: Generate New Key**
```bash
ssh-keygen -t rsa -b 4096 -C "github-actions"
# Copy the private key content to CPANEL_SSH_KEY secret
# Copy the public key to cPanel → SSH Access → Manage SSH Keys → Import Key
```

**Option B: Use Existing Key**
```bash
# Copy your existing private key
cat ~/.ssh/id_rsa
# Copy the output to CPANEL_SSH_KEY secret
```

### Step 3: Enable SSH in cPanel

1. Log into cPanel
2. Go to **SSH Access** or **Terminal**
3. If disabled, enable it
4. Add your public SSH key

### Step 4: Test Deployment

1. Push to `main` or `master` branch
2. Go to **Actions** tab in GitHub
3. Watch the deployment progress

## 📋 Which Workflow to Use?

- **`deploy-cpanel.yml`** - Uses FTP + SSH (works if FTP is enabled)
- **`deploy-cpanel-sftp.yml`** - Uses SFTP only (requires SSH access)

## ⚙️ Optional Configuration

### Auto-run Migrations

Add secret: `CPANEL_AUTO_MIGRATE` = `true`

### Install Composer on Server

Add secret: `CPANEL_INSTALL_COMPOSER` = `true`

### Custom SSH Port

Add secret: `CPANEL_SSH_PORT` = `2222` (if not using default port 22)

## 🔍 Verify Deployment

After deployment, check:

```bash
# SSH into your server
ssh username@yourdomain.com

# Check deployment path
cd /home/username/public_html
ls -la

# Check Laravel
php artisan --version

# Check logs
tail -f storage/logs/laravel.log
```

## ❌ Troubleshooting

**"Permission denied"**
```bash
chmod -R 755 storage bootstrap/cache public
```

**"Composer not found"**
- The workflow will try multiple paths automatically
- Or install Composer: `curl -sS https://getcomposer.org/installer | php`

**"PHP version mismatch"**
- Project requires PHP 8.2+ (check: `ls /usr/local/bin/php*`)
- Update `.cpanel.yml` or workflow if needed
- Ensure your cPanel server has PHP 8.2 or higher installed

**"SSH connection failed"**
- Verify SSH is enabled in cPanel
- Check SSH key is correct
- Verify hostname and port

## 📚 Full Documentation

See [DEPLOYMENT.md](./DEPLOYMENT.md) for detailed instructions.

