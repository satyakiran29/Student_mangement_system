<?php
include 'db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $roll_number = mysqli_real_escape_string($conn, $_POST['roll_number']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);

    // Build the insert query
    $columns = "name, roll_number, semester, section";
    $values = "'$name', '$roll_number', '$semester', '$section'";

    for ($i = 1; $i <= 10; $i++) {
        $subject_code = mysqli_real_escape_string($conn, $_POST["subject{$i}_code"]);
        $subject_name = mysqli_real_escape_string($conn, $_POST["subject{$i}_name"]);
        $subject_grade = mysqli_real_escape_string($conn, $_POST["subject{$i}_grade"]);
        $subject_points = mysqli_real_escape_string($conn, $_POST["subject{$i}_points"]);
        $subject_credits = mysqli_real_escape_string($conn, $_POST["subject{$i}_credits"]);

        $columns .= ", subject{$i}_code, subject{$i}_name, subject{$i}_grade, subject{$i}_points, subject{$i}_credits";
        $values .= ", '$subject_code', '$subject_name', '$subject_grade', '$subject_points', '$subject_credits'";
    }

    $insert_query = "INSERT INTO results ($columns) VALUES ($values)";

    if (mysqli_query($conn, $insert_query)) {
        echo "<p>Student added successfully!</p>";
    } else {
        echo "<p>Error adding student: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <title>Add New Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        form {
            width: 800px;
            margin: auto;
        }
        h1 {
            text-align: center;
        }
        label {
            display: inline-block;
            width: 150px;
            margin-top: 10px;
        }
        input {
            width: 300px;
            padding: 5px;
            margin-top: 5px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
        }
        hr {
            margin: 20px 0;
        }
    </style>
</head>
<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Student Result Management</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="home.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Student_mangement_system/db/student.php">Results</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<h1>Add New Student</h1>

<form method="POST" action="">
    <label>Name:</label>
    <input type="text" name="name" required><br>

    <label>Roll Number:</label>
    <input type="text" name="roll_number" required><br>

    <label>Semester:</label>
    <input type="text" name="semester" required><br>

    <label>Section:</label>
    <input type="text" name="section" required><br>

    <hr>

    <?php for ($i = 1; $i <= 10; $i++): ?>
        <h3>Subject <?php echo $i; ?></h3>

        <label>Course Code:</label>
        <input type="text" name="subject<?php echo $i; ?>_code"><br>

        <label>Course Name:</label>
        <input type="text" name="subject<?php echo $i; ?>_name"><br>

        <label>Grade:</label>
        <input type="text" name="subject<?php echo $i; ?>_grade"><br>

        <label>Points:</label>
        <input type="text" name="subject<?php echo $i; ?>_points"><br>

        <label>Credits:</label>
        <input type="text" name="subject<?php echo $i; ?>_credits"><br>

        <hr>
    <?php endfor; ?>

    <button type="submit">Add Student</button>
</form>

</body>
</html>
