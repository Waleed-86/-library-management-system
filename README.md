# 📚 Library Management System

A professional Library Management System built with **Laravel 13** and **MySQL**.

![Laravel](https://img.shields.io/badge/Laravel-13-red)
![PHP](https://img.shields.io/badge/PHP-8.3-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)
![License](https://img.shields.io/badge/License-MIT-green)

---

## ✨ Features

### 👨‍💼 Admin Panel

- ✅ Secure Admin Dashboard with statistics
- ✅ Add, Edit, Delete Books (with cover image upload)
- ✅ View all student book requests
- ✅ Approve or Reject book requests
- ✅ Mark books as returned
- ✅ Automatic fine calculation (Rs. 50/day after 7 days)

### 👨‍🎓 Student Panel

- ✅ Browse all available books
- ✅ Search books by Title, Author or Genre
- ✅ Request books (maximum 3 at a time)
- ✅ Track request status (Pending/Approved/Rejected)
- ✅ View borrowing history with fine details

### 🔐 Security

- ✅ Email verification for new accounts
- ✅ Admin middleware protection
- ✅ Role-based access control
- ✅ CSRF protection on all forms

---

## 🛠️ Tech Stack

| Technology      | Version |
| --------------- | ------- |
| PHP             | 8.3     |
| Laravel         | 13      |
| MySQL           | 8.0     |
| Bootstrap       | 5.3     |
| Bootstrap Icons | 1.10    |

---

## ⚙️ Installation

### Requirements

- PHP 8.2+
- Composer
- MySQL
- Node.js 22+

### Steps

**1. Clone the repository**

```bash
git clone https://github.com/Waleed-86/-library-management-system.git
cd -library-management-system
```

**2. Install dependencies**

```bash
composer install
npm install
```

**3. Setup environment**

```bash
cp .env.example .env
php artisan key:generate
```

**4. Configure database in `.env`**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

**5. Run migrations**

```bash
php artisan migrate
```

**6. Create storage link**

```bash
php artisan storage:link
```

**7. Build assets**

```bash
npm run dev
```

**8. Start server**

```bash
php artisan serve
```

**9. Make yourself admin**

```bash
php artisan tinker
App\Models\User::where('email', 'your@email.com')->update(['is_admin' => true]);
```

---

## 📧 Mail Configuration

Add these to your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your@gmail.com
MAIL_FROM_NAME="Library System"
```

---

## 📸 Screenshots

### Admin Dashboard

![Admin Dashboard](screenshots/admin-dashboard.png)

### Browse Books

![Browse Books](screenshots/browse-books.png)

---

## 👨‍💻 Developer

**Waleed**

- GitHub: [@Waleed-86](https://github.com/Waleed-86)
- Email: engrwaleed86@gmail.com

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).
