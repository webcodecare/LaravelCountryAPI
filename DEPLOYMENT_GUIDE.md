# Laravel Country API - cPanel Deployment Guide

This guide will help you deploy your Laravel Country API to a cPanel hosting environment with MySQL database.

## Prerequisites

- cPanel hosting account with PHP 8.1 or higher
- SSH access (optional but recommended)
- MySQL database access
- Domain or subdomain configured

## Step 1: Prepare Your Project for Deployment

### 1.1 Update Database Configuration for MySQL

Edit your `.env` file to use MySQL instead of PostgreSQL:

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 1.2 Optimize for Production

Run these commands before uploading:

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Step 2: Create MySQL Database in cPanel

1. **Log in to cPanel**
2. **Navigate to MySQL Databases**
   - Click on "MySQL® Databases" icon

3. **Create a New Database**
   - Enter database name (e.g., `country_api`)
   - Click "Create Database"
   - Note down the full database name (usually prefixed with your username)

4. **Create Database User**
   - Scroll to "MySQL Users" section
   - Enter username and password
   - Click "Create User"
   - Note down the username and password

5. **Add User to Database**
   - Scroll to "Add User to Database" section
   - Select the user and database you created
   - Click "Add"
   - Grant **ALL PRIVILEGES**
   - Click "Make Changes"

## Step 3: Upload Files to cPanel

### Method 1: Using File Manager (Easier)

1. **Compress your project** (on your local machine):
   ```bash
   cd country-api
   zip -r country-api.zip . -x "vendor/*" -x "node_modules/*" -x "storage/logs/*"
   ```

2. **Upload to cPanel**:
   - Open cPanel File Manager
   - Navigate to your domain's root directory (usually `public_html` or a subdomain folder)
   - Upload the `country-api.zip` file
   - Right-click and select "Extract"
   - Delete the zip file after extraction

### Method 2: Using FTP

1. Use an FTP client (FileZilla, WinSCP)
2. Connect to your server using FTP credentials
3. Upload all files to your domain's directory
4. Exclude: `vendor/`, `node_modules/`, `storage/logs/`

### Method 3: Using Git (If SSH access available)

```bash
cd /home/username/public_html/
git clone your-repository-url country-api
cd country-api
```

## Step 4: Install Dependencies

### Via SSH (Recommended):

```bash
cd /home/username/public_html/country-api
composer install --optimize-autoloader --no-dev
```

### Via cPanel Terminal:

1. Open "Terminal" in cPanel
2. Navigate to your project directory
3. Run `composer install --optimize-autoloader --no-dev`

## Step 5: Configure Environment

1. **Copy environment file**:
   ```bash
   cp .env.example .env
   ```

2. **Edit .env file** (use File Manager or terminal):
   ```env
   APP_NAME=CountryAPI
   APP_ENV=production
   APP_KEY=
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=username_country_api
   DB_USERNAME=username_dbuser
   DB_PASSWORD=your_password

   LOG_CHANNEL=stack
   LOG_LEVEL=error
   ```

3. **Generate application key**:
   ```bash
   php artisan key:generate
   ```

## Step 6: Set File Permissions

Set correct permissions for Laravel directories:

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

Or via File Manager:
- Right-click on `storage` folder → Change Permissions → Set to 755
- Right-click on `bootstrap/cache` → Change Permissions → Set to 755

## Step 7: Configure Web Server

### Option A: Using .htaccess (Most Common)

1. **Create/Edit .htaccess in your domain root**:

If your Laravel project is in a subfolder (e.g., `/public_html/country-api/`):

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ country-api/public/$1 [L]
</IfModule>
```

2. **Ensure .htaccess exists in `country-api/public/`**:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Handle Front Controller
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### Option B: Using Subdomain/Domain Document Root

1. In cPanel, go to **Domains** or **Subdomains**
2. Set the document root to: `/home/username/public_html/country-api/public`
3. This way, the domain directly points to the `public` folder

## Step 8: Run Migrations and Seeders

```bash
cd /home/username/public_html/country-api
php artisan migrate:fresh
php artisan db:seed
```

Or run them together:
```bash
php artisan migrate:fresh --seed
```

**Note**: Make sure all JSON seed files are uploaded to `database/seeders/` directory.

## Step 9: Test Your API

Visit your domain:
- **Base URL**: `https://yourdomain.com/api/countries`
- **Test endpoints**:
  - `GET /api/countries` - Get all countries
  - `GET /api/countries/1` - Get single country
  - `GET /api/countries/1/states` - Get states for country
  - `GET /api/divisions` - Get all divisions
  - `GET /api/divisions/1/districts` - Get districts for division
  - `GET /api/districts` - Get all districts
  - `GET /api/upazilas` - Get all upazilas
  - `GET /api/unions` - Get all unions
  - `GET /api/cities` - Get all cities

## Available API Endpoints

### Countries
- `GET /api/countries` - List all countries
- `POST /api/countries` - Create new country
- `GET /api/countries/{id}` - Get single country
- `PUT /api/countries/{id}` - Update country
- `DELETE /api/countries/{id}` - Delete country
- `GET /api/countries/{id}/states` - Get states for country
- `GET /api/countries/{id}/cities` - Get cities for country

### States
- `GET /api/states` - List all states
- `POST /api/states` - Create new state
- `GET /api/states/{id}` - Get single state
- `PUT /api/states/{id}` - Update state
- `DELETE /api/states/{id}` - Delete state

### Cities
- `GET /api/cities` - List all cities
- `POST /api/cities` - Create new city
- `GET /api/cities/{id}` - Get single city
- `PUT /api/cities/{id}` - Update city
- `DELETE /api/cities/{id}` - Delete city

### Divisions (Bangladesh)
- `GET /api/divisions` - List all divisions
- `POST /api/divisions` - Create new division
- `GET /api/divisions/{id}` - Get single division
- `PUT /api/divisions/{id}` - Update division
- `DELETE /api/divisions/{id}` - Delete division
- `GET /api/divisions/{id}/districts` - Get districts for division

### Districts (Bangladesh)
- `GET /api/districts` - List all districts
- `POST /api/districts` - Create new district
- `GET /api/districts/{id}` - Get single district
- `PUT /api/districts/{id}` - Update district
- `DELETE /api/districts/{id}` - Delete district
- `GET /api/districts/{id}/upazilas` - Get upazilas for district

### Upazilas (Bangladesh)
- `GET /api/upazilas` - List all upazilas
- `POST /api/upazilas` - Create new upazila
- `GET /api/upazilas/{id}` - Get single upazila
- `PUT /api/upazilas/{id}` - Update upazila
- `DELETE /api/upazilas/{id}` - Delete upazila
- `GET /api/upazilas/{id}/unions` - Get unions for upazila

### Unions (Bangladesh)
- `GET /api/unions` - List all unions
- `POST /api/unions` - Create new union
- `GET /api/unions/{id}` - Get single union
- `PUT /api/unions/{id}` - Update union
- `DELETE /api/unions/{id}` - Delete union

## Troubleshooting

### 500 Internal Server Error
- Check file permissions (755 for directories, 644 for files)
- Check storage and bootstrap/cache permissions
- Enable error display temporarily: `APP_DEBUG=true` in `.env`
- Check Laravel logs: `storage/logs/laravel.log`

### Database Connection Error
- Verify database credentials in `.env`
- Ensure database user has proper privileges
- Check if database exists
- Try `localhost` or `127.0.0.1` for DB_HOST

### Routes Not Working
- Ensure `.htaccess` file exists in `public/` folder
- Check if mod_rewrite is enabled (contact hosting support)
- Clear route cache: `php artisan route:clear`

### Composer Not Found
- Most cPanel servers have composer installed globally
- If not available, contact your hosting provider
- Or install composer locally in your account

### Migrations Fail
- Check database connection
- Ensure proper privileges on database
- Check for syntax errors in migration files
- Try running migrations one by one

## Security Recommendations

1. **Never commit `.env` file** to version control
2. **Set `APP_DEBUG=false`** in production
3. **Use strong database passwords**
4. **Keep Laravel and dependencies updated**
5. **Use HTTPS** (enable SSL in cPanel)
6. **Limit database user privileges** to only what's needed
7. **Regular backups** of database and files

## Updating Your Application

When you need to update your code:

1. **Via SSH/Terminal**:
   ```bash
   cd /home/username/public_html/country-api
   git pull origin main  # if using git
   composer install --optimize-autoloader --no-dev
   php artisan migrate
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Via File Manager**:
   - Upload changed files
   - Replace existing files
   - Clear cache if needed

## Database Backup

### Using cPanel:
1. Go to **phpMyAdmin**
2. Select your database
3. Click **Export** tab
4. Choose **Quick** export method
5. Click **Go** to download backup

### Using Command Line:
```bash
mysqldump -u username -p database_name > backup.sql
```

## Restore Database:
```bash
mysql -u username -p database_name < backup.sql
```

## Support

If you encounter issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check server error logs in cPanel
3. Enable debug mode temporarily to see detailed errors
4. Contact your hosting provider for server-specific issues

---

**Congratulations!** Your Laravel Country API is now deployed on cPanel with MySQL database.
