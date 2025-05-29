# PHP Learning Management System (LMS)

A web-based Learning Management System (LMS) developed in PHP that enables users to enroll in courses, access learning materials, and take quizzes. This project is inspired by platforms like Coursera and Great Learning.

---

## 📚 Features

- User registration and login
- Admin panel for managing courses and users
- Course listing and enrollment
- Video lectures 
- Quiz system for course assessments
- Progress tracking
- Responsive design for mobile and desktop

---

## 🛠️ Built With

- PHP (Core PHP and OOPS concepts)
- MySQL
- HTML5, CSS3
- JavaScript
- media query (for responsive design)

---

## 🚀 Getting Started

### Prerequisites

- PHP 7.x or higher
- MySQL / phpMyAdmin (via XAMPP/WAMP/LAMP)
- Web browser (e.g., Chrome)

### Installation

1. Clone the Repository
   ```bash
   git clone https://github.com/yourusername/php-lms.git

2. Move to Server Directory

  For XAMPP: Copy the folder to C:\xampp\htdocs\

3. Import Database

  Open phpMyAdmin

  Click New and create a database named lms

  Click on the database, then choose Import

  Select the php.sql file located in the database/folder of the project

  Click Go to import all SQL queries and create the necessary tables

4. Configure Database Connection

  Open the file: config/db.php (or your DB config file)

 
5. Run the Application

  Start Apache and MySQL from your local server (XAMPP/WAMP)

  Open browser and go to: http://localhost/php_project/
