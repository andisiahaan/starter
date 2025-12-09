# Laravel Starter Kit

<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel 12"></a>
<a href="#"><img src="https://img.shields.io/badge/Livewire-4.x-FB70A9?style=flat-square&logo=livewire" alt="Livewire 4"></a>
<a href="#"><img src="https://img.shields.io/badge/TailwindCSS-4.x-38B2AC?style=flat-square&logo=tailwind-css" alt="TailwindCSS 4"></a>
<a href="#"><img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat-square&logo=alpine.js" alt="Alpine.js"></a>
<a href="#"><img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="License"></a>
</p>

**Production-ready SaaS Starter Kit** dengan sistem autentikasi lengkap, billing/credit system, admin panel, support tickets, dan multi-channel notifications.

---

## ✨ Fitur Utama

### 🔐 Authentication System
- Email/Password Authentication
- Two-Factor Authentication (2FA) dengan Google Authenticator
- OAuth Login (Google)
- Email Verification
- Password Reset
- Email Change Verification
- User Ban/Suspend System

### 💰 Credit & Billing System
- Credit-based billing system
- Multiple payment methods
- Tripay payment gateway integration
- Product & category management
- Order management
- Transaction history

### 👑 Admin Panel
- Dashboard dengan statistik
- User management (CRUD, ban/unban, impersonation)
- Role & Permission management (Spatie)
- Product & category management
- Order management
- Credit log monitoring
- CMS (Pages, News)
- Support ticket management

### 🎫 Support System
- Ticket-based support
- Threaded replies
- Status management
- Real-time notifications

### 🔔 Notification System
- Database notifications
- Email notifications
- WebPush notifications
- User notification preferences
- Admin notification settings

### 🌐 API System
- RESTful API dengan Laravel Sanctum
- Token-based authentication
- Token ability management
- User API token management

### 📝 Content Management
- Static pages (Terms, Privacy, dll.)
- News & announcements
- SEO-friendly URLs

---

## 🛠️ Technology Stack

| Layer | Technology | Version |
|-------|------------|---------|
| Backend | Laravel | 12.x |
| Realtime | Livewire | 4.x |
| Styling | TailwindCSS | 4.x |
| JavaScript | Alpine.js | 3.x |
| Build Tool | Vite | 7.x |
| Auth | Sanctum, Socialite | Latest |
| RBAC | Spatie Permission | 6.x |

---

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL / PostgreSQL / SQLite

---

## 🚀 Installation

### 1. Clone Repository

```bash
git clone <repository-url> my-project
cd my-project
```

### 2. Quick Setup (Recommended)

```bash
composer setup
```

Ini akan menjalankan:
- `composer install`
- Copy `.env.example` ke `.env`
- Generate application key
- Run migrations
- `npm install`
- `npm run build`

### 3. Manual Setup

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env then run migrations
php artisan migrate

# Install Node dependencies
npm install

# Build assets
npm run build
```

### 4. Configure Environment

Edit `.env` file:

```env
# Application
APP_NAME="Your App Name"
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Queue (untuk notifications)
QUEUE_CONNECTION=database

# Mail
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password

# Google OAuth (optional)
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI=http://localhost/login/google/callback

# WebPush (optional)
VAPID_PUBLIC_KEY=your-public-key
VAPID_PRIVATE_KEY=your-private-key
```

---

## 💻 Development

### Start Development Server

```bash
composer dev
```

Ini akan menjalankan secara bersamaan:
- 🌐 `php artisan serve` - Laravel server
- 📮 `php artisan queue:listen` - Queue worker  
- 📋 `php artisan pail` - Real-time logs
- ⚡ `npm run dev` - Vite dev server

### Run Tests

```bash
composer test
```

---

## 📁 Project Structure

```
├── app/
│   ├── Enums/              # Application enums
│   ├── Helpers/            # Helper functions
│   ├── Http/               # Controllers & Middleware
│   ├── Livewire/
│   │   ├── Admin/          # Admin panel components (37)
│   │   └── App/            # User dashboard components (29)
│   ├── Models/             # Eloquent models (14)
│   ├── Notifications/      # Notification classes (13)
│   ├── Observers/          # Model observers
│   ├── Services/           # Business logic services
│   └── Traits/             # Reusable traits
├── config/                 # Configuration files
├── database/
│   └── migrations/         # Database migrations (29)
├── resources/views/
│   ├── admin/              # Admin panel views
│   ├── auth/               # Authentication views
│   └── livewire/           # Livewire component views
└── routes/
    ├── web.php             # Public & auth routes
    ├── admin.php           # Admin panel routes
    ├── app.php             # User dashboard routes
    └── api.php             # API routes
```

---

## 🔑 Default Routes

| Route | Description |
|-------|-------------|
| `/` | Landing page |
| `/login` | Login page |
| `/register` | Registration page |
| `/app` | User dashboard |
| `/app/account` | Account settings |
| `/app/credits` | Credit management |
| `/app/orders` | Order history |
| `/app/tickets` | Support tickets |
| `/admin` | Admin dashboard |
| `/admin/users` | User management |
| `/admin/roles` | Role management |
| `/admin/settings` | Application settings |

---

## 📦 Key Packages

| Package | Purpose |
|---------|---------|
| `livewire/livewire` | Full-stack framework |
| `spatie/laravel-permission` | Roles & permissions |
| `spatie/laravel-activitylog` | Activity logging |
| `laravel/sanctum` | API authentication |
| `laravel/socialite` | OAuth authentication |
| `pragmarx/google2fa-laravel` | Two-factor auth |
| `laravel-notification-channels/webpush` | Push notifications |

---

## 🔔 Notification Setup

Lihat [NOTIFICATION_SETUP.md](NOTIFICATION_SETUP.md) untuk dokumentasi lengkap sistem notifikasi.

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
