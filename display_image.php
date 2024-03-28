<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connections.php");
  include("functions.php");

session_start();

$user_data = check_login($con);

// Check if the 'id' parameter is set in the URL
if(isset($user_data['student_id'])) {
    // Get the ID of the student associated with the image
    $student_id = $user_data['student_id'];

    // Fetch the image file path from the students table
    $query = "SELECT image_name, image_type, image_data  FROM students WHERE student_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    //Check if any rows were returned
    if(mysqli_num_rows($result) > 0) {
        // Fetch the image file path
        $row = mysqli_fetch_assoc($result);
        $image_data = $row['image_data'];
        $image_type = $row['image_type'];

        // Check if the image file exists
        if(!empty($image_data)) {
            // Set the content type header
            // $file_extension = pathinfo($image_type, PATHINFO_EXTENSION);
            //if(file_exists($image_data)){
            //$mime_type = mime_content_type($image_data);
            // header("Content-Type: image/jpg");
            // header("Content-Type: image/png"); // For PNG images
            // header("Content-Type: image/jpeg"); // For JPEG images
            header("Content-Type: $image_type");

            // Output the image file
            echo $image_data;
        } else {    
            echo "hello.";
        }
    }
     else {
        echo "world.";
    }
} else {
    echo "Image ID not specified.";
}
//}
// Fetch the image data
// $row = mysqli_fetch_assoc($result);
// $image_data = $row['image_data'];

// // Set the content type header
// header("Content-Type: " . $row['image_type']);

// // Output the image data
// echo ($image_data);
?>



