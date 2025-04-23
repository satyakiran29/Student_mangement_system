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

// Only query the database if there are filter parameters
if (!empty($roll_number) || !empty($semester) || !empty($section)) {
    // Build the query with filters
    $query = "SELECT name, roll_number, semester, section, subject1_code, subject1_name, subject1_grade, subject1_points, subject1_credits, subject2_code, subject2_name, subject2_grade, subject2_points, subject2_credits, subject3_code, subject3_name, subject3_grade, subject3_points, subject3_credits, subject4_code, subject4_name, subject4_grade, subject4_points, subject4_credits, subject5_code, subject5_name, subject5_grade, subject5_points, subject5_credits, subject6_code, subject6_name, subject6_grade, subject6_points, subject6_credits, subject7_code, subject7_name, subject7_grade, subject7_points, subject7_credits, subject8_code, subject8_name, subject8_grade, subject8_points, subject8_credits, subject9_code, subject9_name, subject9_grade, subject9_points, subject9_credits, subject10_code, subject10_name, subject10_grade, subject10_points, subject10_credits FROM results WHERE 1=1";

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Student Results Page">
    <meta name="keywords" content="Student, Results, SGPA, Evaluation, Methodology">
    <meta name="author" content="Your Name">
    <!-- External CSS -->
  <link rel="stylesheet" href="result.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Student Results</title>
</head>
<body>
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
                </tr>
            </thead>
            <tbody>
                <?php
                $total_credits = 0;
                $total_weighted_points = 0;
                $has_failed = false;

                for ($i = 1; $i <= 10; $i++) {
                    $course_code = htmlspecialchars($row["subject{$i}_code"]);
                    $course_name = htmlspecialchars($row["subject{$i}_name"]);
                    $grade = htmlspecialchars($row["subject{$i}_grade"]);
                    $grade_points = htmlspecialchars($row["subject{$i}_points"]);
                    $credits = htmlspecialchars($row["subject{$i}_credits"]);

                    if (!empty($course_name)) {
                        echo "<tr>
                                <td>{$course_code}</td>
                                <td>{$course_name}</td>
                                <td>{$grade}</td>
                                <td>{$grade_points}</td>
                                <td>{$credits}</td>
                              </tr>";

                        if ($grade == 'F') {
                            $has_failed = true;
                        }

                        $total_credits += (int)$credits;
                        $total_weighted_points += ((int)$grade_points * (int)$credits);
                    }
                }

                if ($total_credits > 0) {
                    $sgpa = round($total_weighted_points / $total_credits, 2);
                } else {
                    $sgpa = 0;
                }
                ?>
            </tbody>
        </table>

        <br>
        <strong>Semester Grade Point Average (SGPA):</strong> <?php echo $has_failed ? 'FAIL' : $sgpa; ?>
    
    <?php else: ?>
        <p>No results found for the given filters.</p>
    <?php endif; ?>


    
<div class="container">
    <h2>EVALUATION METHODOLOGY</h2>
    <ol type="a">
        <li>The assessment will be based on the performance in the semester-end examinations and/or continuous assessment, carrying marks as specified.</li>
        <li>At the end of each semester, final examinations will normally be conducted during October/November and during April/May of each year. Supplementary examinations shall be conducted as per the schedule announced.</li>
        <li>Continuous Assessment Marks will be awarded based on Continuous Evaluation made during the semester as per the scheme.</li>
        <li>The letter grade and the grade points are awarded based on the absolute grading system having earned grades based on the marks scored. Grading is done based on the percentage of marks secured by a candidate in individual courses (Theory & Laboratory) as detailed below:</li>
    </ol>

    <table>
        <thead>
            <tr>
                <th>Range of Percentage of Marks</th>
                <th>Qualitative Meaning</th>
                <th>Letter Grade</th>
                <th>Grade Point</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>90 to 100</td>
                <td>Superior</td>
                <td>S</td>
                <td>10</td>
            </tr>
            <tr>
                <td>80 to 89</td>
                <td>Excellent</td>
                <td>A</td>
                <td>9</td>
            </tr>
            <tr>
                <td>70 to 79</td>
                <td>Very Good</td>
                <td>B</td>
                <td>8</td>
            </tr>
            <tr>
                <td>60 to 69</td>
                <td>Good</td>
                <td>C</td>
                <td>7</td>
            </tr>
            <tr>
                <td>50 to 59</td>
                <td>Fair</td>
                <td>D</td>
                <td>6</td>
            </tr>
            <tr>
                <td>40 to 49</td>
                <td>Satisfactory</td>
                <td>E</td>
                <td>5</td>
            </tr>
            <tr>
                <td>&lt; 40</td>
                <td>Fail</td>
                <td>F</td>
                <td>0</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">
        SEMESTER GRADE POINT AVERAGE (SGPA) CALCULATION
    </div>

    <p><strong>A SGPA</strong> will be computed for each semester. The SGPA will be calculated as follows:</p>

    <div class="formula">
        <p><strong>SGPA = (Σ C<sub>i</sub> × GP<sub>i</sub>) / (Σ C<sub>i</sub>)</strong></p>
    </div>

    <p>where C<sub>i</sub> = Credit for the course</p>
    <p>GP<sub>i</sub> = Grade Point obtained for the course</p>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
