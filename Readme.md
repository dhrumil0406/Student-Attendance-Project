Student Attendance Project ├──
        ├── Admin/ # Admin dashboard and controls
        ├── css/ # Stylesheets
        ├── DataBases/ # Database-related files (e.g., config or SQL exports)
        ├── DB Files/ # Possibly SQL dump or migration files
        ├── font/ # Font files
        ├── img/ # Image assets
        ├── Includes/ # PHP include files (header, footer, DB conn)
        ├── js/ # JavaScript files
        ├── PHPMailer/ # PHPMailer for sending emails
        ├── scripts/ # Custom scripts (AJAX, JS, or backend scripts)
        ├── scss/ # SCSS styles (optional)
        ├── Students/ # Student-facing UI and functionality
        ├── Teachers/ # Teacher module
        ├── vendor/ # Composer dependencies (ignored by Git)
        ├── ajaxchangepass.php # AJAX handler for password change
        ├── forgetpass.php # Forgot password logic
        ├── index.php # Landing/Login page
        └── .gitignore # Git ignore settings


## 🚀 Setup Instructions

### Prerequisites
- PHP >= 7.4
- MySQL
- Apache or any web server (XAMPP, WAMP, LAMP recommended)
- Composer (optional, if using dependencies)

### 📦 Installation Steps

#1. **Clone this repository:**
    - git clone https://github.com/dhrumil0406/student-attendance-project.git
    - cd student-attendance-project

#2. Set up the database:
    - Import the SQL file located in DB Files/ or DataBases/ folder using phpMyAdmin or MySQL CLI.

#3. Configure database connection:
    - Edit the DB credentials inside the appropriate file (e.g., Includes/dbconn.php or similar).

#4. Start your local server:
    - If using XAMPP, place the project folder in htdocs/ and open http://localhost/student-attendance-projct.

#5. Install Composer dependencies (if applicable):
    - composer install

#6. Email sending (Optional):
    - Configure PHPMailer SMTP settings in the respective files.


Role	    Username	        Password
Admin	    admin@mail.com	    admin123
Teacher	    teacher1@mail.com	teacher123
Student	    AD0011	            student123

### Features ###

- Multi-role login system: Admin, Teacher, Student

- Department-wise attendance tracking

- Email notifications using PHPMailer

- AJAX-based password change

- Responsive UI