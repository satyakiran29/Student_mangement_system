<?php
// Include database connection
include 'db.php';

// Initialize variables for filters
$roll_number = isset($_GET['roll_number']) ? $_GET['roll_number'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';
$section = isset($_GET['section']) ? $_GET['section'] : '';

// Initialize result and row
$result = null;
$row = null;

// Edit and delete functionality
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        // Delete query
        $delete_query = "DELETE FROM results WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'";
        if (mysqli_query($conn, $delete_query)) {
            echo "<p>Record deleted successfully.</p>";
        } else {
            echo "<p>Error deleting record: " . mysqli_error($conn) . "</p>";
        }
    } elseif ($_GET['action'] == 'edit' && isset($_GET['id'])) {
        $id = $_GET['id'];
        // Fetch the current data
        $edit_query = "SELECT * FROM results WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'";
        $result = mysqli_query($conn, $edit_query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }
    }
}

// Only query the database if there are filter parameters
if (!empty($roll_number) || !empty($semester) || !empty($section)) {
    // Build the query with filters
    $query = "SELECT * FROM results WHERE 1=1";

    if (!empty($roll_number)) {
        $query .= " AND roll_number = '" . mysqli_real_escape_string($conn, $roll_number) . "'";
    }
    if (!empty($semester)) {
        $query .= " AND semester = '" . mysqli_real_escape_string($conn, $semester) . "'";
    }
    if (!empty($section)) {
        $query .= " AND section = '" . mysqli_real_escape_string($conn, $section) . "'";
    }

    // Limit to only 1 result
    $query .= " LIMIT 1";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    } else {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }
    }
}

// Handle form submission for edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $name = $_POST['name'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];

    // Loop through all the subjects and update the values
    $update_query = "UPDATE results SET name = '$name', semester = '$semester', section = '$section'";

    for ($i = 1; $i <= 10; $i++) {
        $subject_name = $_POST["subject{$i}_name"];
        $subject_grade = $_POST["subject{$i}_grade"];
        $subject_points = $_POST["subject{$i}_points"];
        $subject_credits = $_POST["subject{$i}_credits"];

        $update_query .= ", subject{$i}_name = '$subject_name', subject{$i}_grade = '$subject_grade', subject{$i}_points = '$subject_points', subject{$i}_credits = '$subject_credits'";
    }

    // Execute the query to update the data
    $update_query .= " WHERE id = '$edit_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<p>Record updated successfully.</p>";
    } else {
        echo "<p>Error updating record: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        table, th, td {
            border: 1px solid #444;
        }
        th, td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
        }
        .filter-label {
            margin-right: 10px;
        }
        .filter-input {
            margin-right: 20px;
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

    <h1>Student Results</h1>

    <form method="GET" action="">
        <label class="filter-label" for="roll_number">Roll Number:</label>
        <input class="filter-input" type="text" id="roll_number" name="roll_number" value="<?php echo htmlspecialchars($roll_number); ?>">
        
        <label class="filter-label" for="semester">Semester:</label>
        <input class="filter-input" type="text" id="semester" name="semester" value="<?php echo htmlspecialchars($semester); ?>">
        
        <label class="filter-label" for="section">Section:</label>
        <input class="filter-input" type="text" id="section" name="section" value="<?php echo htmlspecialchars($section); ?>">
        
        <button type="submit">Filter</button>
    </form>
    <a href="add_data.php" class="btn btn-primary">Add New Result</a>

    <?php if ($row): ?>
        <h2>Student Name: <?php echo htmlspecialchars($row['name']); ?></h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Grade</th>
                    <th>Grade Points</th>
                    <th>Credits</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the subjects
                for ($i = 1; $i <= 10; $i++) {
                    $course_code = htmlspecialchars($row["subject{$i}_code"]);
                    $course_name = htmlspecialchars($row["subject{$i}_name"]);
                    $grade = htmlspecialchars($row["subject{$i}_grade"]);
                    $grade_points = htmlspecialchars($row["subject{$i}_points"]);
                    $credits = htmlspecialchars($row["subject{$i}_credits"]);

                    // Check if the subject has any data
                    if (!empty($course_name) || !empty($course_code) || !empty($grade)) {
                        echo "<tr>
                                <td>{$course_code}</td>
                                <td>{$course_name}</td>
                                <td>{$grade}</td>
                                <td>{$grade_points}</td>
                                <td>{$credits}</td>
                                <td>
                                    <a href='?action=edit&id={$row['id']}'>Edit</a> | 
                                    <a href='?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    } else {
                        // If the subject has no data, display placeholders or empty rows
                        echo "<tr>
                                <td>---</td>
                                <td>Remaining Subject {$i}</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>
                                    <a href='?action=edit&id={$row['id']}'>Edit</a> | 
                                    <a href='?action=delete&id={$row['id']}'>Delete</a>
                                </td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    
    <?php else: ?>
        <p>No results found for the given filters.</p>
    <?php endif; ?>

    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($row)): ?>
        <h2>Edit Student Results</h2>
        <form method="POST" action="">
            <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>

            <label for="semester">Semester:</label>
            <input type="text" name="semester" value="<?php echo $row['semester']; ?>"><br>

            <label for="section">Section:</label>
            <input type="text" name="section" value="<?php echo $row['section']; ?>"><br>

            <?php
            // Loop to display subject fields for editing
            for ($i = 1; $i <= 10; $i++) {
                echo "
                <h3>Subject $i</h3>
                <label for='subject{$i}_name'>Subject Name:</label>
                <input type='text' name='subject{$i}_name' value='" . $row["subject{$i}_name"] . "'><br>
                <label for='subject{$i}_grade'>Grade:</label>
                <input type='text' name='subject{$i}_grade' value='" . $row["subject{$i}_grade"] . "'><br>
                <label for='subject{$i}_points'>Points:</label>
                <input type='text' name='subject{$i}_points' value='" . $row["subject{$i}_points"] . "'><br>
                <label for='subject{$i}_credits'>Credits:</label>
                <input type='text' name='subject{$i}_credits' value='" . $row["subject{$i}_credits"] . "'><br>
                ";
            }
            ?>

            <button type="submit">Update</button>
        </form>

       
    <?php endif; ?>
</body>
</html>
