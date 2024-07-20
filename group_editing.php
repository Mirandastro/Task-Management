<?php

session_start();

if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (isset($_POST["actions"])) {
        $actions = $_POST["actions"];

        $groupName = $_POST["groupName"];
        $memberName = $_POST["member"];
        $newGroupName = $_POST["newGroupName"];
        $newProjectName = $_POST["project-name"];
        $newLeader = $_POST["leader"];
        
        require_once "backend/dbconn.php";
        $allActionsSuccessful = true;
        foreach ($actions as $action) {
        switch ($action) {
            case "remove-member":
                $sql = "DELETE FROM myMember WHERE group_name = ? AND group_member = ?";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql);
                mysqli_stmt_bind_param($statement, 'ss', $groupName, $memberName);
                if (!mysqli_stmt_execute($statement)) {
                    $allActionsSuccessful = false;
                    echo "Error removing member: " . mysqli_error($conn);
                }
                break;
                
            case "change-group-name":
                $sql = "UPDATE myGroup SET group_name = ? WHERE group_name = ?";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql);
                mysqli_stmt_bind_param($statement, 'ss', $newGroupName, $groupName);
                if (!mysqli_stmt_execute($statement)) {
                    $allActionsSuccessful = false;
                    echo "Error changing group name: " . mysqli_error($conn);
                }
                break;
                
            case "edit-project-name":
                $sql = "UPDATE myGroup SET project_name = ? WHERE group_name = ?";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql);
                mysqli_stmt_bind_param($statement, 'ss', $newProjectName, $groupName);
                if (!mysqli_stmt_execute($statement)) {
                    $allActionsSuccessful = false;
                    echo "Error editing project name: " . mysqli_error($conn);
                }
                break;
                
            case "change-leader":
                $sql = "UPDATE myGroup SET leader = ? WHERE group_name = ?";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql);
                mysqli_stmt_bind_param($statement, 'ss', $newLeader, $groupName);
                if (!mysqli_stmt_execute($statement)) {
                    $allActionsSuccessful = false;
                    echo "Error changing leader: " . mysqli_error($conn);
                }
                break;
        }
    }
        mysqli_stmt_close($statement);
        mysqli_close($conn);
        
        if ($allActionsSuccessful) {
            header("location: groups.php");
        }
    }
}
