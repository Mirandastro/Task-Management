<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_member_id"])) {

    require_once "backend/dbconn.php";

    $memberId = $_POST["delete_member_id"];

    $sql = "DELETE FROM Member WHERE id = $memberId";
    
    if ($conn->query($sql) === TRUE) {
        echo header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting member: " . $conn->error;
    }

    $conn->close();
    exit();
}
?>

