# GitHub Push & Hostinger Deploy TODO

-   [x] 1. Gather project info and user preferences
-   [x] 2. Get user confirmation for repo name, visibility, and commit message
-   [x] 3. Initialize local git repository
-   [x] 4. Stage all files (`git add .`)
-   [x] 5. Create initial commit (`Initial commit`)
-   [x] 6. Create GitHub repository (`fitnessgains`, public)
-   [x] 7. Push to GitHub (`git push -u origin main`)
-   [x] 8. Enable SSH in Hostinger hPanel (user action needed)
-   [x] 9. Generate SSH key and add to Hostinger (user action needed)
-   [x] 10. SSH into Hostinger server
-   [x] 11. Clone/pull repo to Hostinger
-   [x] 12. Install Laravel dependencies and configure .env
-   [x] 13. Set document root to `public` folder

---

# CSS NOT WORKING ON HOSTINGER — FIX IN PROGRESS

## Root Cause Identified

-   [x] Diagnosed: `public/hot` file was present, causing Laravel to load assets from Vite dev server (`http://[::1]:5174`) instead of compiled `public/build/` assets.

## Local Fixes Applied

-   [x] Deleted `public/hot`
-   [x] Verified `public/build/manifest.json`, `public/build/assets/*.css`, and `public/build/assets/*.js` exist
-   [x] Created `public/check_assets.php` diagnostic script
-   [x] Pushed all fixes to GitHub

---

## Hostinger Troubleshooting — 404 on CSS/JS Assets

The most common issue on Hostinger is the **document root** being set to `public_html` instead of `public_html/public`.

### CRITICAL: Check Your Document Root

Your website files on Hostinger are likely at:

```
~/domains/fitnessgains.site/public_html/
```

**BUT** Laravel's public files should be served from:

```
~/domains/fitnessgains.site/public_html/public/
```

### Fix Option A: Change Document Root (RECOMMENDED)

1. Go to **Hostinger hPanel** → **Websites** → **Manage** → **Advanced** → **Document Root**
2. Change from `public_html` to `public_html/public`
3. Save and wait 1-2 minutes

> If you can't find this setting, contact Hostinger support and ask them to change your document root to `public_html/public`.

### Fix Option B: Move Files to Root (Alternative)

If you cannot change the document root, move all files from `public/` to `public_html/`:

```bash
ssh -p 65002 -i ~/.ssh/id_ed25519_hostinger u131777329@195.35.62.18

# Backup current public_html
cd ~/domains/fitnessgains.site
mv public_html public_html_backup

# Create new public_html with Laravel public contents
mkdir public_html
cp -r fitnessgains/public/* public_html/

# Update index.php to point to correct paths
cd public_html
```

Then edit `public_html/index.php` and update these paths:

```php
require __DIR__ . '/../fitnessgains/vendor/autoload.php;
$app = require_once __DIR__ . '/../fitnessgains/bootstrap/app.php';
```

### Fix Option C: .htaccess Rewrite (Another Alternative)

If document root cannot be changed and you don't want to move files, create/modify `.htaccess` in `public_html/`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Redirect everything to /public/
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L]
</IfModule>
```

---

## Complete Re-Deployment Steps

### Step 1: SSH into Hostinger

```bash
ssh -p 65002 -i ~/.ssh/id_ed25519_hostinger u131777329@195.35.62.18
```

### Step 2: Navigate to Your Project

```bash
cd ~/domains/fitnessgains.site/fitnessgains
```

### Step 3: Pull Latest Changes

```bash
git pull origin main
```

### Step 4: Delete public/hot (CRITICAL)

```bash
rm -f public/hot
```

### Step 5: Verify Build Assets Exist

```bash
ls -la public/build/
ls -la public/build/assets/
```

You should see:

```
manifest.json
assets/
  app-ZWK0dAmG.css
  app-CRw8qBAL.js
```

If missing, rebuild locally and re-upload:

```bash
# Run this on your LOCAL machine
npm run build
# Then upload public/build/ to Hostinger
```

### Step 6: Clear All Caches

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Step 7: Ensure .env is Production

Edit `~/domains/fitnessgains.site/fitnessgains/.env`:

```env
APP_NAME="Fitness Gains"
APP_ENV=production
APP_KEY=base64:YOUR_ACTUAL_KEY_HERE
APP_DEBUG=false
APP_URL=https://fitnessgains.site

ASSET_URL=https://fitnessgains.site
```

> **Note:** `ASSET_URL` forces Laravel to use absolute URLs for assets.

### Step 8: Run Diagnostic Script

Visit: `https://fitnessgains.site/check_assets.php`

This will show you exactly what's wrong.

### Step 9: Test Direct Asset URLs

Open these in your browser:

| URL                                                       | Should Show     |
| --------------------------------------------------------- | --------------- |
| `https://fitnessgains.site/build/manifest.json`           | JSON text       |
| `https://fitnessgains.site/build/assets/app-ZWK0dAmG.css` | CSS code        |
| `https://fitnessgains.site/build/assets/app-CRw8qBAL.js`  | JavaScript code |

If any show 404, the document root is wrong or files are missing.

### Step 10: Hard-Refresh Browser

Press `Ctrl + F5` (Windows) or `Cmd + Shift + R` (Mac)

---

## If NOTHING Works — Emergency Fallback

Create a simple HTML file to test if Hostinger serves anything:

1. Create `public/test.html`:

```html
<!doctype html>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <h1>Hostinger is working!</h1>
    </body>
</html>
```

2. Visit: `https://fitnessgains.site/test.html`
3. If this shows 404, your document root is definitely wrong
4. If this works but `/build/assets/...` shows 404, the `build/` folder is missing

---

## Quick Reference Commands

```bash
# SSH into Hostinger
ssh -p 65002 -i ~/.ssh/id_ed25519_hostinger u131777329@195.35.62.18

# Navigate to project
cd ~/domains/fitnessgains.site/fitnessgains

# Pull updates
git pull origin main

# Delete hot file
rm -f public/hot

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache for production (after everything works)
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

# Manual Steps Required (by you)

1. **Create MySQL Database in hPanel**

    - Go to hPanel → Databases → MySQL Databases
    - Create database: `fitnessgains`
    - Create user: `fitnessgains_user`
    - Set a password
    - Add user to database with ALL PRIVILEGES

2. **Update `.env` Database Credentials**

    - SSH into Hostinger or use File Manager
    - Edit `~/domains/fitnessgains.site/fitnessgains/.env`
    - Update these lines with your actual DB credentials:

    ```
    DB_DATABASE=your_actual_db_name
    DB_USERNAME=your_actual_db_username
    DB_PASSWORD=your_actual_db_password
    ```

3. **Run Migrations**

    - SSH into Hostinger:

    ```bash
    cd ~/domains/fitnessgains.site/fitnessgains
    php artisan migrate --force
    php artisan db:seed --force
    ```

4. **(Optional) Set up SSL**

    - Go to hPanel → SSL
    - Install SSL certificate for `fitnessgains.site`

5. **Future Updates (Pull from GitHub)**
    ```bash
    ssh -p 65002 -i ~/.ssh/id_ed25519_hostinger u131777329@195.35.62.18
    cd ~/domains/fitnessgains.site/fitnessgains
    git pull origin main
    php artisan migrate --force
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```
