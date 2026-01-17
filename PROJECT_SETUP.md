# TeamBoard - Project Setup Guide

## 📋 Overview

This guide will walk you through setting up the TeamBoard project on your local machine.

---

## 🛠️ Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** >= 8.2
- **Composer** (PHP Dependency Manager)
- **Node.js** >= 18.x and **NPM**
- **MySQL** >= 8.0
- **Git**

---

## 📦 Installation Steps

### 1. Clone or Navigate to Project

```bash
cd C:\Users\EMMANUELA-T\Desktop\TEAMBOARD\teamboard
```

### 2. Install PHP Dependencies

```bash
composer install
```

This will install all Laravel and PHP packages defined in `composer.json`.

### 3. Install Node.js Dependencies

```bash
npm install
```

This installs:
- Vite (Build tool)
- Tailwind CSS
- Lottie-web (Animations)
- Axios

### 4. Environment Configuration

The `.env` file should already exist. If not, copy from `.env.example`:

```bash
copy .env.example .env
```

**Important `.env` Configuration:**

```env
APP_NAME=TeamBoard
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=teamboard
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

This creates a secure encryption key for the application.

### 6. Create Database

Open MySQL and create the database:

```sql
CREATE DATABASE teamboard CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Or use phpMyAdmin/MySQL Workbench to create a database named `teamboard`.

### 7. Run Migrations

Run all database migrations to create tables:

```bash
php artisan migrate
```

This will create:
- `users` table
- `employees` table
- `notices` table
- `documents` table
- Other system tables (cache, jobs, etc.)

### 8. Seed Database (Optional)

Populate the database with sample data:

```bash
php artisan db:seed
```

This creates:
- Admin user: `admin@teamboard.com` / `password`
- Regular user: `user@teamboard.com` / `password`
- Sample employees, notices, and documents

### 9. Create Storage Link

Create a symbolic link for file storage:

```bash
php artisan storage:link
```

This allows uploaded files (employee photos, documents) to be publicly accessible.

### 10. Build Frontend Assets

Compile CSS and JavaScript:

**For Development:**
```bash
npm run dev
```

**For Production:**
```bash
npm run build
```

### 11. Start Development Server

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

---

## 🔐 Default Login Credentials

After seeding, use these credentials:

**Admin Account:**
- Email: `admin@teamboard.com`
- Password: `password`

**User Account:**
- Email: `user@teamboard.com`
- Password: `password`

---

## 🗂️ Project Structure

```
teamboard/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   └── LoginController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── EmployeeController.php
│   │   │   ├── NoticeController.php
│   │   │   ├── DocumentController.php
│   │   │   └── AdminController.php
│   │   └── Middleware/
│   │       └── CheckRole.php
│   └── Models/
│       ├── User.php
│       ├── Employee.php
│       ├── Notice.php
│       └── Document.php
├── database/
│   └── migrations/
│       ├── 2026_01_17_100000_modify_users_table.php
│       ├── 2026_01_17_100001_create_employees_table.php
│       ├── 2026_01_17_100002_create_notices_table.php
│       └── 2026_01_17_100003_create_documents_table.php
├── resources/
│   ├── css/
│   │   └── app.css (Custom styles with brand colors)
│   ├── js/
│   │   └── app.js (Lottie integration)
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       ├── dashboard.blade.php
│       ├── employees/
│       ├── notices/
│       ├── documents/
│       └── admin/
├── routes/
│   └── web.php
├── tests/
│   └── Feature/
│       ├── AuthenticationTest.php
│       └── NoticeTest.php
└── storage/
    └── app/
        └── public/
            └── documents/
```

---

## 🎨 Design System

### Color Palette

```css
Primary: #347486 (Professional Blue)
Secondary: #FFFFFF (White)
Accent 1: #DFA44D (Gold/Orange)
Accent 2: #BC4626 (Deep Red/Brown)
```

### Typography

- **Headings:** Poppins (Google Fonts)
- **Body Text:** Inter (Google Fonts)

### Animations

- **Lottie animations** for loading states, empty states, and auth pages

---

## 🧪 Testing

Run all tests:

```bash
php artisan test
```

Run specific test file:

```bash
php artisan test --filter=AuthenticationTest
```

Run with coverage (requires Xdebug):

```bash
php artisan test --coverage
```

---

## 📁 Database Schema

### Users Table
- `id` (Primary Key)
- `name` (String)
- `email` (String, Unique)
- `password` (Hashed)
- `role` (Enum: admin, user)
- `timestamps`

### Employees Table
- `id` (Primary Key)
- `name` (String)
- `email` (String, Unique)
- `department` (String)
- `phone_number` (String, Nullable)
- `photo_path` (String, Nullable)
- `biographical_information` (Text, Nullable)
- `timestamps`

### Notices Table
- `id` (Primary Key)
- `title` (String)
- `content_body` (Text)
- `author_id` (Foreign Key → users.id)
- `priority` (Enum: low, medium, high)
- `timestamps`

### Documents Table
- `id` (Primary Key)
- `title` (String)
- `filename` (String)
- `filepath` (String)
- `uploader_id` (Foreign Key → users.id)
- `timestamps`

---

## 🚀 Available Routes

### Guest Routes
- `GET /` → Redirects to login
- `GET /login` → Login page
- `POST /login` → Login form submission
- `GET /register` → Register page
- `POST /register` → Register form submission

### Authenticated Routes
- `GET /dashboard` → Dashboard
- `POST /logout` → Logout

**Employees:**
- `GET /employees` → List all employees
- `GET /employees/create` → Create employee form
- `POST /employees` → Store employee
- `GET /employees/{id}` → View employee
- `GET /employees/{id}/edit` → Edit employee form
- `PUT /employees/{id}` → Update employee
- `DELETE /employees/{id}` → Delete employee

**Notices:**
- `GET /notices` → List all notices
- `GET /notices/create` → Create notice form
- `POST /notices` → Store notice
- `GET /notices/{id}` → View notice
- `GET /notices/{id}/edit` → Edit notice form
- `PUT /notices/{id}` → Update notice
- `DELETE /notices/{id}` → Delete notice

**Documents:**
- `GET /documents` → List all documents
- `GET /documents/create` → Upload document form
- `POST /documents` → Store document
- `GET /documents/{id}` → View document
- `GET /documents/{id}/download` → Download document
- `DELETE /documents/{id}` → Delete document

**Admin Panel (Admin Only):**
- `GET /admin` → Admin dashboard
- `GET /admin/users` → User management
- `GET /admin/users/create` → Create user form
- `POST /admin/users` → Store user
- `GET /admin/users/{id}/edit` → Edit user form
- `PUT /admin/users/{id}` → Update user
- `DELETE /admin/users/{id}` → Delete user

---

## 🛡️ Security Features

1. **CSRF Protection** - All forms include CSRF tokens
2. **Password Hashing** - Bcrypt hashing for passwords
3. **Role-Based Access Control** - Admin and User roles
4. **Authorization Checks** - Users can only edit/delete their own content
5. **File Upload Validation** - MIME type and size checks
6. **SQL Injection Prevention** - Eloquent ORM parameterized queries

---

## 🔧 Common Commands

```bash
# Clear application cache
php artisan cache:clear

# Clear config cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Recreate database (WARNING: Deletes all data)
php artisan migrate:fresh --seed

# Create a new migration
php artisan make:migration create_table_name

# Create a new model with controller and migration
php artisan make:model ModelName -mcr

# Run Tinker (Interactive shell)
php artisan tinker
```

---

## 📝 Development Workflow

1. **Feature Development:**
   - Create feature branch: `git checkout -b feature/feature-name`
   - Develop feature
   - Write tests
   - Commit changes
   - Merge to develop branch

2. **Database Changes:**
   - Create migration: `php artisan make:migration`
   - Edit migration file
   - Run migration: `php artisan migrate`

3. **Frontend Changes:**
   - Edit CSS in `resources/css/app.css`
   - Edit JS in `resources/js/app.js`
   - Run `npm run dev` for hot reload

---

## 🐛 Troubleshooting

### Issue: "Class not found" Error
**Solution:** Run `composer dump-autoload`

### Issue: "No such table" Error
**Solution:** Run `php artisan migrate`

### Issue: Storage link not working
**Solution:** Run `php artisan storage:link`

### Issue: CSS/JS not loading
**Solution:** Run `npm run build` and refresh browser

### Issue: Permission denied on storage
**Solution (Windows):** Check folder permissions
**Solution (Linux/Mac):** Run `chmod -R 775 storage bootstrap/cache`

---

## 📞 Support

For issues or questions, refer to:
- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Lottie Files](https://lottiefiles.com/)

---

## 📅 Next Steps

1. ✅ Complete project setup
2. ✅ Run migrations
3. ✅ Seed database
4. ✅ Test authentication
5. ✅ Test CRUD operations for Employees, Notices, Documents
6. ✅ Test admin panel functionality
7. ✅ Run automated tests
8. 🔄 Deploy to production (future)

---

**Last Updated:** January 17, 2026  
**Version:** 1.0  
