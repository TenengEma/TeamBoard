# TeamBoard - Intranet Management System

![TeamBoard](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

A modern, full-featured intranet management system for employee directory, notice board, and document sharing.

## 🌟 Features

### 🔐 Authentication & Authorization
- Secure login and registration system
- Role-based access control (Admin/User)
- Session management with remember me functionality
- Password hashing with Bcrypt

### 📊 Dashboard
- Real-time statistics (employees, notices, documents)
- Recent activity feeds
- Color-coded priority indicators
- Responsive card-based layout

### 👥 Employee Directory
- Full CRUD operations
- Advanced search by name, email, department
- Department filtering
- Photo upload (JPG, PNG)
- Pagination (12 per page)
- Individual employee profiles

### 📢 Notice Board
- Create, read, update, delete notices
- Priority levels: Low, Medium, High
- Color-coded priorities (#347486, #DFA44D, #BC4626)
- Author attribution
- Search and filter functionality
- Authorization (author/admin can edit/delete)

### 📁 Document Sharing
- File upload (PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT)
- Download functionality
- File type icons
- Size validation (max 10MB)
- Uploader information
- Delete authorization

### ⚙️ Admin Panel
- User management dashboard
- Create/Edit/Delete users
- Role assignment
- System statistics
- Restricted to admin role only

## 🎨 Design System

### Color Palette
- **Primary:** `#347486` (Professional Blue)
- **Secondary:** `#FFFFFF` (White)
- **Accent 1:** `#DFA44D` (Gold/Orange)
- **Accent 2:** `#BC4626` (Deep Red/Brown)

### Typography
- **Headings:** Poppins (Google Fonts)
- **Body:** Inter (Google Fonts)

### Animations
- Lottie animations on auth pages
- Smooth transitions and hover effects
- Fade-in/slide-in animations

## 🛠️ Technology Stack

- **Backend:** Laravel 11.x
- **Frontend:** Blade Templates, Tailwind CSS 4.0
- **Database:** SQLite (easily switchable to MySQL/PostgreSQL)
- **Build Tool:** Vite 7.x
- **JavaScript:** Vanilla JS + Lottie-web
- **Testing:** PHPUnit

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM
- SQLite (or MySQL/PostgreSQL)

## 🚀 Installation

### 1. Clone the repository

```bash
git clone https://github.com/TenengEma/TeamBoard.git
cd TeamBoard
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database setup

```bash
php artisan migrate
php artisan db:seed
```

### 5. Create storage link

```bash
php artisan storage:link
```

### 6. Build assets

**Development:**
```bash
npm run dev
```

**Production:**
```bash
npm run build
```

### 7. Start the server

```bash
php artisan serve
```

Visit: **http://localhost:8000**

## 🔐 Default Credentials

After seeding the database:

**Admin Account:**
- Email: `admin@teamboard.com`
- Password: `password`

**User Account:**
- Email: `user@teamboard.com`
- Password: `password`

## 📁 Project Structure

```
teamboard/
├── app/
│   ├── Http/Controllers/    # All CRUD controllers
│   ├── Models/              # Eloquent models
│   └── Middleware/          # Custom middleware (CheckRole)
├── database/
│   ├── migrations/          # Database migrations
│   ├── factories/           # Model factories
│   └── seeders/             # Database seeders
├── resources/
│   ├── css/                 # Tailwind CSS + custom styles
│   ├── js/                  # JavaScript + Lottie
│   └── views/               # Blade templates
├── routes/
│   └── web.php              # Web routes
├── tests/
│   └── Feature/             # Feature tests
└── public/                  # Public assets
```

## 🧪 Testing

Run all tests:
```bash
php artisan test
```

Run specific test:
```bash
php artisan test --filter=AuthenticationTest
```

## 🔒 Security Features

- ✅ CSRF Protection
- ✅ Password Hashing (Bcrypt)
- ✅ Role-Based Access Control
- ✅ Authorization Checks
- ✅ File Upload Validation
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ XSS Prevention (Blade Escaping)
- ✅ Session Security

## 📚 Documentation

- **[Project Setup Guide](PROJECT_SETUP.md)** - Detailed installation instructions
- **[Project Completion](PROJECT_COMPLETION.md)** - Full feature list and deliverables
- **[File Structure](FILE_STRUCTURE.md)** - Complete directory tree
- **[Agent Guide](agent.md)** - Development workflow and best practices

## 🗺️ Routes

### Authentication
- `GET /login` - Login page
- `POST /login` - Login submission
- `GET /register` - Registration page
- `POST /register` - Registration submission
- `POST /logout` - Logout

### Dashboard
- `GET /dashboard` - Main dashboard

### Employees
- `GET /employees` - List employees
- `GET /employees/create` - Create form
- `POST /employees` - Store employee
- `GET /employees/{id}` - View employee
- `GET /employees/{id}/edit` - Edit form
- `PUT /employees/{id}` - Update employee
- `DELETE /employees/{id}` - Delete employee

### Notices
- `GET /notices` - List notices
- `GET /notices/create` - Create form
- `POST /notices` - Store notice
- `GET /notices/{id}` - View notice
- `GET /notices/{id}/edit` - Edit form
- `PUT /notices/{id}` - Update notice
- `DELETE /notices/{id}` - Delete notice

### Documents
- `GET /documents` - List documents
- `GET /documents/create` - Upload form
- `POST /documents` - Store document
- `GET /documents/{id}/download` - Download document
- `DELETE /documents/{id}` - Delete document

### Admin (Admin Only)
- `GET /admin` - Admin dashboard
- `GET /admin/users` - User management
- `GET /admin/users/create` - Create user
- `POST /admin/users` - Store user
- `GET /admin/users/{id}/edit` - Edit user
- `PUT /admin/users/{id}` - Update user
- `DELETE /admin/users/{id}` - Delete user

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced under the MIT License.

## 👨‍💻 Author

**Emmanuel Teneng**
- GitHub: [@TenengEma](https://github.com/TenengEma)

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Lottie Files
- Google Fonts
- Font Awesome

## 📧 Support

For support, email your inquiry or open an issue in the repository.

---

**⭐ If you find this project useful, please consider giving it a star!**
