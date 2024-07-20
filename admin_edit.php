<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}
?>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["edit_employee_name"])) {

    require_once "backend/dbconn.php";

    $memberId = $_POST["member_id"];
    $editedName = $_POST["edit_employee_name"];
    $editedEmail = $_POST["edit_employee_email"];
    $editedPosition = $_POST["edit_employee_position"];
    $editedJoinedDate = $_POST["edit_employee_joined_date"];

    $sql = "UPDATE Member SET name = '$editedName', email = '$editedEmail', position = '$editedPosition', jtime = '$editedJoinedDate' WHERE id = '$memberId'";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Redirection failed.";
        $response = ["success" => false];
        echo json_encode($response);
    }

    $conn->close();
    exit();
}


?>