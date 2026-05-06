# JobYaari - Professional Job & Blog Portal

JobYaari is a comprehensive, professional-grade job notification and blogging platform. It features a stunning, mobile-responsive frontend for users and a powerful, advanced administrative dashboard for content management.

## 🌟 Key Features

### 🏢 Frontend Portal
- **Premium Design**: Modern, high-contrast UI with smooth transitions and glassmorphism elements.
- **Fully Responsive**: Pixel-perfect layout across Desktop, Tablet, and Mobile devices.
- **Social Integration**: Functional social media connectivity (Facebook, Instagram, LinkedIn, YouTube) with colorful, circular icons.
- **Direct Contact**: Integrated WhatsApp contact link in the header for instant user support.
- **Categorized Content**: Dedicated sections for Latest Jobs, Admit Cards, Results, and Blogs.
- **SEO Optimized**: Semantic HTML5 structure, descriptive meta tags, and clean URL slugs.

### 🔐 Advanced Admin Dashboard
- **Pro Layout**: Elegant dark sidebar with cyan branding and nested "Manage Blog" submenus.
- **Dashboard Overview**: Data-driven interface with quick-action buttons for Jobs, Blogs, and Results.
- **Advanced Topbar**: 
    - **Grid Menu**: Functional quick-links dropdown (Visit Site, Create New).
    - **Notification Center**: Real-time style notification badge system.
    - **Profile Dropdown**: Professional "Profile Pill" with account settings and secure logout.
- **Content Management**: 
    - Two-column "Add/Edit" forms for efficient data entry.
    - **Rich Text Editor**: Fully integrated TinyMCE for advanced content formatting.
    - **Image Upload**: Custom drag-and-drop upload zone with instant preview.
- **Interactive Tables**: Lean data tables with row-hover highlights, multi-select checkboxes, and ID tracking.
- **Secure Authentication**: Modern, gradient-styled login page with CSRF protection and secure session handling.

## 🛠️ Technology Stack
- **Backend**: PHP 8.x (Vanilla)
- **Database**: MySQL / MariaDB
- **Frontend**: HTML5, CSS3 (Vanilla), JavaScript (ES6+)
- **Typography**: Google Fonts (Inter, Outfit)
- **Icons**: Font Awesome 6 (Pro-style integration)
- **Editor**: TinyMCE 6

## 🚀 Installation & Local Setup

### Prerequisites
- Web Server (XAMPP, WAMP, or Apache)
- PHP 7.4 or higher
- MySQL / MariaDB

### Steps
1. **Clone/Copy Project**: Move the project folder into your web root (e.g., `C:/xampp/htdocs/jobyaari`).
2. **Database Setup**: 
    - Open phpMyAdmin.
    - Create a new database named `jobyaari_portal`.
    - Import `database/full_setup.sql` to set up schema and initial categories.
    - (Optional) Import `database/seed.sql` for sample data.
3. **Configuration**:
    - Open `config/database.php`.
    - Update the database credentials (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`) to match your local environment.
4. **Run Application**:
    - Start Apache and MySQL from your XAMPP Control Panel.
    - Access the portal: `http://localhost/jobyaari/public/index.php`
    - Access Admin: `http://localhost/jobyaari/admin/login.php`

## 🔑 Admin Credentials
- **Email**: `admin@jobyaari.com`
- **Password**: `password`

## 📂 Project Structure
- `admin/`: Dashboard controllers and UI components.
- `app/`: Core logic and Repository classes.
- `config/`: Database and environment configuration.
- `public/`: Public-facing assets (CSS, JS, Images, Uploads).
- `templates/`: Reusable HTML partials (Header, Footer, Cards).

---
*Developed with ❤️ for JobYaari Portal.*
