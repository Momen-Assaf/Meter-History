# Meter History Management System

A Laravel application for managing meter history records with Excel import functionality.

## Features

-   ✅ **CRUD Operations** - Create, read, update, delete meter records
-   ✅ **Excel Import** - Import data from .xlsx/.xls/.csv files
-   ✅ **Search & Filter** - Filter by community, status, date range, meter number
-   ✅ **Responsive UI** - Bootstrap 5 interface that works on all devices

## Quick Start

1. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

2. **Setup environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. **Setup database**

    ```bash
    php artisan migrate:fresh
    ```

4. **Start the server**
    ```bash
    php artisan serve
    ```

Visit `http://localhost:8000` to use the application.

## Usage

-   **Add Records**: Click "Add Record" to manually enter meter data
-   **Import Excel**: Click "Import Excel" to upload spreadsheet files
-   **Search**: Use the search bar and filters to find specific records
-   **Manage**: View, edit, or delete records using the action buttons

## Excel Import

Your Excel file should have headers in the first row. Supported columns:

-   `status`, `reason`, `community`, `english_name`, `meter_number`
-   `changed_date`, `household_status`, `main_holder`, `notes`
-   And 13 more fields for comprehensive meter tracking

## Requirements

-   PHP 8.2+
-   Composer
-   Node.js (for assets)

## Database

Uses SQLite by default. To use MySQL/PostgreSQL, update your `.env` file with database credentials.

---

Built with Laravel 12, Bootstrap 5, and Laravel Excel.
