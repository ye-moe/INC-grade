<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

  include("connections.php");
  include("functions.php");

  $user_data = check_login($con);

  // include("display_image.php");

?>

<!DOCTYPE HTML>
<html>

<head>
  <title>BMCC Incomplete Grades</title>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <style>
.title {
                background-color: #eeeeee;
                background-color: #2F2827;
                background:#4169E1;
                font-family: Arial,Helvetica,sans-serif; 
                font-size: large;
                padding: .2em;
                margin-left: 0em;
                margin-bottom: .1em;
                float: left;
                text-align: left;
                width: auto;
                font-weight: bold;
                font-variant: small-caps;
                text-align:left;
            }
</style>
<!-- <script src="js/cookiemanager.js" ></script> -->
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">BMCC <span class="logo_colour">Incomplete (INC) Grades</span></a></h1>
          <h2>Learn about Incomplete Grades and how to resolve them</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.php">Home</a></li>
          <li><a href="classes.php">Classes</a></li>
          <li class="selected"><a href="assignments.php">Assignments</a></li>
          <li><a href="logoff.php">Logoff</a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div class="sidebar">
        <h1 style="text-align: center;">Profile</h1>
        
        <span class="center"><img src="display_image.php?id=<?php echo $user_data['student_id']; ?>" width="100px" height="100px" alt="profile" /></span> 
        <h4>Name: </h4><h5> <?php echo $user_data['user_name']; ?></h5>
        <!-- <h5>CUNYfirst EMPLID: 24266607</h5>
        <h5>Email: yemoe001@bmcc.cuny.edu</h5>
        <h5>Date of Birth: 10/08/2003</h5> -->
        <p>Learn more about INC Grades by clicking on the link below.<br/><a href="index.php">Read more</a></p>
        <h1>Useful Links</h1>
        <ul>
          <li><a target="_blank" href="https://www.bmcc.cuny.edu/">BMCC Website</a></li>
          <li><a target="_blank" href="https://www.bmcc.cuny.edu/directory/">BMCC Directory</a></li>
          <li><a target="_blank" href="https://www.bmcc.cuny.edu/a-z-index/">A-Z Index</a></li>
          <li><a target="_blank" href="https://www.bmcc.cuny.edu/library/">Library</a></li>
          <li><a target="_blank" href="https://www.bmcc.cuny.edu/academics/advisement/">Academic Advisement</a></li>
        </ul>
      </div>
      <div id="content">
        <h1><strong>Assignments</strong></h1>
       
        <p>Below are the assignments for each of your classes. Keep in mind to complete them before the deadline.</p>

        <?php

          // Retrieve data from the 'assignments' table along with corresponding class information
          $sql = "SELECT * FROM students
                  INNER JOIN student_assignments ON students.student_id = student_assignments.student_id 
                  INNER JOIN assignments ON student_assignments.assignment_id = assignments.assignment_id";
         
          $result = mysqli_query($con, $sql);

          // Check if any assignments were found
          if (mysqli_num_rows($result) > 0) {
              // Output the assignments and progress bars
              while ($row = mysqli_fetch_assoc($result)) {

                echo ("
                    <div style='border:solid #ADDC91 1px;background:#FFFFFF;float:left;width:47.9em'>
                        <p>" . $row['assignment_name'] . "</p>
                        " . $row['description'] . "<br>
                        <p>Due Date: " . $row['due_date'] . "</p>
                    </div>
                ");

                  // Calculate progress (e.g., completion percentage)
                  $progress = 50; // Replace this with actual progress calculation

                  // Output progress bar
                  echo "<div class='progress'>";
                  echo "<div class='progress-bar' role='progressbar' style='width: " . $progress . "%;' aria-valuenow='" . $progress . "' aria-valuemin='0' aria-valuemax='100'>" . $progress . "%</div>";
                  echo "</div>";

                }
              } else {
              // No assignments found
              echo "No assignments found.";
            }
        ?>

        <!-- <div style="border:solid #ADDC91 1px;background:#FFFFFF;float:left;width:47.9em">
        <div class="title">Data Structures</div><br><br>
        <br>Assignment 3: Write the required functions for unsorted doubly linked lists.
        <br>Due date: March 10th, 2024<br>
        <label for="file">Assignment 3 progress:</label>
        <progress id="file" value="32" max="100">32%</progress><br><br>
        Assignment 4: Write the required functions for unsorted doubly linked lists.
        <br>Due date: March 13th, 2024<br>
        <label for="file">Assignment 4 progress:</label>
        <progress id="file" value="65" max="100">65%</progress><br><br>
        </div>

        <div style="border:solid #ADDC91 1px;background:#FFFFFF;float:left;width:47.9em">
        <div class="title">Software Development</div><br><br>
        <br>Assignment 3: Create a HTML page about your resume.
        <br>Due date: April 14th, 2024<br>
        <label for="file">Assignment 3 progress:</label>
        <progress id="file" value="12" max="100">12%</progress><br><br>
        </div>

        <div style="border:solid #ADDC91 1px;background:#FFFFFF;float:left;width:47.9em">
        <div class="title">Fundamentals of Computer Systems</div><br><br>
        <br>Assignment 1: Base Conversions.
        <br>Due date: March 16th, 2024<br>
        <label for="file">Assignment 1 progress:</label>
        <progress id="file" value="100" max="100">100%</progress><br><br>
        Assignment 2: Binary Addition.
        <br>Due date: March 16th, 2024<br>
        <label for="file">Assignment 2 progress:</label>
        <progress id="file" value="100" max="100">100%</progress><br><br>
        Assignment 3: Boolean Minimization.
        <br>Due date: March 16th, 2024<br>
        <label for="file">Assignment 3 progress:</label>
        <progress id="file" value="78" max="100">78%</progress><br><br>
        Assignment 4: Standard and Canonical Forms.
        <br>Due date: March 16th, 2024<br>
        <label for="file">Assignment 4 progress:</label>
        <progress id="file" value="67" max="100">67%</progress><br><br>
        </div>

        <div style="border:solid #ADDC91 1px;background:#FFFFFF;float:left;width:47.9em">
        <div class="title">Web Programming I</div><br><br>
        <br>Project 1: Create a HTML website using the specified tags.
        <br>Due date: April 1st, 2024<br>
        <label for="file">Project 1 progress:</label>
        <progress id="file" value="24" max="100">24%</progress><br><br>
        </div> -->
      
      </div>
    </div>
    <div id="footer">
      <p><a href="index.php">Home</a> | <a href="login.php">Login</a> | <a href="classes.php">Classes</a> | <a href="assignments.php">Assignments</a> | <a target="_blank" href="https://www.bmcc.cuny.edu/about-bmcc/public-affairs/social-media-directory/">Contact Us</a></p>
      <p><a target="_blank" href="https://www.bmcc.cuny.edu/academics/academic-calendar/spring-regular-2024/">Calendar</a> | 
        <a target="_blank" href="https://www.bmcc.cuny.edu/admissions/bmcc-and-beyond/">BMCC & Beyond</a> | 
        <a target="_blank" href="https://www.bmcc.cuny.edu/academics/honors-and-awards/">Honors and Awards</a> | 
        <a target="_blank" href="https://www.bmcc.cuny.edu/academics/success-programs/">Success Programs</a></p>
    </div>
  </div>
  <div style="text-align: center; font-size: 0.75em;">Copyright &copy; 
    Ye Moe - BMCC Tech Innovation HUB Internship @ BMCC TECH LEARNING COMMUNITY</div>
</body>
</html>
