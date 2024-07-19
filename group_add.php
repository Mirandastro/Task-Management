<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: index.php');
}


if (isset($_POST["groupName"]) && isset($_POST["leader"]) && isset($_POST["project-name"])) {
    $groupName = htmlspecialchars($_POST["groupName"]);
    $leader = htmlspecialchars($_POST["leader"]);
    $projectName = htmlspecialchars($_POST["project-name"]);

    require_once "backend/dbconn.php";
    $statement = mysqli_stmt_init($conn);

    $sql = "INSERT INTO myGroup (group_name, leader, project_name) VALUES (?, ?, ?)";
    
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, 'sss', $groupName, $leader, $projectName);

    if (mysqli_stmt_execute($statement)) {
        header("location: groups.php");
    } else {
        echo "Error adding group: " . mysqli_error($conn);
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);
} else {
    echo "Group data not provided.";
}
?>
