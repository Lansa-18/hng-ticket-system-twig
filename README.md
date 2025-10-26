# TrackiT - Ticket Management System (Twig Version)

TrackiT is a modern, responsive ticket management system built with PHP and Twig templating engine. It provides a clean and intuitive interface for managing support tickets, with features like responsive design and a smooth user experience.

# LIVE URL
[Live - URL](https://trackit-mi9k.onrender.com/)

## 🛠️ Technologies and Libraries

### Core Framework & Templating

- **PHP 8.x** - Server-side scripting
- **Twig** - PHP templating engine
- **Bramus Router** - PHP router for clean URLs

### UI and Styling

- **Tailwind CSS** - Utility-first CSS framework

### Data Handling & Storage

- **LocalStorage** - Client-side data persistence
- **JSON** - Data serialization

## 🚀 Setup and Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/Lansa-18/ticket-system-twig.git
   cd ticket-system-twig
   ```

2. **Install dependencies**

   ```bash
   composer install
   ```

3. **Run the development server**

   ```bash
   php -S localhost:8000 -t public
   ```

## 🏗️ Project Structure

```
ticket-system-twig/
├── public/              # Public directory serving static files
├── templates/           # Twig template files
│   ├── auth/           # Authentication templates
│   ├── dashboard/      # Dashboard templates
│   └── tickets/        # Ticket management templates
├── vendor/             # Composer dependencies
└── composer.json       # Project dependencies
```

## 🎯 Features and Components

### Authentication

- **Login/Signup Forms**: Secure client-side authentication with form validation
- **Protected Routes**: Client-side route protection
- **Persistent Sessions**: Local storage based session management

### Dashboard

- **Overview Stats**: Quick view of ticket statistics
- **Ticket Management**: CRUD operations for tickets
- **Status Tracking**: Visual status indicators (Open, In Progress, Closed)
- **Responsive Layout**: Mobile-first design approach

### Components Structure

- **Base Layout**: Base template with common elements
- **Auth Templates**: Login and signup forms
- **Ticket Templates**: Ticket listing and management
- **Dashboard Template**: Main dashboard view

## 🔐 Authentication and State

### Client-side Authentication

- Manages user authentication state in localStorage
- Provides login, signup, and logout functionality
- Session persistence using localStorage

### Ticket State Management

- Local storage-based ticket data persistence
- Real-time updates using JavaScript
- Optimistic UI updates for better UX

## ♿ Accessibility Features

- Semantic HTML structure
- ARIA labels for interactive elements
- Keyboard navigation support
- Color contrast compliance
- Focus management in modals
- Screen reader friendly status messages

## 🧪 Test User Credentials

```
Email: demo@example.com
Password: password123
```

Note: Demo user gets pre-populated with sample tickets for testing.

## 💻 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## 📝 Development Notes

- Uses Twig for templating
- Client-side state management with localStorage
- Responsive design with Tailwind CSS
- Form validation using native JavaScript
- Modal dialogs for ticket operations

## 📄 License

This project is licensed under the MIT License.

---

Built with PHP, Twig, and TailwindCSS
