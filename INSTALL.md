# Installation Guide for ticket-app-twig

## Prerequisites

Install the following:
1. PHP 8.0 or higher
2. Composer (PHP dependency manager)

### Install PHP
```bash
sudo apt install php8.2-cli
```

### Install Composer
```bash
sudo apt install composer
```

## Setup Instructions

1. **Install dependencies:**
```bash
cd ticket-app-twig
composer install
```

2. **Create necessary directories:**
```bash
mkdir -p cache data assets
```

3. **Start the development server:**

Using PHP built-in server:
```bash
php -S localhost:8000
```

Or configure Apache with mod_rewrite enabled.

4. **Access the application:**
Open your browser and navigate to:
- http://localhost:8000

## Project Structure

```
ticket-app-twig/
├── assets/          # Static assets (CSS, images)
│   ├── style.css
│   └── wave.svg
├── cache/           # Twig template cache (auto-generated)
├── data/            # JSON storage files (auto-generated)
│   ├── users.json
│   └── tickets.json
├── src/             # PHP source code
├── templates/       # Twig templates
├── vendor/          # Composer dependencies
├── .htaccess        # Apache rewrite rules
├── composer.json    # Project dependencies
├── index.php        # Entry point
└── README.md        # Full documentation
```

## Features Implemented

✅ User authentication (Login/Signup)
✅ Dashboard with statistics
✅ Ticket creation and management
✅ Ticket deletion
✅ Status tracking
✅ Toast notifications
✅ Responsive design
✅ Protected routes

## Technologies Used

- PHP 8.0+
- Twig 3.x (Template Engine)
- JSON file storage
- PHP Sessions
- Custom CSS

## Notes

- Data is stored in JSON files under the `data/` directory
- Sessions are managed using PHP's built-in session management
- No database required - perfect for demo/development purposes

