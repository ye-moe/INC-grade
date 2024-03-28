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

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
      //read from the database
      $query = "select * from students where user_name = '$user_name' limit 1";

      $result = mysqli_query($con, $query);
      //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

      if(!$result){
        die("Error in query: " . mysqli_error($con));
      }
      
      if($result && mysqli_num_rows($result) > 0){
        $user_data = mysqli_fetch_assoc($result);
        //verify the password
        if($user_data['password'] === $password){
          $_SESSION['student_id'] = $user_data['student_id'];
          //redirect to index.php after successful login
          header("Location: index.php");
          die;
        }
        else{
          echo "Incorrect username or password!";
        }
      } 
      else{
        echo "Incorrect username or password!";
      }
    }
    else{
      echo "Incorrect username or password!";
    }
  }
/*
      if($result){
        if($result && mysqli_num_rows($result) > 0){
          $user_data = mysqli_fetch_assoc($result);
          $_SESSION['student_id'] = $user_data['student_id'];
          if($user_data['password'] === $password){
            header("Location: index.php");
            die;
          }
        }
      }
      echo "Incorrect username or password";
    }
    else{
      echo "Please enter some valid information!";
    }*/
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
    function login()
    {
      let x=new Login();
      if(x.login(userid.value,password.value)==true)
      {
        location.href="index.html";
        setCookie("flag","1",1);
      }
      else message.innerHTML = "ERROR: INVALID USER ID AND/OR PASSWORD";
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
          <h1><a href="login.php">BMCC <span class="logo_colour">Incomplete (INC) Grades</span></a></h1>
          <h2>Learn about Incomplete Grades and how to resolve them</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <!-- <script src="js/menu.js"></script> -->
          <li class="selected"><a href="login.php">Login</a></li>
        </ul>
      </div>
    </div>
    <p style="padding:5.5px"></p><p></p>
    <div id="site_content">
      <div id="content" style="width:67em;">
        <h1 style="text-align:center;">Login</h1>
        <p style="text-align:center;"><strong>Welcome Back to Your Dashboard:</strong> Log in to Manage Your Activities.</p>
        <form action="login.php" method="post">
          <div class="form_settings">
            <p><span style="padding:4px;text-align:center;margin-left:153px;margin-right:-10em;">Email:</span><input class="contact" type="email" name="user_name" id="user_name" style="margin-left: 100px;" placeholder="example.name001@bmcc.cuny.edu" autocomplete="off"/></p>
            <p><span style="padding:4px;text-align:center;margin-left:153px;margin-right:-10em;">Password:</span><input class="contact" type="password" name="password" id="password" style="margin-left: 100px;" placeholder="123456789" autocomplete="off"/></p>
            <p style="padding-top:15px;margin-left:-30px;"><span>&nbsp;</span><input class="submit" type="submit" id="button" value="Login"/></p>
            </div>
          </form>
          <span style="float:left;text-align:left;padding:.5em;">
            <a href="register.php">Click here to register</a>
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
