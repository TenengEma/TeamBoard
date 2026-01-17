# TeamBoard - Intranet Management System

## Project Overview
TeamBoard is a comprehensive Laravel-based intranet management system designed for employee directory and notice board management. This application incorporates modern web development practices with a clean, professional UI.

## Design System

### Color Palette
- **Primary Color**: #347486 (Teal Blue)
- **Secondary Color**: #FFFFFF (White)
- **Accent Color 1**: #DFA44D (Golden)
- **Accent Color 2**: #BC4626 (Terracotta)

### Typography
- **Font Family**: Google Fonts (Inter/Poppins for modern, professional look)

### Animations
- **Library**: Lottie for smooth, lightweight animations

## Technology Stack
- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates, Tailwind CSS/Custom CSS
- **JavaScript**: Vanilla JS + Lottie
- **Database**: MySQL
- **Authentication**: Laravel Breeze/Custom Auth

## Database Schema

### Users Table
- `id` (PK) - Primary Key
- `name` - User's full name
- `email` (unique) - Email address
- `password` - Hashed password
- `role` - enum('admin', 'user')
- `timestamps` - created_at, updated_at

### Employees Table
- `id` (PK) - Primary Key
- `name` - Employee's full name
- `email` (unique) - Email address
- `department` - Department name
- `phone_number` - Contact number
- `photo_path` - Profile photo path
- `biographical_information` - Employee bio (text)
- `timestamps` - created_at, updated_at

### Notices Table
- `id` (PK) - Primary Key
- `title` - Notice title
- `content_body` - Notice content (text/longtext)
- `author_id` (FK) - Foreign key to users table
- `priority` - enum('low', 'medium', 'high')
- `timestamps` - created_at, updated_at

### Documents Table
- `id` (PK) - Primary Key
- `title` - Document title
- `filename` - Original filename
- `filepath` - Storage path
- `uploader_id` (FK) - Foreign key to users table
- `timestamps` - created_at, updated_at

## Implementation Phases

### Phase 1: Foundation (Weeks 1-4)
**Goals**: User authentication and basic layout
- [x] Project initialization
- [ ] User authentication (login/logout)
- [ ] Basic layout with sidebar and navbar
- [ ] Dashboard landing page
- [ ] Color scheme implementation
- [ ] Google Fonts integration
- [ ] Lottie animations setup

### Phase 2: Employee Directory (Weeks 5-7)
**Goals**: Complete employee management system
- [ ] Employee listing with pagination
- [ ] Search functionality
- [ ] Individual employee profiles
- [ ] Department filtering
- [ ] Photo upload functionality
- [ ] CRUD operations for employees

### Phase 3: Notice Board (Weeks 8-10)
**Goals**: Full notice board functionality
- [ ] Create notices
- [ ] Read/view notices
- [ ] Update notices
- [ ] Delete notices
- [ ] Priority level system
- [ ] Author information display
- [ ] Notice filtering and sorting

### Phase 4: Testing & Security (Weeks 11-12)
**Goals**: Ensure application security and reliability
- [ ] Unit tests for models
- [ ] Feature tests for authentication
- [ ] Feature tests for notice board
- [ ] Security measures implementation
- [ ] Input validation
- [ ] CSRF protection
- [ ] SQL injection prevention

### Phase 5: Advanced Features (Weeks 13-15)
**Goals**: Document sharing and administration
- [ ] Document upload functionality
- [ ] Document listing and download
- [ ] Administrative panel
- [ ] User management
- [ ] Role-based access control
- [ ] Activity logging
- [ ] Deployment preparation

## Key Features

### Authentication System
- Secure login/logout
- Password hashing
- Session management
- Remember me functionality
- Password reset (optional)

### Dashboard
- Statistics overview
- Recent notices
- Quick actions
- User profile summary

### Sidebar Navigation
- Responsive design
- Active state indicators
- Role-based menu items
- Collapsible on mobile

### Navbar
- User profile dropdown
- Notifications (optional)
- Search functionality
- Logout button

### Employee Directory
- Grid/list view toggle
- Advanced search
- Department filter
- Alphabetical sorting
- Profile cards with photos

### Notice Board
- Priority badges (color-coded)
- Rich text content
- Author attribution
- Timestamp display
- Edit/delete controls (for admins/authors)

### Document Sharing
- File upload with validation
- Download functionality
- File type restrictions
- Storage management

### Admin Panel
- User management
- System settings
- Content moderation
- Analytics dashboard

## File Structure
```
teamboard/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── LogoutController.php
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
│   ├── migrations/
│   │   ├── xxxx_add_role_to_users_table.php
│   │   ├── xxxx_create_employees_table.php
│   │   ├── xxxx_create_notices_table.php
│   │   └── xxxx_create_documents_table.php
│   └── seeders/
│       ├── UserSeeder.php
│       ├── EmployeeSeeder.php
│       └── NoticeSeeder.php
├── resources/
│   ├── css/
│   │   └── app.css (with custom colors)
│   ├── js/
│   │   ├── app.js
│   │   └── lottie-loader.js
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   ├── sidebar.blade.php
│       │   └── navbar.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── dashboard.blade.php
│       ├── employees/
│       │   ├── index.blade.php
│       │   ├── show.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── notices/
│       │   ├── index.blade.php
│       │   ├── show.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── documents/
│       │   └── index.blade.php
│       └── admin/
│           └── index.blade.php
└── routes/
    └── web.php
```

## Development Notes

### Security Considerations
- All forms must include CSRF tokens
- Input validation on all user inputs
- File upload validation (type, size)
- Role-based authorization for sensitive actions
- SQL injection prevention through Eloquent ORM
- XSS protection through Blade escaping

### Performance Optimization
- Database indexing on frequently queried columns
- Eager loading to prevent N+1 queries
- Image optimization for employee photos
- Pagination for large datasets
- Caching for frequently accessed data

### Best Practices
- Follow Laravel naming conventions
- Use Eloquent relationships
- Implement repository pattern for complex queries
- Write descriptive commit messages
- Comment complex logic
- Keep controllers thin, use service classes
- Validate all inputs
- Use database transactions where needed

## Testing Strategy
- Unit tests for model methods
- Feature tests for all CRUD operations
- Authentication flow testing
- Authorization testing
- File upload testing
- Database rollback after tests

## Deployment Checklist
- [ ] Environment variables configured
- [ ] Database migrations run
- [ ] Storage directory permissions set
- [ ] Cache and config cleared
- [ ] SSL certificate installed
- [ ] Backups configured
- [ ] Error logging configured
- [ ] Performance monitoring setup
