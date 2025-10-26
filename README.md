# Ticket Management System (Twig Implementation)

A robust ticket management web application built using PHP and Twig templating engine.

## Features

- Landing page with wavy background and decorative elements
- User authentication (Login/Signup) with localStorage
- Dashboard with ticket statistics
- Full CRUD functionality for tickets
- Responsive design with max-width 1440px
- Consistent layout and design across all pages

## Technologies Used

- PHP 7.4+
- Twig Template Engine
- Tailwind CSS
- Bramus Router
- LocalStorage for data persistence

## Project Setup

1. Clone the repository:

```bash
git clone <repository-url>
cd ticket-system-twig
```

2. Install dependencies:

```bash
composer install
```

3. Run the local development server:

```bash
php -S localhost:8000 -t public
```

4. Visit http://localhost:8000 in your browser

## Project Structure

```
ticket-system-twig/
├── public/
│   └── index.php         # Entry point
├── src/
│   └── ...              # PHP classes
├── templates/
│   ├── base.twig        # Base template
│   ├── landing.twig     # Landing page
│   ├── dashboard.twig   # Dashboard
│   ├── auth/
│   │   ├── login.twig   # Login page
│   │   └── signup.twig  # Signup page
│   └── tickets/
│       └── index.twig   # Ticket management
└── vendor/              # Dependencies
```

## Test User Credentials

You can use these credentials to test the application:

```
Email: test@example.com
Password: password
```

## Accessibility

The application follows accessibility best practices:

- Semantic HTML structure
- ARIA labels where necessary
- Sufficient color contrast
- Keyboard navigation support
- Focus management
- Screen reader friendly




