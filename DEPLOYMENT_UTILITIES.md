# Deployment Utilities

This document explains the utility routes available for clearing caches and creating storage directories, especially useful for deployment on hosting services like Hostinger.

## Available Routes

### 1. Cache Clearing Routes

These routes clear all Laravel caches including:

-   Application cache
-   Configuration cache
-   Route cache
-   View cache
-   Event cache
-   Queue cache
-   Compiled services (if available)

#### For Authenticated Users:

-   **General**: `/clear-cache`
-   **Admin**: `/admin/clear-cache`
-   **Seller**: `/seller/clear-cache`

#### For Emergency Access (No Authentication Required):

-   **Emergency**: `/emergency/clear-cache`

### 2. Storage Directory Creation Routes

These routes create the necessary directory structure in `public/storage/` for file uploads to work properly on hosting services. Unlike traditional Laravel storage links, this approach creates actual directories in the public folder.

#### For Authenticated Users:

-   **General**: `/storage-link`
-   **Admin**: `/admin/storage-link`
-   **Seller**: `/seller/storage-link`

#### For Emergency Access (No Authentication Required):

-   **Emergency**: `/emergency/storage-link`

## Storage Structure

The application now stores files directly in `public/storage/` with the following structure:

```
public/
├── storage/
│   ├── products/
│   │   ├── {seller_id}_{seller_name}_featured_images/
│   │   └── {seller_id}_{seller_name}_product_images/
│   ├── sellers/
│   │   ├── avatars/
│   │   └── covers/
│   └── admins/
│       ├── avatars/
│       └── covers/
```

## Database Storage Format

File paths are now stored in the database with the full path including "storage/" prefix:

**Examples:**

-   `storage/products/1_mohamed_zaki_featured_images/abc123.jpg`
-   `storage/sellers/avatars/def456.png`
-   `storage/admins/avatars/ghi789.jpg`

## Usage Instructions

### For Hostinger Deployment:

1. **After uploading your project to Hostinger:**

    - Visit: `https://yourdomain.com/emergency/storage-link`
    - This will create the necessary storage directory structure

2. **To clear all caches after deployment:**

    - Visit: `https://yourdomain.com/emergency/clear-cache`
    - This will clear all Laravel caches

3. **For regular maintenance (when logged in):**
    - Admin users can visit: `/admin/clear-cache` or `/admin/storage-link`
    - Seller users can visit: `/seller/clear-cache` or `/seller/storage-link`
    - Regular users can visit: `/clear-cache` or `/storage-link`

### Features:

-   **Direct Storage**: Files are stored directly in `public/storage/` without symbolic links
-   **Automatic Directory Creation**: Controllers automatically create necessary directories
-   **Automatic Redirect**: All routes redirect back to the previous page after execution
-   **Success/Error Messages**: Flash messages are displayed to indicate success or failure
-   **Error Handling**: Graceful error handling with informative error messages
-   **Emergency Access**: Public routes available when authentication is not possible

### Security Note:

The emergency routes (`/emergency/*`) are public and don't require authentication. Consider removing or protecting these routes in production if security is a concern.

## Example Usage:

```
# Clear all caches (emergency access)
GET https://yourdomain.com/emergency/clear-cache

# Create storage directories (emergency access)
GET https://yourdomain.com/emergency/storage-link

# Clear caches as admin
GET https://yourdomain.com/admin/clear-cache

# Create storage directories as seller
GET https://yourdomain.com/seller/storage-link
```

## Commands Executed:

### Cache Clear:

-   `php artisan cache:clear`
-   `php artisan config:clear`
-   `php artisan route:clear`
-   `php artisan view:clear`
-   `php artisan event:clear`
-   `php artisan queue:clear`
-   `php artisan clear-compiled` (if available)

### Storage Directory Creation:

Creates the following directories in `public/storage/`:

-   `storage/products/`
-   `storage/sellers/avatars/`
-   `storage/sellers/covers/`
-   `storage/admins/avatars/`
-   `storage/admins/covers/`

## Migration from Symbolic Link Approach

If you're migrating from the traditional Laravel storage link approach:

1. **Update Database**: Modify existing file paths in the database to include the "storage/" prefix
2. **Move Files**: Copy files from `storage/app/public/` to `public/storage/`
3. **Update Views**: Ensure views use `asset($path)` instead of `asset('storage/' . $path)`

The controllers have been updated to handle this new approach automatically for all future uploads.
