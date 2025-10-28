# HNG Collaboration Ticket Villa (HCTV) - PHP/Twig Edition

A modern, responsive ticket management system built with **PHP** and **Twig**. This is a PHP/Twig conversion of the React and Vue ticket management app, providing an intuitive interface for creating, tracking, and managing tickets efficiently.

## 🚀 Features

- **Authentication System**
  - Secure user registration and login
  - Protected routes for authenticated users
  - Session management using PHP sessions

- **Ticket Management**
  - Create, read, update, and delete tickets
  - Status tracking (Open, In Progress, Closed)
  - Priority levels (Low, Medium, High)
  - Detailed ticket descriptions and metadata
  - Data persistence using JSON files

- **Dashboard**
  - Real-time statistics
  - Quick overview of ticket status
  - Intuitive data visualization

- **Modern UI/UX**
  - Responsive design for all devices
  - Animated decorative elements
  - Smooth transitions and hover effects
  - Toast notifications for user feedback
  - Accessibility features

## 🛠️ Tech Stack

- **Server Language:** PHP 8.0+
- **Templating Engine:** Twig 3.x
- **Session Management:** PHP Sessions
- **Storage:** JSON file-based (simplified, no database required)
- **CSS:** Custom CSS with CSS Variables
- **Server:** Apache with mod_rewrite

## 📦 Installation

1. Install PHP dependencies:
```bash
cd ticket-app-twig
composer install
```

2. Set up the application:
```bash
# Create necessary directories
mkdir -p data cache assets

# Set proper permissions
chmod 755 data cache
```

3. Start a local server (PHP built-in server):
```bash
php -S localhost:8000
```

Or use Apache with mod_rewrite enabled.

## 🎯 Usage

### Authentication
1. Navigate to `/auth/signup` to create a new account
2. Fill in required details (name, email, password)
3. Upon successful registration, you'll be redirected to the Dashboard
4. Use the same credentials for future logins

### Managing Tickets
- Create new tickets with title, status, priority, and description
- View all tickets in a responsive grid layout
- Delete tickets using provided controls
- Track ticket status and priority

## 💻 Project Structure
```
ticket-app-twig/
├── assets/          # Static assets (CSS, images)
│   ├── style.css
│   └── wave.svg
├── cache/           # Twig template cache
├── data/            # JSON storage files
│   ├── users.json
│   └── tickets.json
├── src/             # PHP source code
│   ├── AuthController.php
│   ├── AuthService.php
│   ├── DashboardController.php
│   ├── Router.php
│   ├── TicketService.php
│   └── TicketsController.php
├── templates/       # Twig templates
│   ├── auth/
│   │   ├── _base.twig
│   │   ├── login.twig
│   │   └── signup.twig
│   ├── base.twig
│   ├── dashboard.twig
│   ├── landing.twig
│   └── tickets.twig
├── .htaccess
├── composer.json
├── index.php
└── README.md
```

## 🎨 Design Features

- **Responsive Layout**
  - Max-width content (1440px)
  - Mobile-first approach
  - Adaptive components

- **Visual Elements**
  - Wavy SVG background
  - Floating decorative circles
  - Smooth animations
  - Clear visual hierarchy

## 🔒 Security & Data

- Protected routes using PHP session management
- Form validation and error handling
- Data persistence using JSON files
- Secure session management

## 🌟 Accessibility

- Semantic HTML structure
- Clear color contrast
- Keyboard navigation support
- Focus management
- ARIA attributes

## 🔧 Development Notes

### Requirements
- PHP 8.0 or higher
- Composer
- Apache with mod_rewrite (or PHP built-in server)

### Current Limitations
- Data persistence limited to JSON files
- No backend API integration
- Basic error handling

### Future Improvements
- Database integration (MySQL/PostgreSQL)
- Enhanced error handling
- Advanced security features
- Performance optimizations

## 🤝 Contributing

Feel free to:
- Report bugs
- Suggest features
- Submit pull requests

## 📱 Browser Support

- All modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile browsers
- Responsive design for all screen sizes

---

Built with ❤️ for HNG Internship

