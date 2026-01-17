# TeamBoard - Intranet Management System

A comprehensive Laravel-based intranet management system designed for employee directory and notice board management. This application features modern design with custom color scheme, Google Fonts, and Lottie animations.

## 🎨 Design Features

- **Primary Color**: #347486 (Teal Blue)
- **Secondary Color**: #FFFFFF (White)
- **Accent Colors**: #DFA44D (Golden), #BC4626 (Terracotta)
- **Typography**: Google Fonts (Inter & Poppins)
- **Animations**: Lottie for smooth, lightweight animations

## ✨ Features

### Authentication System
- ✅ User registration and login
- ✅ Password hashing with bcrypt
- ✅ Remember me functionality
- ✅ Session management
- ✅ Role-based access control (Admin/User)

### Dashboard
- ✅ Statistics overview (employees, notices, documents, users)
- ✅ Recent notices display
- ✅ Recent documents display
- ✅ Quick actions panel
- ✅ Responsive grid layout

### Employee Directory
- ✅ Full CRUD operations
- ✅ Search functionality (name, email, department)
- ✅ Department filtering
- ✅ Photo upload support
- ✅ Profile pages with biographical information
- ✅ Grid view with profile cards
- ✅ Pagination

### Notice Board
- ✅ Create, read, update, delete notices
- ✅ Priority system (Low, Medium, High) with color-coded badges
- ✅ Author attribution
- ✅ Search and filter by priority
- ✅ Rich content display
- ✅ Authorization (authors and admins can edit/delete)

### Document Sharing
- ✅ File upload (PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT)
- ✅ Download functionality
- ✅ File type and size validation (max 10MB)
- ✅ Search functionality
- ✅ Uploader information
- ✅ Authorization controls

### Admin Panel
- ✅ User management (create, edit, delete users)
- ✅ Role assignment (admin/user)
- ✅ System statistics dashboard
- ✅ Recent users overview
- ✅ Protected by role-based middleware

### UI/UX Features
- ✅ Fully functional sidebar navigation
- ✅ Responsive navbar with user dropdown
- ✅ Active menu state indicators
- ✅ Flash messages for user feedback
- ✅ Smooth transitions and hover effects
- ✅ Mobile-responsive design
- ✅ Form validation with error display
- ✅ Confirmation dialogs for destructive actions

## 🚀 Quick Start

The application is already set up and running! Access it at:

**http://127.0.0.1:8000**

### 👤 Default Login Credentials

**Admin Account:**
- Email: `admin@teamboard.com`
- Password: `password`

**Regular User Accounts:**
- Email: `patience@teamboard.com` | Password: `password` (Patience Nkomo)
- Email: `faith@teamboard.com` | Password: `password` (Faith Nduka)

## 📋 What's Already Done

✅ All database migrations created and run
✅ Models with relationships configured
✅ Controllers with full CRUD operations
✅ Authentication system implemented
✅ Role-based middleware configured
✅ All views created (dashboard, employees, notices, documents, admin)
✅ Custom CSS with color scheme applied
✅ Google Fonts integrated
✅ Lottie animations set up
✅ Database seeded with sample data
✅ Storage symlink created
✅ Assets compiled
✅ Development server running

## 📁 Key Files

### Controllers
- `app/Http/Controllers/Auth/LoginController.php` - Authentication
- `app/Http/Controllers/DashboardController.php` - Dashboard
- `app/Http/Controllers/EmployeeController.php` - Employee management
- `app/Http/Controllers/NoticeController.php` - Notice board
- `app/Http/Controllers/DocumentController.php` - Document sharing
- `app/Http/Controllers/AdminController.php` - Admin panel

### Models
- `app/Models/User.php` - User model with role support
- `app/Models/Employee.php` - Employee model
- `app/Models/Notice.php` - Notice model with priority
- `app/Models/Document.php` - Document model

### Views
- `resources/views/layouts/app.blade.php` - Main layout with sidebar/navbar
- `resources/views/auth/` - Login and registration pages
- `resources/views/dashboard.blade.php` - Dashboard page
- `resources/views/employees/` - Employee directory views
- `resources/views/notices/` - Notice board views
- `resources/views/documents/` - Document sharing views
- `resources/views/admin/` - Admin panel views

### Styling & Assets
- `resources/css/app.css` - Custom CSS with TeamBoard color scheme
- `resources/js/app.js` - JavaScript with Lottie integration
- `routes/web.php` - All application routes with middleware

## 🔐 Security Features

- ✅ CSRF protection on all forms
- ✅ Password hashing with bcrypt
- ✅ Role-based authorization
- ✅ Input validation and sanitization
- ✅ SQL injection prevention (Eloquent ORM)
- ✅ XSS protection (Blade escaping)
- ✅ File upload validation
- ✅ Session security

## 📊 Database Schema

### Users Table
- id (PK), name, email (unique), password (hashed), role (admin/user), timestamps

### Employees Table
- id (PK), name, email (unique), department, phone_number, photo_path, biographical_information, timestamps

### Notices Table
- id (PK), title, content_body, author_id (FK), priority (low/medium/high), timestamps

### Documents Table
- id (PK), title, filename, filepath, uploader_id (FK), timestamps

## 🎯 Usage Guide

### As a Regular User:
1. Login with your credentials
2. View the dashboard with statistics
3. Browse and search the employee directory
4. Create and view notices
5. Upload and download documents

### As an Administrator:
All user features plus:
1. Access the Admin Panel
2. Create, edit, and delete users
3. Assign roles to users
4. Full control over all content

## 🛠️ Development Commands

### Stop/Start Server:
```bash
# Stop (Ctrl+C in the terminal running the server)
# Start
php artisan serve
```

### Watch for asset changes:
```bash
npm run dev
```

### Rebuild assets:
```bash
npm run build
```

### Reset database:
```bash
php artisan migrate:fresh --seed
```

### Clear cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📚 Technologies Used

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates, Custom CSS
- **JavaScript**: Vanilla JS + Lottie Web
- **Database**: MySQL
- **Build Tool**: Vite
- **Animations**: Lottie

## 🎓 Project Information

This project was created as part of the CENP6310 course, implementing a comprehensive intranet management system with:

- **Phase 1**: User authentication, basic layout, and dashboard ✅
- **Phase 2**: Employee directory with search and filtering ✅
- **Phase 3**: Notice board with full CRUD and priority levels ✅
- **Phase 4**: Security and testing implementation ✅
- **Phase 5**: Document sharing and admin panel ✅

## 📝 Sample Data

The database is pre-seeded with:
- **3 users**: 1 admin, 2 regular users with Cameroon names (Patience Nkomo, Faith Nduka)
- **7 employees** across different departments: Lum Aboubacar (IT), Grace Amina (HR), Diego Mensah (Sales), Precious Osei (Marketing), Richard Tende (Finance), Muluh Njuma (Operations), Sandra Eyong (IT)
- **3 sample notices** with different priority levels

## 🎨 Color Reference

```css
Primary: #347486 (Teal Blue)
Secondary: #FFFFFF (White)
Accent 1: #DFA44D (Golden)
Accent 2: #BC4626 (Terracotta)
```

## 📞 Next Steps

The application is fully functional! You can:
1. Login and explore all features
2. Add more employees, notices, and documents
3. Test the search and filter functionality
4. Try the admin panel features
5. Customize the design or add new features

---

**TeamBoard** - Your Complete Intranet Management Solution 🚀

Built with ❤️ using Laravel
