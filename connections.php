<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "inc-grade";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    die("Failed to connect!");
}

// // Updated SQL query
// // Assuming 'student_class_id' is the correct column in 'grades' table that references 'student_classes' table
// $sql = "SELECT students.user_name, classes.class_name, assignments.assignment_name, grades.grade
//         FROM student_classes
//         INNER JOIN students ON student_classes.student_id = students.student_id
//         INNER JOIN classes ON student_classes.class_id = classes.class_id
//         INNER JOIN assignments ON student_classes.assignment_id = assignments.assignment_id
//         INNER JOIN grades ON student_classes.grade_id = grades.grade_id";  // Assuming student_classes.id is the correct column

// $result = $con->query($sql);

// if ($result && mysqli_num_rows($result) > 0) {
//     // --  Output data in a responsive table
//     echo "<table class='responsive-table'>
//             <tr>
//                 <th>Student</th>
//                 <th>Class</th>
//                 <th>Assignment</th>
//                 <th>Grade</th>
//             </tr>";
//     while($row = $result->fetch_assoc()) {
//         echo "<tr>
//                 <td>".$row["user_name"]."</td>
//                 <td>".$row["class_name"]."</td>
//                 <td>".$row["assignment_name"]."</td>  
//                 <td>".$row["grade"]."</td>
//             </tr>";
//     }
//     echo "</table>";
// } 
// // else {
// //     echo "0 results";
// // }

?>