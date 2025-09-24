# Meter History Management System

A Laravel-based web application for managing and displaying meter history data. This application provides a complete CRUD interface for meter readings with Excel import functionality, advanced filtering, and a responsive UI.

## Features

### Core Functionality

-   ✅ **CRUD Operations**: Create, Read, Update, and Delete meter history records
-   ✅ **Excel Import**: Import meter data from Excel files (.xlsx, .xls, .csv)
-   ✅ **Advanced Filtering**: Search and filter by community, meter number, date range, status, and household status
-   ✅ **Pagination**: Efficient handling of large datasets with pagination
-   ✅ **Responsive Design**: Mobile-friendly Bootstrap UI

### Data Management

-   ✅ **Comprehensive Fields**: 22-column schema for meter history tracking
-   ✅ **Meter Transfer Tracking**: Track meter transfers and status changes
-   ✅ **Data Validation**: Robust form validation for all inputs
-   ✅ **Status Tracking**: Track meter and household status changes
-   ✅ **Community Management**: Track community and household changes

## Technical Stack

-   **Framework**: Laravel 12
-   **Database**: SQLite (configurable for MySQL/PostgreSQL)
-   **Frontend**: Bootstrap 5 with custom styling
-   **Excel Processing**: Laravel Excel (Maatwebsite)
-   **Icons**: Bootstrap Icons
-   **Validation**: Laravel built-in validation

## Installation & Setup

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js (for asset compilation)

### Installation Steps

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd meter-history
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install JavaScript dependencies**

    ```bash
    npm install
    ```

4. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Database setup**

    ```bash
    php artisan migrate
    ```

6. **Create storage link for file uploads**

    ```bash
    php artisan storage:link
    ```

7. **Start the development server**

    ```bash
    php artisan serve
    ```

8. **Compile assets (optional)**
    ```bash
    npm run dev
    ```

The application will be available at `http://localhost:8000`

## Database Schema

### Meter Histories Table

The application uses a comprehensive `meter_histories` table with 22 columns for tracking meter history:

-   **Basic Information**: status, reason, community, english_name, comet_id_household_public, changed_date
-   **Meter Information**: meter_number, household_status, old_meter_number, new_meter_number, meter_number_2
-   **New Holder Information**: old_community_for_new_holder, new_community_for_new_holder, old_household_for_new_holder, new_household_for_new_holder, old_meter_number_for_new_holder, new_meter_number_for_new_holder, status_for_new_holder, new_community_name
-   **Main Holder Information**: main_holder, comet_id_for_main_holder
-   **Additional Data**: notes
-   **Timestamps**: created_at, updated_at

## Usage Guide

### 1. Adding New Records

-   Navigate to "Add Record" from the main menu
-   Fill in the required fields (marked with \*)
-   Optional fields can be left empty
-   Upload a photo if needed
-   The system will automatically calculate consumption if both previous and current readings are provided

### 2. Importing Excel Data

-   Go to "Import Excel" from the main menu
-   Select your Excel file (.xlsx, .xls, or .csv)
-   Ensure your file has headers in the first row
-   The system supports flexible column naming (see import page for details)

### 3. Filtering and Searching

-   Use the search bar to find records by meter number, customer name, community, or address
-   Filter by community using the dropdown
-   Filter by status (active, inactive, maintenance)
-   Use date range filters for specific periods

### 4. Managing Records

-   **View**: Click the eye icon to see detailed record information
-   **Edit**: Click the pencil icon to modify existing records
-   **Delete**: Click the trash icon to remove records (with confirmation)

## Excel Import Format

### All Columns (Optional)

The system supports importing any of the following columns:

**Basic Information:**

-   `status`, `reason`, `community`, `english_name`, `comet_id_household_public`, `changed_date`

**Meter Information:**

-   `meter_number`, `household_status`, `old_meter_number`, `new_meter_number`, `meter_number_2`

**New Holder Information:**

-   `old_community_for_new_holder`, `new_community_for_new_holder`, `old_household_for_new_holder`, `new_household_for_new_holder`, `old_meter_number_for_new_holder`, `new_meter_number_for_new_holder`, `status_for_new_holder`, `new_community_name`

**Main Holder Information:**

-   `main_holder`, `comet_id_for_main_holder`

**Additional Data:**

-   `notes`

## API Endpoints

The application provides RESTful routes for all operations:

-   `GET /meter-histories` - List all records with filtering
-   `GET /meter-histories/create` - Show create form
-   `POST /meter-histories` - Store new record
-   `GET /meter-histories/{id}` - Show specific record
-   `GET /meter-histories/{id}/edit` - Show edit form
-   `PUT /meter-histories/{id}` - Update record
-   `DELETE /meter-histories/{id}` - Delete record
-   `GET /meter-histories/import` - Show import form
-   `POST /meter-histories/import` - Process Excel import

## Configuration

### Database Configuration

The application is configured to use SQLite by default. To use MySQL or PostgreSQL:

1. Update your `.env` file:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

2. Run migrations:
    ```bash
    php artisan migrate
    ```

### File Upload Configuration

-   Photos are stored in `storage/app/public/meter-photos/`
-   Maximum file size: 2MB
-   Supported formats: JPEG, PNG, JPG, GIF

## Development

### Code Structure

-   **Models**: `app/Models/MeterHistory.php`
-   **Controllers**: `app/Http/Controllers/MeterHistoryController.php`
-   **Views**: `resources/views/meter-histories/`
-   **Migrations**: `database/migrations/`
-   **Routes**: `routes/web.php`

### Key Features Implementation

-   **Filtering**: Implemented using Eloquent query scopes
-   **Validation**: Comprehensive form validation rules
-   **File Upload**: Secure file handling with storage links
-   **Excel Import**: Flexible column mapping with validation
-   **Responsive UI**: Bootstrap 5 with custom styling

## Testing

Run the test suite:

```bash
php artisan test
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support or questions, please open an issue in the repository or contact the development team.

---

**Note**: This application was built as a technical assessment for Laravel development skills, demonstrating proficiency in MVC architecture, database design, form handling, file uploads, and responsive web development.
