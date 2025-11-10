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
- **What it is:** Where to deploy files on server (the full server path)
- **How to find:**
  - **Easiest method:** cPanel → File Manager → Navigate to your domain folder → Check the path shown at the top
  - **Alternative:** cPanel → Subdomains → Click "Manage" → Look at "Document Root" (remove `/public` from the end)
  - Main domain: `/home/yourcpanelusername/public_html`
  - Subdomain: `/home/yourcpanelusername/subdomain.domain.com`
  - **See `HOW_TO_FIND_DEPLOY_PATH.md` for detailed instructions**
- **Example:** `/home/username123/public_html` or `/home/username123/locumkit.murreefoods.com`
- **Important:** 
  - Path should NOT end with `/public` (that's document root, not deployment path)
  - Path should NOT end with trailing slash `/`

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

**404 Error or Empty Folders After Deployment:**

If deployment succeeds but you see 404 errors or empty folders:

1. **Check Document Root:**
   - Go to cPanel → Subdomains (or Domains)
   - Click "Manage" next to your domain/subdomain
   - Verify "Document Root" points to: `[DEPLOY_PATH]/public`
   - Example: If `CPANEL_DEPLOY_PATH` is `/home/username/public_html`, document root should be `/home/username/public_html/public`
   - **This is the most common cause of 404 errors!**

2. **Verify Files Were Deployed:**
   - Check cPanel File Manager
   - Navigate to your deployment path (e.g., `/home/username/public_html`)
   - You should see Laravel folders: `app`, `bootstrap`, `config`, `public`, `storage`, `vendor`, etc.
   - If folders are empty, check GitHub Actions logs for errors

3. **Check Deployment Path Secret:**
   - Verify `CPANEL_DEPLOY_PATH` is set correctly in GitHub Secrets
   - Should be the full path: `/home/yourusername/public_html` (not `/public_html/`)
   - For subdomains: `/home/yourusername/subdomain.domain.com`

4. **Verify SSH Deployment:**
   - The workflow uses SSH to extract and deploy files
   - Check that `CPANEL_SSH_KEY`, `CPANEL_SSH_HOST`, and `CPANEL_SSH_USERNAME` are correct
   - SSH into your server and check: `ls -la [DEPLOY_PATH]`

5. **Check File Permissions:**
   - Files should have proper permissions (755 for directories, 644 for files)
   - Storage and bootstrap/cache should be writable (775)
   - The deployment script sets these automatically, but verify if issues persist

6. **Verify .env File:**
   - Make sure `.env` file exists on the server in the deployment path
   - The deployment preserves existing `.env` files
   - If missing, create it manually in cPanel File Manager

---

## Need Help?

- Check the deployment logs in GitHub Actions
- Review `DEPLOYMENT.md` for detailed instructions
- Check `QUICK_SETUP.md` for quick reference

