# Ads Companies Management

This document describes the Ads Companies management feature implemented for the admin panel.

## Overview

The Ads Companies Management system allows administrators to create, manage, and display company advertisements within the platform. Companies can promote their logos and profiles, with optional associations to existing sellers.

## Database Structure

### Table: `ads_companies`

| Column       | Type                   | Description                   |
| ------------ | ---------------------- | ----------------------------- |
| `id`         | Primary Key            | Unique identifier             |
| `name`       | String                 | Company name                  |
| `logo`       | String (nullable)      | Path to company logo image    |
| `link`       | String (nullable)      | Company website URL           |
| `start_date` | Date                   | Campaign start date           |
| `end_date`   | Date                   | Campaign end date             |
| `seller_id`  | Foreign Key (nullable) | Associated seller (optional)  |
| `is_active`  | Boolean                | Active status (default: true) |
| `created_at` | Timestamp              | Creation timestamp            |
| `updated_at` | Timestamp              | Last update timestamp         |

## Features

### Admin Panel Features

1. **CRUD Operations**

    - Create new ads companies
    - View all ads companies in a data table
    - Edit existing ads companies
    - Delete ads companies (with confirmation)
    - View detailed information about each company

2. **Modal-based Interface**

    - Add Company modal
    - Edit Company modal (with logo management)
    - Delete confirmation modal

3. **Logo Management**

    - Upload company logos
    - Preview current logos
    - Delete existing logos
    - Automatic file storage in `storage/app/public/ads-companies/logos/`

4. **Status Management**

    - Active/Inactive toggle
    - Automatic status calculation based on date range:
        - **Active**: Currently running (within date range and is_active = true)
        - **Scheduled**: Future campaign (start_date > today)
        - **Expired**: Past campaign (end_date < today)
        - **Inactive**: Manually disabled (is_active = false)

5. **Seller Association**
    - Optional linking to existing sellers
    - Dropdown selection of active sellers
    - Direct links to seller profiles

### Frontend Display

The ads companies are automatically displayed on the buyer interface using the existing `ads_companies.blade.php` template:

-   Only shows **active and current** ads (within date range and active status)
-   Displays company logos with clickable links
-   Falls back to static logos if no active ads are available
-   Supports companies without logos (shows company name instead)

## Routes

All routes are protected by the `auth:admin` middleware:

```php
// Resource routes
Route::resource('ads-companies', AdminAdsCompanyController::class)->except(['edit']);

// AJAX routes
Route::get('ads-companies/{adsCompany}/edit-data', [AdminAdsCompanyController::class, 'getEditData'])->name('ads-companies.editData');
Route::delete('ads-companies/{adsCompany}/delete-logo', [AdminAdsCompanyController::class, 'deleteLogo'])->name('ads-companies.deleteLogo');
```

## Model Relationships

### AdsCompany Model

-   `belongsTo(Seller::class)` - Optional seller association

### Seller Model

-   `hasMany(AdsCompany::class)` - Seller can have multiple ads

## Usage

### Adding a New Ads Company

1. Navigate to Admin Panel > Ads Companies Management
2. Click "Add Ads Company" button
3. Fill in the form:
    - Company Name (required)
    - Company Link (optional URL)
    - Start Date (required)
    - End Date (required, must be after start date)
    - Associated Seller (optional)
    - Company Logo (optional image file)
    - Active status (checkbox)
4. Click "Save Ads Company"

### Managing Existing Companies

-   **View**: Click the eye icon to see detailed information
-   **Edit**: Click the edit icon to modify company details
-   **Delete**: Click the trash icon to delete (with confirmation)

### Logo Management

-   Upload: Select image file during create/edit
-   Preview: Current logo is shown in edit modal
-   Delete: Use "Remove" button to delete current logo
-   Supported formats: JPEG, PNG, JPG, GIF, SVG (max 2MB)

## Technical Implementation

### Files Created/Modified

1. **Migration**: `database/migrations/2025_05_31_143345_create_ads_companies_table.php`
2. **Model**: `app/Models/AdsCompany.php`
3. **Controller**: `app/Http/Controllers/Admin/AdminAdsCompanyController.php`
4. **Views**:
    - `resources/views/admin/ads-companies/index.blade.php`
    - `resources/views/admin/ads-companies/show.blade.php`
5. **Routes**: Added to `routes/adminRoutes.php`
6. **Sidebar**: Updated `resources/views/layouts/app/partials/admin/sidebar.blade.php`
7. **Frontend**: Updated `resources/views/layouts/app/partials/buyer/ads_companies.blade.php`
8. **Seeder**: `database/seeders/AdsCompanySeeder.php`

### Model Scopes

-   `active()`: Returns only active companies
-   `current()`: Returns companies within current date range
-   `activeAndCurrent()`: Returns companies that are both active and current

### Validation Rules

-   `name`: required, string, max 255 characters
-   `logo`: optional, image (jpeg,png,jpg,gif,svg), max 2MB
-   `link`: optional, valid URL, max 255 characters
-   `start_date`: required, valid date
-   `end_date`: required, valid date, after or equal to start_date
-   `seller_id`: optional, must exist in sellers table
-   `is_active`: boolean

## Security

-   All routes protected by admin authentication
-   File upload validation for logos
-   CSRF protection on all forms
-   Proper authorization checks

## Testing

Test data can be added using the seeder:

```bash
php artisan db:seed --class=AdsCompanySeeder
```

This creates 5 sample companies with different statuses (active, scheduled, expired, inactive).
