# Student Result Management System

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![PHP](https://img.shields.io/badge/php-%3E%3D7.4-8892BF.svg)
![MySQL](https://img.shields.io/badge/mysql-%3E%3D5.7-4479A1.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

## What the project does

The **Student Result Management System** is a robust, web-based application built with **PHP** and **MySQL**. It is designed to streamline the process of managing and publishing student academic results. The system provides a seamless interface for administrators to handle result data and an intuitive portal for students to view their performance effectively.

## Why the project is useful

Managing academic results can be tedious and prone to errors. This project eliminates paperwork and manual calculations by offering:

-   **Student Portal**: Students can instantly access their semester-wise results, view a detailed marksheet, and see their automatically calculated Semester Grade Point Average (SGPA).
-   **Admin Dashboard**: Administrators have full CRUD (Create, Read, Update, Delete) capabilities to manage student records and subject marks efficiently.
-   **Automated Calculations**: Calculates total credits, points, and SGPA, automatically flagging 'FAIL' status if required.
-   **Secure Access**: Protected login functionality for authorized personnel.

## Project Structure

```text
Student_mangement_system/
├── css/                  # Directory for cascading style sheets
├── db/                   # Contains backend logic and database connection
│   ├── add_data.php      # Script for inserting new data
│   ├── db.php            # Database connection configuration
│   ├── login.php         # Admin login logic
│   ├── logout.php        # Session termination script
│   ├── result.php        # Student result viewing logic
│   ├── student.php       # Student side portal mechanics
│   ├── superadmin.php    # Admin dashboard logic
│   └── *.css             # Specific stylesheets for database pages
├── docs/                 # Documentation directory
│   └── CONTRIBUTING.md   # Contribution guidelines
├── index.html            # Main landing page
├── LICENSE               # Project license file
└── README.md             # Project overview and instructions
```

## How users can get started

### Prerequisites

You need a local server environment capable of running PHP and MySQL, such as:
- [XAMPP](https://www.apachefriends.org/index.html)
- [WAMP](https://www.wampserver.com/en/)
- [MAMP](https://www.mamp.info/en/windows/)

### Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/satyakiran29/Student_mangement_system.git
    ```

2.  **Move to Server Root:**
    Move the cloned repository folder into your server's document root (e.g., `htdocs` for XAMPP or `www` for WAMP).

3.  **Database Setup:**
    - Open your MySQL management tool (e.g., phpMyAdmin).
    - Create a new database named `student_mangement`.
    - Refer to the setup guide to create the `users` and `results` tables. A sample admin user (`admin` / `admin123`) is included by default.

4.  **Configuration:**
    - The database connection is managed in `db/db.php`.
    - Open the file and update the connection variables if your local configuration differs from the defaults:
      ```php
      $host = "localhost";
      $user = "root";
      $password = "";
      $database = "student_mangement";
      ```

### Usage Examples

- **Student Interface:** Navigate to `http://localhost/Student_mangement_system/`. Click **View Results** and enter a valid Roll Number, Semester, and Section to see the grades.
- **Admin Interface:** Navigate to `http://localhost/Student_mangement_system/db/login.php` or click **Login** from the homepage. 
  - *Default Credentials:* Username: `admin`, Password: `admin123`.
  - Once logged in, use the admin dashboard (`db/superadmin.php`) to add new results, search, edit, or delete existing records.

## Where users can get help

- **Issues & Bug Reports:** If you encounter any bugs or would like to request a new feature, please open an issue on the [GitHub Issues](../../issues) page.
- **General Documentation:** Please refer to our documentation wiki for extended details.

## Who maintains and contributes

- **Maintainer:** [@satyakiran29](https://github.com/satyakiran29)
- **Contributors:** We welcome contributions from the community! Whether it's adding a new feature, improving the UI, or fixing a bug, your help is appreciated.

Please read our [Contributing Guidelines](docs/CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests to us.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
