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

## Hostinger Re-Deployment Checklist (REQUIRED)

### 1. Ensure `.env` is set to Production

SSH or use File Manager to edit `~/domains/fitnessgains.site/fitnessgains/.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://fitnessgains.site
```

### 2. Delete `public/hot` on Hostinger

If this file exists on the server, Laravel will keep looking for the Vite dev server:

```bash
ssh -p 65002 -i ~/.ssh/id_ed25519_hostinger u131777329@195.35.62.18
rm ~/domains/fitnessgains.site/public_html/public/hot
```

> Or use Hostinger File Manager → navigate to `public/` → delete `hot`.

### 3. Upload `public/build/` Folder

Make sure the **entire** `public/build/` directory is on Hostinger:

```
public/build/
├── manifest.json
└── assets/
    ├── app-CRw8qBAL.js
    └── app-ZWK0dAmG.css
```

If missing, rebuild locally and re-upload:

```bash
npm run build
```

Then upload `public/build/` to `~/domains/fitnessgains.site/public_html/public/build/`.

### 4. Clear All Laravel Caches

```bash
ssh -p 65002 -i ~/.ssh/id_ed25519_hostinger u131777329@195.35.62.18
cd ~/domains/fitnessgains.site/fitnessgains
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### 5. (Optional) Cache for Production Performance

After confirming CSS works:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Hard-Refresh Browser

Press `Ctrl + F5` (Windows) or `Cmd + Shift + R` (Mac) to clear any cached 404 responses.

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
