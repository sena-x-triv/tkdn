# TKDN Dashboard

A modern Laravel-based dashboard application with dark mode support, responsive design, and comprehensive user management system.

## 🚀 Features

### Core Features
- **Modern Dashboard Interface**: Clean, responsive design with sidebar navigation
- **Dark Mode Support**: Toggle between light and dark themes
- **User Authentication**: Complete authentication system with registration, login, password reset
- **User Management**: Profile settings and user administration
- **Responsive Design**: Mobile-first approach with collapsible sidebar
- **ULID Support**: Uses ULID for primary keys instead of auto-increment IDs

### UI/UX Features
- **Bootstrap Icons**: Modern iconography throughout the application
- **Custom Styling**: SCSS-based styling with CSS custom properties
- **Smooth Transitions**: Animated sidebar and theme transitions
- **Modern Forms**: Styled form inputs with validation feedback
- **Data Tables**: Responsive tables with sorting and pagination

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite
- Laravel 12.x

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd tkdn
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Database
Edit `.env` file and set your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tkdn_dashboard
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 🗄️ Database Structure

### Users Table
```sql
- id (ULID, Primary Key)
- name (String)
- email (String, Unique)
- email_verified_at (Timestamp, Nullable)
- password (String)
- remember_token (String)
- created_at (Timestamp)
- updated_at (Timestamp)
```

### Sessions Table
```sql
- id (String, Primary Key)
- user_id (ULID, Foreign Key, Nullable)
- ip_address (String, 45 chars, Nullable)
- user_agent (Text, Nullable)
- payload (LongText)
- last_activity (Integer, Indexed)
```

## 🎨 Theme System

### Dark Mode Implementation
The application uses CSS custom properties for theming:

```scss
:root {
  --primary-color: #3b82f6;
  --sidebar-bg: #ffffff;
  --content-bg: #f8fafc;
  --text-color: #1f2937;
}

body.dark {
  --sidebar-bg: #1f2937;
  --content-bg: #111827;
  --text-color: #f9fafb;
}
```

### Color Scheme
- **Primary**: Blue (#3b82f6)
- **Success**: Green (#10b981)
- **Warning**: Yellow (#f59e0b)
- **Danger**: Red (#ef4444)
- **Info**: Cyan (#06b6d4)

## 📱 Responsive Design

### Breakpoints
- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

### Mobile Features
- Collapsible sidebar with hamburger menu
- Touch-friendly navigation
- Optimized form layouts
- Responsive data tables

## 🔐 Authentication System

### Available Routes
- `GET /login` - Login page
- `POST /login` - Process login
- `GET /register` - Registration page
- `POST /register` - Process registration
- `GET /forgot-password` - Password reset request
- `POST /forgot-password` - Send reset email
- `GET /reset-password/{token}` - Password reset form
- `POST /reset-password` - Process password reset
- `POST /logout` - User logout

### Security Features
- CSRF protection on all forms
- Password hashing using Laravel's Hash facade
- Remember me functionality
- Email verification support
- Session management

## 🎯 Usage Guide

### Dashboard Navigation
1. **Sidebar**: Contains main navigation menu
2. **Topbar**: User dropdown, dark mode toggle, mobile menu
3. **Content Area**: Main application content

### User Management
1. **Profile Settings**: Access via user dropdown → Settings
2. **Edit Profile**: Update name, email, and other details
3. **Password Change**: Available in settings page

### Dark Mode
- Toggle dark mode using the moon/sun icon in the topbar
- Theme preference is stored in localStorage
- Automatic theme switching based on system preference

## 🏗️ Project Structure

```
tkdn/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/           # Authentication controllers
│   │   ├── HomeController.php
│   │   ├── SettingsController.php
│   │   └── WorkerController.php
│   ├── Models/
│   │   ├── User.php
│   │   └── Worker.php
│   └── Traits/
│       └── UsesUlid.php    # ULID trait for models
├── resources/
│   ├── views/
│   │   ├── auth/           # Authentication views
│   │   ├── layouts/        # Blade layouts
│   │   ├── settings/       # Settings views
│   │   └── workers/        # Worker management views
│   ├── css/
│   │   └── app.scss        # Main stylesheet
│   └── js/
│       └── app.js          # Main JavaScript file
└── routes/
    └── web.php             # Web routes
```

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Run `php artisan config:cache`
3. Run `php artisan route:cache`
4. Run `php artisan view:cache`
5. Build assets with `npm run build`

### Server Requirements
- PHP >= 8.2 with required extensions
- Web server (Apache/Nginx)
- Database server
- SSL certificate (recommended)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Contact the development team
- Check the Laravel documentation for framework-specific questions

## 🔄 Changelog

### Version 1.0.0
- Initial release
- Complete authentication system
- Dark mode support
- Responsive dashboard design
- User management features
- ULID implementation

---

**Built with ❤️ using Laravel 12**
