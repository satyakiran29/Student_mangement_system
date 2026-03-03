# Student Result Management System

A web-based application built with PHP and MySQL for managing and publishing student academic results. This system provides distinct interfaces for students to view their performance and for administrators to manage the result data.

## Features

### For Students
- **View Results**: Students can access their semester-wise results by entering their Roll Number, Semester, and Section.
- **Detailed Marksheet**: Displays a comprehensive marksheet with course codes, course names, grades, grade points, and credits for each subject.
- **SGPA Calculation**: Automatically calculates the Semester Grade Point Average (SGPA) based on the entered grades and credits. The result is marked as 'FAIL' if the student has failed any subject.
- **Evaluation Guide**: Includes a detailed evaluation methodology explaining the grading system, grade points, and the formula for SGPA calculation.

### For Administrators
- **Secure Login**: Protected login for authorized administrators.
- **CRUD Operations**: Full Create, Read, Update, and Delete functionality for student results.
  - **Add Results**: A dedicated form to add new student results, including personal details and marks for up to 10 subjects.
  - **Search & Filter**: Easily find specific student records using roll number, semester, or section filters.
  - **Edit & Update**: Modify existing student records, including subject-specific details like grades, points, and credits.
  - **Delete Records**: Remove student result records from the database.

## Technology Stack

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS, Bootstrap 5

## Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

You will need a local web server environment that supports PHP and MySQL. We recommend using a package like:
- [XAMPP](https://www.apachefriends.org/index.html)
- [WAMP](https://www.wampserver.com/en/)
- [MAMP](https://www.mamp.info/en/windows/)

### Installation

1.  **Clone the repository:**
    ```sh
    git clone https://github.com/satyakiran29/Student_mangement_system.git
    ```

2.  **Navigate to your server's root directory:**
    Move the cloned `Student_mangement_system` folder into your web server's document root (e.g., `htdocs` in XAMPP).

3.  **Set up the database:**
    - Open your database management tool (e.g., phpMyAdmin).
    - Create a new database named `student_mangement`.
    - Run the following SQL queries to create the necessary tables:

    **`users` table (for login):**
    ```sql
    CREATE TABLE `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `role` varchar(50) NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `username` (`username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- Insert a sample admin user
    INSERT INTO `users` (`username`, `password`, `role`) VALUES ('admin', 'admin123', 'admin');
    ```

    **`results` table (for student data):**
    ```sql
    CREATE TABLE `results` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `roll_number` varchar(50) NOT NULL,
      `semester` varchar(20) NOT NULL,
      `section` varchar(10) NOT NULL,
      `subject1_code` varchar(20) DEFAULT NULL,
      `subject1_name` varchar(255) DEFAULT NULL,
      `subject1_grade` varchar(5) DEFAULT NULL,
      `subject1_points` varchar(5) DEFAULT NULL,
      `subject1_credits` varchar(5) DEFAULT NULL,
      `subject2_code` varchar(20) DEFAULT NULL,
      `subject2_name` varchar(255) DEFAULT NULL,
      `subject2_grade` varchar(5) DEFAULT NULL,
      `subject2_points` varchar(5) DEFAULT NULL,
      `subject2_credits` varchar(5) DEFAULT NULL,
      `subject3_code` varchar(20) DEFAULT NULL,
      `subject3_name` varchar(255) DEFAULT NULL,
      `subject3_grade` varchar(5) DEFAULT NULL,
      `subject3_points` varchar(5) DEFAULT NULL,
      `subject3_credits` varchar(5) DEFAULT NULL,
      `subject4_code` varchar(20) DEFAULT NULL,
      `subject4_name` varchar(255) DEFAULT NULL,
      `subject4_grade` varchar(5) DEFAULT NULL,
      `subject4_points` varchar(5) DEFAULT NULL,
      `subject4_credits` varchar(5) DEFAULT NULL,
      `subject5_code` varchar(20) DEFAULT NULL,
      `subject5_name` varchar(255) DEFAULT NULL,
      `subject5_grade` varchar(5) DEFAULT NULL,
      `subject5_points` varchar(5) DEFAULT NULL,
      `subject5_credits` varchar(5) DEFAULT NULL,
      `subject6_code` varchar(20) DEFAULT NULL,
      `subject6_name` varchar(255) DEFAULT NULL,
      `subject6_grade` varchar(5) DEFAULT NULL,
      `subject6_points` varchar(5) DEFAULT NULL,
      `subject6_credits` varchar(5) DEFAULT NULL,
      `subject7_code` varchar(20) DEFAULT NULL,
      `subject7_name` varchar(255) DEFAULT NULL,
      `subject7_grade` varchar(5) DEFAULT NULL,
      `subject7_points` varchar(5) DEFAULT NULL,
      `subject7_credits` varchar(5) DEFAULT NULL,
      `subject8_code` varchar(20) DEFAULT NULL,
      `subject8_name` varchar(255) DEFAULT NULL,
      `subject8_grade` varchar(5) DEFAULT NULL,
      `subject8_points` varchar(5) DEFAULT NULL,
      `subject8_credits` varchar(5) DEFAULT NULL,
      `subject9_code` varchar(20) DEFAULT NULL,
      `subject9_name` varchar(255) DEFAULT NULL,
      `subject9_grade` varchar(5) DEFAULT NULL,
      `subject9_points` varchar(5) DEFAULT NULL,
      `subject9_credits` varchar(5) DEFAULT NULL,
      `subject10_code` varchar(20) DEFAULT NULL,
      `subject10_name` varchar(255) DEFAULT NULL,
      `subject10_grade` varchar(5) DEFAULT NULL,
      `subject10_points` varchar(5) DEFAULT NULL,
      `subject10_credits` varchar(5) DEFAULT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `roll_number_semester` (`roll_number`,`semester`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ```
    
4.  **Database Connection:**
    The database connection is configured in `db/db.php`. The default settings are:
    ```php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "student_mangement";
    ```
    Update these values if your local MySQL setup is different.

5.  **Run the application:**
    - Start your Apache and MySQL services.
    - Open your web browser and navigate to:
      `http://localhost/Student_mangement_system/`

## Usage

- **Homepage**: The main landing page provides a welcome message and links to view results or log in.
- **View Results**: Click on the "Results" link in the navbar or the "View Results" button on the homepage. You will be redirected to `db/result.php`. Enter a valid Roll Number, Semester, and Section to see the marksheet.
- **Admin Login**: Navigate to `db/login.php` or click the "Login" button. Use the admin credentials (`admin`/`admin123`) to access the admin dashboard at `db/superadmin.php`.
- **Admin Dashboard**: From here, you can add, search for, edit, or delete student result records.
