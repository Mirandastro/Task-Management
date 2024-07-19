<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: index.php');
}
?>

<?php
require_once "backend/dbconn.php";


if (!$conn) {
    echo "Error: Unable to connect to database.<br>";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    exit;
}

$name = $_POST["employee_name"];
$email = $_POST["employee_email"];
$position = $_POST["employee_position"];
$joined_date = $_POST["employee_joined_date"];

$sql = "INSERT INTO Member(name, email, position, jtime) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $position, $joined_date);

if ($stmt->execute()) {
    header ("location: admin.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
exit();
?>