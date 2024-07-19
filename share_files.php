<?php

session_start();

if (!isset($_SESSION['user'])) {
  header('Location: index.php');
}

$loged_in_user_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;



$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'gtlmhd';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userIDs = json_decode($_POST["userIDs"]);
    $fileID = $_POST["fileID"];
    $sql = "SELECT * FROM files WHERE id = '$fileID'" ;
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $dateUploaded = date('Y-m-d');
    $lastUpdated = date('Y-m-d');

    foreach ($userIDs as $userID) {
        $sql1 = "INSERT INTO files (file_name, date_uploaded, last_updated, mb_id) 
                VALUES ('".$row['file_name']."', '$dateUploaded', '$lastUpdated', '$loged_in_user_id')";
        if ($conn->query($sql1) === false) {
            echo "Error sharing the file: " . $conn->error;
        }
    }
    
    echo "File shared successfully with selected users.";

    $conn->close();
}
?>

