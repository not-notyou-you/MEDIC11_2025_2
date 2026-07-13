# UMN Medical Center Gen 11 (2025)

Official web application for UMN Medical Center - a comprehensive platform for health services management, equipment lending, service requests, and community engagement.

## Project Overview

This is a full-stack web application built to streamline operations and provide multiple access levels for different user roles. The platform serves three distinct user segments: public visitors, administrative staff, and system administrators.

## Technology Stack

- **Backend**: Laravel 11 with Laravel Sanctum
- **Frontend**: Alpine.js, Tailwind CSS 4.1, Flowbite Components
- **Build Tool**: Vite 6
- **Database**: MySQL
- **File Processing**: Intervention Image, PHPOffice (Word/Spreadsheet), Maatwebsite Excel
- **Email**: MailerSend
- **File Upload**: Dropzone
- **HTTP Client**: Axios
- **Package Manager**: Composer, NPM
- **Runtime**: PHP 8.2+, Node.js 20+

## Key Libraries & Capabilities

- **Authentication**: Laravel Sanctum for API token authentication
- **Image Processing**: Intervention Image for photo manipulation and storage
- **File Upload**: Dropzone for drag-and-drop file uploads
- **Spreadsheet Export/Import**: Maatwebsite Excel and PHPOffice for data handling
- **Document Generation**: PHPWord for creating Word documents
- **Email Broadcasting**: MailerSend driver for bulk email delivery
- **UI Components**: Flowbite for pre-built, responsive components
- **Client-side Interactivity**: Alpine.js for reactive components
- **HTTP Requests**: Axios for AJAX communications

## Features

### Public Side (No Authentication Required)

- Browse UMN Medical Center profile and comprehensive information
- Request health equipment lending
- Submit service requests
- View photo gallery
- Submit aspirations and feedback
- Participate in interactive quizzes
- Access information about ALIVE (UMN Medical Center programs)
- Get detailed program details and contact information

### Admin Dashboard

- Profile and facility information management
- Service request management dashboard
- Equipment lending management
- Internal medicine management
- External medicine management
- Patient registration and records management
- Inventory and equipment tracking
- Gallery and media management
- Quiz creation and administration
- Aspiration and feedback management

### Superadmin Dashboard

- Full access to all admin functionalities
- User account management and role assignment
- Bulk email broadcast capabilities
- System-wide settings and configuration
- Advanced reporting and analytics access

## Installation & Setup

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 20 or higher
- NPM
- MySQL or MariaDB
- Git
- PowerShell 5.1 (for Windows users)

### Step 1: Clone Repository

```bash
git clone <repository-url>
cd umn-medical-center
```

### Step 2: Install Dependencies

```bash
composer install
npm install
```

### Step 3: Environment Configuration

Copy the example environment file and configure your database credentials:

```bash
cp .env.example .env
```

Edit `.env` file with your database configuration:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=umn_medical_center
DB_USERNAME=root
DB_PASSWORD=your_password
```

Generate application key:

```bash
php artisan key:generate
```

### Step 4: Build Assets

For Windows users (if Laravel and Tailwind installation encounters issues):

```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope Process
.\fix-laravel-tailwind.ps1
```

Build Tailwind CSS for the project:

```bash
npm run build
```

Enable Tailwind CSS development mode:

```bash
npm run dev
```

### Step 5: Database Setup

Run migrations to create tables:

```bash
php artisan migrate
```

Seed initial data:

```bash
php artisan db:seed
```

If foreign key conflicts occur, reset database with migrations:

```bash
php artisan migrate:fresh
```

### Step 6: Storage Configuration

Create symbolic link for file storage (optional but recommended for file uploads):

```bash
php artisan storage:link
```

If storage link causes issues, remove and recreate:

```bash
rm public/storage
php artisan storage:link
```

### Step 7: Start Development Server

Launch the application on localhost:

```bash
php artisan serve
```

The application will be accessible at `http://127.0.0.1:8000`

## Optimization Commands (Optional)

If you encounter middleware or performance issues, run these optimization commands:

```bash
composer dump-autoload
php artisan route:cache
php artisan config:cache
php artisan view:cache
php artisan optimize
```

To clear caches:

```bash
php artisan optimize:clear
```

## Project Structure

```
app/
├── Exports/
├── Helpers/
├── Http/
├── Imports/
├── Mail/
├── Models/
├── Providers/
├── View/
│   ├── Controllers/
│   ├── Middleware/
│   ├── Requests/
│   │   ├── Auth/
│   │   ├── Quiz/
│   │   ├── Auth/
│   ├── Quiz/
│   ├── Components/

bootstrap/
├── cache/

config/

database/
├── factories/
├── migrations/
├── seeders/

public/
├── alive/
├── assets/
├── build/
├── storage/
├── uploads/
│   ├── assets/
│   ├── 1JPG/
│   ├── about/
│   ├── foto/
│   ├── logo/
│   ├── mascot/
│   ├── organigram/
│   ├── program/
│   │   ├── about/
│   │   ├── anomali/
│   │   ├── foto/
│   │   ├── logo/
│   │   ├── mascot/
│   │   ├── organigram/
│   │   ├── program/
│   │   ├── compressed (1)/
│   ├── assets/

resources/
├── css/
├── js/
├── views/
│   ├── auth/
│   ├── components/
│   ├── emails/
│   ├── layouts/
│   ├── pages/
│   ├── profile/
│   ├── vendor/
│   │   ├── alive/
│   │   ├── aspirasi/
│   │   ├── category/
│   │   ├── gallery/
│   │   ├── medicine/
│   │   ├── quiz_admin/
│   │   ├── quiz_public/
│   │   ├── service/
│   │   ├── partials/
│   │   ├── pagination/

routes/

storage/
├── app/
├── framework/
├── logs/
│   ├── public/
│   │   ├── uploads/
│   │   │   ├── Foto Pelatihan 1/
│   │   │   ├── Foto Pengajuan Jasa/
│   │   │   ├── Foto Pertemuan Perdana/
│   ├── cache/
│   ├── sessions/
│   ├── testing/
│   ├── views/
│   │   ├── laravel-excel/

tests/
├── Feature/
├── Unit/
│   ├── Auth/

.env.example
composer.json
package.json
vite.config.js
tailwind.config.js
postcss.config.js
README.md
```

## User Roles & Access Control

### Public User
- No authentication required
- Read-only access to public information
- Submit equipment lending requests
- Submit service requests
- Submit aspirations and feedback
- Complete quizzes

### Admin
- Full administrative access
- Request and record management
- Inventory management
- Patient data management
- Content management
- No user account creation capability

### Superadmin
- All admin privileges
- User account management
- Role assignment and permissions
- Bulk email broadcasting
- System-wide configuration
- Complete audit access

## Common Issues & Solutions

### Laravel and Tailwind Installation Issues

If you encounter issues during Laravel or Tailwind setup, run the PowerShell script:

```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope Process
.\fix-laravel-tailwind.ps1
```

### Database Foreign Key Errors

Use fresh migration to reset and rebuild the database:

```bash
php artisan migrate:fresh
php artisan db:seed
```

### Storage Link Problems

Remove the existing link and recreate it:

```bash
rm public/storage
php artisan storage:link
```

#### Cache Issues

Clear all caches if experiencing unexpected behavior:

```bash
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## File Handling & Image Processing

The application uses Intervention Image for photo processing and Dropzone for file uploads.

### Image Processing

Images are processed and optimized using Intervention Image library. Images uploaded through the gallery and profile management are automatically processed according to the application's specifications.

### File Uploads

The application uses Dropzone for drag-and-drop file upload functionality. Ensure proper storage permissions:

```bash
php artisan storage:link
chmod -R 755 storage/app/public
chmod -R 755 bootstrap/cache
```

## Email Broadcasting

The application uses MailerSend for bulk email delivery to users. Configure your MailerSend API credentials in `.env`:

```
MAIL_MAILER=mailersend
MAILERSEND_API_KEY=your_api_key_here
```

Superadmin users can access the email broadcast feature from the admin dashboard.

## Development Workflow

1. Start the development server in one terminal: `php artisan serve`
2. In another terminal, start Vite development server with Tailwind CSS watch: `npm run dev`
3. Access the application at `http://localhost:8000`
4. Make your code changes - Vite will automatically rebuild on file changes
5. Test locally before committing

For production build:

```bash
npm run build
```

This compiles and minifies assets for deployment.

## Database Seeding

The application includes database seeders for initial setup. After running migrations:

```bash
php artisan db:seed
```

This populates the database with default data for roles, permissions, and sample information.

## Testing

The project uses Pest for testing. Run the test suite:

```bash
./vendor/bin/pest
```

Run tests with coverage:

```bash
./vendor/bin/pest --coverage
```

Tests are located in the `tests/` directory.

## API Integration

The application provides RESTful API endpoints protected with Laravel Sanctum token authentication. API routes are defined in `routes/api.php`.

### Authentication

API requests require a Sanctum token in the Authorization header:

```
Authorization: Bearer {token}
```

Tokens are issued upon login and can be revoked as needed.

## Deployment

For production deployment:

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Run optimization commands before deploying
3. Ensure proper file permissions on storage and bootstrap/cache directories
4. Use a production-grade database server
5. Configure proper environment variables for production
6. Set up HTTPS/SSL certificates
7. Configure web server (Nginx/Apache) properly

## Environment Variables Reference

Key environment variables to configure:

```
APP_NAME=UMN Medical Center
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=umn_medical_center
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
```

## Support & Documentation

- **Laravel Documentation**: https://laravel.com/docs
- **Tailwind CSS Documentation**: https://tailwindcss.com/docs
- **Vite Documentation**: https://vitejs.dev/
- **Alpine.js Documentation**: https://alpinejs.dev/
- **Flowbite Components**: https://flowbite.com/
- **Laravel Sanctum**: https://laravel.com/docs/sanctum
- **Intervention Image**: https://image.intervention.io/
- **Maatwebsite Excel**: https://laravel-excel.com/

## License

This project is proprietary software for Universitas Multimedia Nusantara (UMN). Unauthorized copying or distribution is prohibited.

## Contact

For technical support or inquiries regarding UMN Medical Center Gen 11, please contact the development team.

---

**Last Updated**: January 2025
**Version**: 1.0.0
**Laravel Version**: 11.0
**Node Version**: 20+
**PHP Version**: 8.2+
