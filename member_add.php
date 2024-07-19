<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: index.php');
}

if (isset($_POST["groupName"]) && isset($_POST["member"]) && isset($_POST["email"]) && isset($_POST["role"])) {
    $groupName = htmlspecialchars($_POST["groupName"]);
    $member = htmlspecialchars($_POST["member"]);
    $email = htmlspecialchars($_POST["email"]);
    $member_role = htmlspecialchars($_POST["role"]);

    require_once "backend/dbconn.php";
    $statement = mysqli_stmt_init($conn);

    $sql = "INSERT INTO myMember (group_name, group_member, email, member_role) VALUES (?, ?, ?, ?)";
    
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, 'ssss', $groupName, $member, $email, $member_role);

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
