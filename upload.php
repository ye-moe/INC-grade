<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//session_start();

//check if an image file was uploaded
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $name = $_FILES['image']['name'];
    $type = $_FILES['image']['type'];
    $data = file_get_contents($_FILES['image']['tmp_name']);
    
    //connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=students', 'user_name', 'password');
    
    //insert the image data into the database
    $stmt = $pdo->prepare("INSERT INTO images (name, type, data) VALUES (?, ?, ?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $type);
    $stmt->bindParam(3, $data);
    $stmt->execute();
    
    //redirect back to your index page or wherever you want
    header("Location: index.php");
    die;
}

?>
