# Real Madrid Fan Site

A comprehensive fan site for Real Madrid CF, featuring player profiles, club history, honors, and an online shop.

## Project Structure

```
real-madrid-fan-site/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── includes/
│   ├── config.php
│   ├── header.php
│   ├── footer.php
│   └── db.php
├── pages/
│   ├── players.php
│   ├── legends.php
│   ├── honours.php
│   └── shop.php
├── install.sql
└── index.php
```

## Setup Instructions

1. **Install XAMPP**
   - Download and install XAMPP from https://www.apachefriends.org/
   - Make sure PHP 8+ and MySQL are selected during installation

2. **Project Setup**
   - Copy the entire project folder to `C:\xampp\htdocs\real-madrid-fan-site`
   - Start XAMPP Control Panel and start Apache and MySQL services

3. **Database Setup**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `real_madrid_fan_site`
   - Import the `install.sql` file to create tables and seed data

4. **Configuration**
   - Open `includes/config.php`
   - Update database credentials if needed:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'real_madrid_fan_site');
     ```

5. **Access the Site**
   - Open your browser and navigate to:
     `http://localhost/real-madrid-fan-site`

## Features

- Responsive design for all devices
- Interactive player cards with 3D effects
- Complete club history and honors
- Online shop with product filtering
- Fan community gallery
- Match schedule and events
- Social media integration

## Image Requirements

The project requires several images to be placed in the `assets/images/` directory. Please refer to the image placeholders in the code for the complete list of required images.

## Technologies Used

- Frontend: HTML5, CSS3, JavaScript (ES6+)
- Backend: PHP 8+
- Database: MySQL
- Development: XAMPP 