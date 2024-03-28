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
                margin-bottom: .1em;
                float: left;
                text-align: left;
                width: auto;
                font-weight: bold;
                font-variant: small-caps;
                text-align:right;
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
          <li class="selected"><a href="classes.php">Classes</a></li>
          <li><a href="assignments.php">Assignments</a></li>
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
        <h1><strong>Classes</strong></h1>
       
        <p>Below is the list of classes you have registered.</p>

        <?php

          // Retrieve data from the 'classes' table
          // $sql = "SELECT classes.* FROM classes INNER JOIN students ON ";
          $sql = "SELECT * FROM students
                  INNER JOIN student_classes ON students.student_id = student_classes.student_id
                  INNER JOIN classes ON student_classes.class_id = classes.class_id";

          $result = mysqli_query($con, $sql);

          // Check if any classes were found
          if (mysqli_num_rows($result) > 0) {
            // Output the classes
            while ($row = mysqli_fetch_assoc($result)) {
                echo ("
                    <div style='border:solid #ADDC91 1px;background:#FFFFFF;float:left'>
                        <div class='title'><a href='class_details.php?class_id=" . $row['class_id'] . "'>" . $row['class_name'] . "</a></div><br><br>
                        <p>" . $row['class_description'] . "</p>
                        Start Date: " . $row['class_start_date'] . "<br>
                        End Date: " . $row['class_end_date'] . "
                    </div>
                ");
            }
        }
        else {
              // No classes found
              echo "No classes found.";
        }

        ?>

        <!-- <div style="border:solid #ADDC91 1px;background:#FFFFFF;float:left">
        <div class="title" >Data Structures Honors</div><br><br>
        <span class="left"><img src="images/data_structs.jpeg" style="width:200px;" onclick=""/></span>
        <p>This course will introduce students to linear and non-linear data structures, 
          their use and implementation, algorithms, and software engineering techniques. 
          Topics will include: stacks, queues, lined lists, has tables, trees, graphs, 
          searching and sorting techniques. Asymptotic analysis of algorithms and data structures will also be discussed.
          Prerequisites: [CSC 211 and CSC 231] or departmental approval</p>
          <span style="float:right;text-align:left;padding:.5em;">
            <a href="data_structs.html">Go to class</a>
          </span>
        </p>
        </div>

        <div style="border:solid #ADDC91 1px;background:#FFFFFF;float:left">
          <div class="title">Software Development</div><br><br>
          <span class="left"><img src="images/software-development.jpeg" style="width:200px;" onclick=""/></span>
          <p>This course covers the fundamentals of software development, including software development life cycle, 
            object-oriented paradigm, design patterns and event-driven programming working in teams. 
            The students are required to develop software applications with graphic user interfaces and databases. 
            Prerequisite: CSC 211 or departmental approval</p>
            <span style="float:right;text-align:left;padding:.5em;">
              <a href="software_dev.html">Go to class</a>
            </span>
          </p>
        </div>

        <div style="border:solid #ADDC91 1px;background:#FFFFFF;float:left">
          <div class="title">Fundamentals of Computer Systems</div><br><br>
          <span class="left"><img src="images/computer_fundamentals.png" style="width:200px;" onclick=""/></span>
          <p>This course covers the fundamentals of computer organization and digital logic. 
            Topics include number systems and codes, Boolean algebra, digital circuits, combinational logic design principles, 
            sequential logic design principles, functional components of computer systems, hardware description language, and 
            assembly language. Students will use computer aided design (CAD) tools for digital logic design, analysis and simulation. 
            Prerequisite: CSC 111 or departmental approval</p>
            <span style="float:right;text-align:left;padding:.5em;">
              <a href="comp_syst.html">Go to class</a>
            </span>
          </p>
        </div>

        <div style="border:solid #ADDC91 1px;background:#FFFFFF;float:left">
          <div class="title">Web Programming I</div><br><br>
          <span class="left"><img src="images/web-prog.jpeg" style="width:200px;" onclick=""/></span>
          <p>This course introduces students to client-side web programming. Emphasis is placed on structure, 
            formatting and scripting of web pages as well as manipulation of media elements to solve elementary 
            level application problems. A variety of client-based technologies are introduced to facilitate the 
            understanding of design and programming concepts in a web environment. A final project consisting of 
            the creation of an online application will be developed. Prerequisite: CSC 110 or CSC 111 or department approval</p>
            <span style="float:right;text-align:left;padding:.5em;">
              <a href="web_prog.html">Go to class</a>
            </span>
          </p>
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
