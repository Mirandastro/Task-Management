<?php
if (isset($_POST["fileId"])) {
    $dbHost = 'localhost';
    $dbUsername = 'dbadmin';
    $dbPassword = '';
    $dbName = 'gtlmhd';

    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fileId = $_POST["fileId"];

    $sql = "DELETE FROM files WHERE id = $fileId";

    if ($conn->query($sql) === TRUE) {
        echo "File deleted successfully.";
    } else {
        echo "Error deleting file.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>