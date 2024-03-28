<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

  include("connections.php");
  include("functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

//     // Handle image upload
//   if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
//   // Get the file extension
//   $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

//   // Define the upload directory
//   $upload_dir = '/Applications/XAMPP/xamppfiles/htdocs/inc/upload/';

//   // Generate a unique file name
//   $filename = uniqid() . '.' . $extension;

//   // Move the uploaded file to the upload directory
//   $uploaded_file = $upload_dir . $filename;
//   if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file)) {
//       // Save the file path to the database
//       $query = "INSERT INTO students (student_id, user_name, password, image_name, image_type, image_data) VALUES (?, ?, ?, ?, ?, ?)";
//       $stmt = mysqli_prepare($con, $query);
//       mysqli_stmt_bind_param($stmt, 'ssssss', $student_id, $user_name, $password, $filename, $extension, $uploaded_file);
//       mysqli_stmt_execute($stmt); 
//   } else {
//       echo "Image upload failed. Please try again.";
//   }
// }

  // // Handle image upload
  // if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
  //   // Process the uploaded image
  //   $name = $_FILES['image']['name'];
  //   $type = $_FILES['image']['type'];
  //   $data = file_get_contents($_FILES['image']['tmp_name']);
  // }

  //   if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
  //     //save to database
  //     $student_id = random_num(11);
  //     $query = "INSERT INTO students (student_id, user_name, password, image_name, image_type, image_data) VALUES (?, ?, ?, ?, ?, ?)";

  //     $stmt = mysqli_prepare($con, $query);
  //     mysqli_stmt_bind_param($stmt, 'ssssss', $student_id, $user_name, $password, $filename, $extension, $uploaded_file);
  //     mysqli_stmt_execute($stmt);
  //     $_SESSION['student_id'] = $student_id;
  //     header("Location: login.php");
  //     die;
  //   }
  //     else {
  //       echo "Image upload failed. Please try again.";
  //   }

  if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Process the uploaded image
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $data = file_get_contents($_FILES['image']['tmp_name']);

        // Insert user data and image data into the database
        $student_id = random_num(11);
        $query = "INSERT INTO students (student_id, user_name, password, image_name, image_type, image_data) VALUES ('$student_id', '$user_name', '$password', ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $name, $type, $data);
        mysqli_stmt_execute($stmt);

        // Redirect to login page after successful registration
        header("Location: login.php");
        exit;
    } else {
        echo "Image upload failed. Please try again.";
    }
} else {
    echo "Please enter valid information.";
}
  }
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>BMCC Incomplete Grades</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
<!--
  <script src="js/cookiemanager.js"></script>
  <script src="js/Login.js"></script>

  <script>
    function register()
    {
        let x=new Login();
        if(x.register(userid.value,password.value)) location.href="login.html";//REDIRECT TO LOGIN.HTML
        else message.innerHTML="ERROR: User already exists";
    }
  </script>
  -->
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="register.php">BMCC <span class="logo_colour">Incomplete (INC) Grades</span></a></h1>
          <h2>Learn about Incomplete Grades and how to resolve them</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="register.php">Register</a></li>
        </ul>
      </div>
    </div>
    <p style="padding:5.5px"></p><p></p>
    <div id="site_content">
      <div id="content" style="width:67em;">
        <h1 style="text-align:center;">Registration</h1>
        <p style="text-align:center;"><strong>Sign up using your BMCC student email.</strong></p>
        <form action="register.php" method="post" enctype="multipart/form-data">
          <div class="form_settings">
            <p><span style="padding:4px;text-align:center;margin-left:153px;margin-right:-10em;">Email:</span><input class="contact" type="email" name="user_name" id="user_name" style="margin-left: 100px;" placeholder="example.name001@bmcc.cuny.edu" autocomplete="off"/></p>
            <p><span style="padding:4px;text-align:center;margin-left:153px;margin-right:-10em;">Password:</span><input class="contact" type="password" name="password" id="password" style="margin-left: 100px;" placeholder="123456789" autocomplete="off"/></p>
            <p><span style="padding:4px;text-align:center;margin-left:153px;margin-right:-10em;">Upload Image:</span><input type="file" name="image" style="margin-left: 100px;" /></p>
            <p style="padding-top: 15px;margin-left:-30px;"><span>&nbsp;</span><input class="submit" type="submit" id="button" name="contact_submitted" value="Submit" /></p>
          </div>
        </form>
        <span style="float:left;text-align:left;padding:.5em;">
          <a href="login.php">Click here to login</a>
        </span>
        <p><br/><div id="message" style="padding:4px;"></div></p>
      </div>
    </div><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
    <div id="footer">
      <div class="space"></div>
      <p><a href="register.php">Registration</a> | 
        <a target="_blank" href="https://www.bmcc.cuny.edu/academics/academic-calendar/spring-regular-2024/">Calendar</a> | 
        <a target="_blank" href="https://www.bmcc.cuny.edu/about-bmcc/public-affairs/social-media-directory/">Contact Us</a> | 
        <a target="_blank" href="https://www.bmcc.cuny.edu/admissions/bmcc-and-beyond/">BMCC & Beyond</a></p>
    </div>
  </div>
  <div style="text-align: center; font-size: 0.75em;">Copyright &copy; 
    Ye Moe - BMCC Tech Innovation HUB Internship @ BMCC TECH LEARNING COMMUNITY</div>
</body>
</html>
