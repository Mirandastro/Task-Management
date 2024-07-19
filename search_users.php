<?php
$dbHost = 'localhost';
$dbUsername = 'dbadmin';
$dbPassword = '';
$dbName = 'gtlmhd';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST["email"])) {
    $email = $_POST["email"];
   $output = "";
$sql = "SELECT * FROM member WHERE email LIKE '%$email%'";

$result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $output .= "<div class='team-member'>
        <img src='images/avatar3.png' alt='User 3'>
        <div class='user-info'>
            <p>Name: $row[name]</p>
            <p>Email: $row[email]</p>
            
            <input type='checkbox' value='$row[id]'>
        </div>
    </div>";
        }
    }
    else{
        $output="<p>No User found related to this email!</p>";
    }
    echo $output;
}
?>