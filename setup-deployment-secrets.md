# Setup GitHub Secrets for cPanel Deployment

## 🔐 Required Secrets Checklist

Before deploying, you need to add these secrets to your GitHub repository.

### How to Add Secrets:

1. Go to: https://github.com/AlrightTech/LocumKit/settings/secrets/actions
2. Click **"New repository secret"**
3. Add each secret below:

---

## Required Secrets:

### 1. CPANEL_FTP_HOST
- **What it is:** Your FTP server hostname
- **How to find:** 
  - cPanel → FTP Accounts → Look for "FTP Server" or "Hostname"
  - Usually: `yourdomain.com` or `ftp.yourdomain.com`
- **Example:** `example.com`

### 2. CPANEL_FTP_USERNAME
- **What it is:** Your cPanel/FTP username
- **How to find:**
  - Your cPanel username (shown in top-right of cPanel)
  - Or create a dedicated FTP account in cPanel → FTP Accounts
- **Example:** `username123`

### 3. CPANEL_FTP_PASSWORD
- **What it is:** Your FTP password
- **How to find:**
  - Your cPanel password (if using main account)
  - Or reset/create password in cPanel → FTP Accounts
- **Example:** `YourSecurePassword123!`

### 4. CPANEL_SSH_KEY
- **What it is:** Your SSH private key (for running commands on server)
- **How to create:**
  ```bash
  # On Windows (Git Bash or PowerShell):
  ssh-keygen -t rsa -b 4096 -C "github-actions-cpanel"
  # Save as: cpanel_deploy_key (or any name)
  # Don't set a passphrase (press Enter)
  ```
  - Copy the **private key** content (the file without .pub)
  - Paste entire content including `-----BEGIN OPENSSH PRIVATE KEY-----` and `-----END OPENSSH PRIVATE KEY-----`
- **Then:** Add the **public key** (file with .pub extension) to cPanel:
  - cPanel → SSH Access → Manage SSH Keys → Import Key

### 5. CPANEL_SSH_HOST
- **What it is:** Your SSH server hostname
- **How to find:**
  - Usually same as your domain: `yourdomain.com`
  - Or check cPanel → SSH Access
- **Example:** `example.com`

### 6. CPANEL_SSH_USERNAME
- **What it is:** Your SSH username
- **How to find:**
  - Usually same as your cPanel username
  - Check cPanel → SSH Access
- **Example:** `username123`

### 7. CPANEL_DEPLOY_PATH
- **What it is:** Where to deploy files on server
- **How to find:**
  - Main domain: `/home/yourcpanelusername/public_html`
  - Check cPanel → File Manager → Look at the path shown
- **Example:** `/home/username123/public_html`

---

## Optional Secrets:

### CPANEL_SSH_PORT (Optional)
- **Default:** `22`
- **Only needed if:** Your SSH uses a different port
- **How to find:** Check with your hosting provider

### CPANEL_AUTO_MIGRATE (Optional)
- **Value:** `true` or `false`
- **What it does:** Automatically runs `php artisan migrate` on each deployment
- **Recommendation:** Set to `false` initially, enable after testing

### CPANEL_INSTALL_COMPOSER (Optional)
- **Value:** `true` or `false`
- **What it does:** Installs Composer dependencies on server after deployment
- **Recommendation:** Set to `true` if vendor folder is not deployed

---

## Quick Setup Steps:

1. ✅ Generate SSH key pair (see #4 above)
2. ✅ Add public key to cPanel → SSH Access → Manage SSH Keys
3. ✅ Enable SSH Access in cPanel (if not already enabled)
4. ✅ Add all 7 required secrets to GitHub
5. ✅ Push to main branch or manually trigger workflow

---

## Test Your Setup:

After adding secrets, you can test by:

1. **Manual Trigger:**
   - Go to: https://github.com/AlrightTech/LocumKit/actions
   - Click "Deploy to cPanel"
   - Click "Run workflow" → Select branch → Run

2. **Automatic Trigger:**
   - Push any commit to `main` branch
   - Workflow will run automatically

---

## Troubleshooting:

**SSH Key Issues:**
- Make sure you copied the **entire** private key (including BEGIN/END lines)
- Ensure public key is added to cPanel
- Verify SSH Access is enabled in cPanel

**FTP Connection Issues:**
- Verify hostname is correct (try with/without `ftp.` prefix)
- Check if FTP is enabled in cPanel
- Verify username and password are correct

**Path Issues:**
- Verify deployment path exists
- Check you have write permissions
- Path should start with `/home/` and end with `/public_html` or your subdomain path

---

## Need Help?

- Check the deployment logs in GitHub Actions
- Review `DEPLOYMENT.md` for detailed instructions
- Check `QUICK_SETUP.md` for quick reference

