# How to Find Your cPanel Deployment Path

## What is CPANEL_DEPLOY_PATH?

`CPANEL_DEPLOY_PATH` is the **full server path** where your Laravel application files should be deployed. This is where GitHub Actions will upload all your files.

## Step-by-Step: How to Find Your Deployment Path

### Method 1: Using cPanel File Manager (Easiest)

1. **Log into cPanel**
2. **Open File Manager** (under "Files" section)
3. **Navigate to your domain/subdomain folder:**
   - For **main domain**: Look for `public_html` folder
   - For **subdomain**: Look for a folder named after your subdomain (e.g., `locumkit.murreefoods.com`)
   - For **addon domain**: Look for the domain name folder
4. **Check the path shown at the top:**
   - The path will be displayed in the address bar or at the top of File Manager
   - It will look like: `/home/username/public_html` or `/home/username/subdomain.domain.com`
5. **This is your CPANEL_DEPLOY_PATH!**

### Method 2: Using cPanel Subdomains/Domains

1. **Log into cPanel**
2. **Go to "Subdomains"** (if using a subdomain) or **"Addon Domains"** (if using addon domain)
3. **Find your domain/subdomain** in the list
4. **Click "Manage"** (wrench icon) next to it
5. **Look at "Document Root"** field:
   - It shows something like: `/home/username/locumkit.murreefoods.com`
   - **Your CPANEL_DEPLOY_PATH should be this path WITHOUT `/public` at the end**
   - Example: If Document Root is `/home/username/locumkit.murreefoods.com/public`, then CPANEL_DEPLOY_PATH is `/home/username/locumkit.murreefoods.com`

### Method 3: Using cPanel Terminal/SSH

1. **Log into cPanel**
2. **Go to "Terminal"** or **"SSH Access"**
3. **Run these commands:**
   ```bash
   # Show your current directory (this is usually your home directory)
   pwd
   
   # List all folders in your home directory
   ls -la
   
   # Check your subdomain path (replace with your subdomain)
   ls -la locumkit.murreefoods.com
   
   # Get full path
   realpath locumkit.murreefoods.com
   # or
   readlink -f locumkit.murreefoods.com
   ```

## Common Deployment Paths

| Type | Example Path | Notes |
|------|-------------|-------|
| **Main Domain** | `/home/username/public_html` | Your main website |
| **Subdomain** | `/home/username/locumkit.murreefoods.com` | Subdomain folder |
| **Addon Domain** | `/home/username/addondomain.com` | Addon domain folder |

**Important:** 
- Replace `username` with your actual cPanel username
- The path should **NOT** end with `/public` (that's the document root, not the deployment path)
- The path should **NOT** end with a trailing slash `/`

## How to Set CPANEL_DEPLOY_PATH in GitHub

1. **Go to GitHub Repository:**
   - Navigate to: `https://github.com/AlrightTech/LocumKit/settings/secrets/actions`

2. **Add or Edit the Secret:**
   - Click **"New repository secret"** (if it doesn't exist)
   - Or click on **CPANEL_DEPLOY_PATH** to edit it (if it exists)

3. **Enter the Path:**
   - **Name:** `CPANEL_DEPLOY_PATH`
   - **Value:** Your full path (e.g., `/home/username/locumkit.murreefoods.com`)
   - **Click "Add secret"** or **"Update secret"**

## Verify Your Path is Correct

After setting the secret, check the deployment logs:

1. **Go to GitHub Actions:**
   - Navigate to: `https://github.com/AlrightTech/LocumKit/actions`

2. **Open the latest deployment run**

3. **Check the "Extract and deploy on server" step:**
   - Look for: `Deployment path: /home/username/...`
   - This should match your CPANEL_DEPLOY_PATH

4. **Check the verification messages:**
   - Should show: `✅ public/index.php exists`
   - Should show: `✅ vendor directory exists`

## Troubleshooting: Files Still Not Uploading

If files are still not appearing in cPanel:

### 1. Check Which Workflow is Running

You have 3 workflow files. Check which one is actually running:
- `deploy.yml` - Uses SSH to upload tar.gz and extract
- `deploy-cpanel.yml` - Uses FTP to upload files
- `deploy-cpanel-sftp.yml` - Uses SFTP to upload files

**Check GitHub Actions to see which workflow ran.**

### 2. Verify SSH Credentials

If using `deploy.yml` (SSH method):
- Make sure `CPANEL_SSH_KEY` is set correctly
- Make sure `CPANEL_SSH_HOST` matches your server
- Make sure `CPANEL_SSH_USERNAME` is correct

### 3. Verify FTP Credentials

If using `deploy-cpanel.yml` (FTP method):
- Make sure `CPANEL_FTP_HOST` is correct
- Make sure `CPANEL_FTP_USERNAME` is correct
- Make sure `CPANEL_FTP_PASSWORD` is correct

### 4. Check Deployment Logs

Look for errors in the deployment logs:
- **"Deploy to cPanel via SSH"** step - Check for connection errors
- **"Extract and deploy on server"** step - Check for permission errors
- **"Deploy to cPanel via FTP"** step - Check for upload errors

### 5. Manually Check Server

SSH into your server and check:
```bash
# Navigate to your deployment path
cd /home/username/locumkit.murreefoods.com

# List files
ls -la

# Check if files exist
ls -la public/index.php
ls -d vendor
```

## Quick Checklist

- [ ] Found the correct path using File Manager or Subdomains
- [ ] Path starts with `/home/`
- [ ] Path does NOT end with `/public`
- [ ] Path does NOT end with trailing slash `/`
- [ ] Added/Updated `CPANEL_DEPLOY_PATH` in GitHub Secrets
- [ ] Verified path in deployment logs
- [ ] Checked which workflow is running
- [ ] Verified SSH/FTP credentials are correct

## Still Need Help?

1. Check the deployment logs in GitHub Actions
2. Take a screenshot of your cPanel File Manager showing the path
3. Check which workflow file ran (deploy.yml, deploy-cpanel.yml, or deploy-cpanel-sftp.yml)

