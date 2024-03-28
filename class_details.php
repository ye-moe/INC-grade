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
                font-size: 2em;
                padding: .2em;
                margin-bottom: .1em;
                float: center;
                text-align: center;
                width: auto;
                font-weight: bold;
                font-variant: small-caps;
                text-align:center;
            }
</style>
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

      <?php
// Include database connection file
include_once "connections.php";

// Check if class_id parameter exists in the URL
if (isset($_GET['class_id'])) {
    // Get class_id from the URL
    $class_id = $_GET['class_id'];

    // Fetch class details from the database based on class_id
    $sql = "SELECT * FROM classes WHERE class_id = $class_id";
    $result = mysqli_query($con, $sql);

    // Check if class details are found
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch class details
        $row = mysqli_fetch_assoc($result);
        $class_name = $row['class_name'];
        $class_description = $row['class_description'];
        $class_start_date = $row['class_start_date'];
        $class_end_date = $row['class_end_date'];

        // Display class details
        echo "<div class='title'>$class_name</div><br><br>";
        echo "<p style='text-align:center;'>$class_description</p>";
        echo "<p style='padding-left:10px;'>Start Date: $class_start_date</p>";
        echo "<p style='padding-left:10px;'>End Date: $class_end_date</p>";
    } else {
        // Class not found
        echo "Class not found!";
    }
} else {
    // Class ID parameter not provided in the URL
    echo "Class ID not provided!";
}
?>

        <!-- <h1 style="text-align:center;">Data Structures Honors</h1>
        <span  style="padding:0;margin:0;"><center style="margin:0px;padding:0px;"><img src="images/data_structs.jpeg" width="90%" style="padding:0;margin:0;"></img></center></span>
         <p>This course will introduce students to linear and non-linear data structures, 
          their use and implementation, algorithms, and software engineering techniques. 
          Topics will include: stacks, queues, lined lists, has tables, trees, graphs, 
          searching and sorting techniques. Asymptotic analysis of algorithms and data structures will also be discussed.
          Prerequisites: [CSC 211 and CSC 231] or departmental approval</p>
         <ul>
			<li>Class: Data Structures Honors</li>
			<li>Professor: Anna Salvati</li>
			<li>Tuesdays: 10:00 AM - 12:15 PM</li>
			<li>Thursdays: 10:00 AM - 12:15 PM</li>
			<li>Room: F809 (Tuesdays) - F1006 (Thursdays)</li> <br/> -->

        <span style="float:left;text-align:left;padding-left:10px;">
          <a href="classes.php">Back</a>
        </span>
        <p></p>
      </li>
         </ul>
         
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

