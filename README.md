# Global Export Solutions - B2B Product Catalogue

A professional B2B product catalogue website built with **CodeIgniter 4**, **PHP 8.2+**, **MySQL**, **Bootstrap 5**, and **jQuery**. Designed for manufacturers, exporters, and bulk suppliers to showcase products and receive enquiries.

## Features

- Responsive frontend with SEO-friendly URLs
- Product categories, listings, detail pages with dynamic specifications
- Product image gallery with lightbox
- AJAX enquiry forms with email notifications
- Secure admin panel with authentication
- Admin modules: Product Category, Product Details, Product Enquiry
- Image upload with validation, resize, and WebP generation
- XML sitemap, robots.txt, schema markup
- Sample data seeder with 4 categories and 16 products

## Requirements

- PHP 8.2 or higher
- MySQL 8.0 or higher
- Composer
- Apache/Nginx with mod_rewrite (or PHP built-in server)
- GD or Imagick extension (recommended for image processing)

## Installation

### 1. Clone the project

```bash
git clone <repository-url> productwebsite
cd productwebsite
```

### 2. Install dependencies

```bash
composer install
```

### 3. Create MySQL database

```sql
CREATE DATABASE product_catalogue CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

### 4. Configure environment

Copy the environment file if needed and update settings:

```bash
cp env .env
```

Edit `.env` and configure:

```ini
app.baseURL = 'http://localhost:8080/'
app.siteName = 'Global Export Solutions'

database.default.hostname = localhost
database.default.database = product_catalogue
database.default.username = root
database.default.password = your_password

email.protocol = smtp
email.SMTPHost = smtp.example.com
email.SMTPUser = your-email@example.com
email.SMTPPass = your-smtp-password
email.SMTPPort = 587
email.SMTPCrypto = tls
email.fromEmail = noreply@example.com
email.fromName = Global Export Solutions
email.adminEmail = admin@example.com
```

Generate encryption key:

```bash
php spark key:generate
```

### 5. Run migrations

```bash
php spark migrate
```

### 6. Run seeders

```bash
php spark db:seed DatabaseSeeder
```

This creates:
- Admin user: `admin@example.com` / `Admin@123`
- 4 product categories
- 16 sample products with specifications

### 7. Start development server

```bash
php spark serve
```

Visit: http://localhost:8080

## Admin Panel

- URL: http://localhost:8080/admin/login
- Email: `admin@example.com`
- Password: `Admin@123`

**Change the admin password after first login.**

## Project Structure

```
app/
├── Controllers/
│   ├── Home.php
│   ├── Products.php
│   ├── Enquiry.php
│   └── Admin/
├── Models/
├── Views/
│   ├── frontend/
│   └── admin/
├── Filters/
├── Libraries/
├── Helpers/
└── Database/
    ├── Migrations/
    └── Seeds/
public/
├── assets/
└── uploads/
```

## Public Routes

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/` | Home page |
| GET | `/about` | About page |
| GET | `/contact` | Contact page |
| GET | `/products` | All products |
| GET | `/products/{slug}` | Category products |
| GET | `/product/{slug}` | Product detail |
| POST | `/enquiry/submit` | Submit enquiry |
| GET | `/sitemap.xml` | XML sitemap |

## Admin Routes

| URL | Description |
|-----|-------------|
| `/admin/login` | Admin login |
| `/admin/dashboard` | Dashboard |
| `/admin/categories` | Category management |
| `/admin/products` | Product management |
| `/admin/enquiries` | Enquiry management |

## Security

- CSRF protection on all forms
- Password hashing with PHP `password_hash()`
- Admin authentication filter with session timeout
- Secure file upload validation (type, size, MIME)
- Upload directory script execution blocked via `.htaccess`
- XSS protection via CodeIgniter escaping

## Apache/XAMPP Setup

Point your virtual host document root to the `public` folder:

```
DocumentRoot "C:/xampp/htdocs/productwebsite/public"
```

Ensure `mod_rewrite` is enabled.

## License

MIT License
