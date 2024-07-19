<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<!---------------------------------------------------------------------------->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="HD">
    <meta name="description" content="GTLM">
    <title>GTLM-HD-C2</title>

    <link rel="stylesheet" type="text/css" href="styles/site.css">
    <link rel="stylesheet" type="text/css" href="styles/groups.css">
    <script src="scripts/groups.js" defer></script>

</head>

<body>
    <div class="site_content">
        <!-- //////////////////////////////////////////////////// -->
        <?php require_once "nav_top.php"; ?>

        <!-- //////////////////////////////////////////////////// -->
        <div class="site_center">
            <!-- ////////////////////////////////////////////////// -->
            <?php require_once "nav_left.php"; ?>

            <!-- ////////////////////////////////////////////////// -->
            <!-- ////////////////////////////////////////////////// -->
            <div class="site_main">

                <div class="top">
                    Groups Management
                    <p>
                        <?php require_once "backend/groupmenu.php"; ?>
                    <h1>Group Setting</h1>

                    <div class="groupcreate">
                        <form action="group_editing.php" method="POST">
                            <div class="input">
                                <label for="group_name">Group Name</label><br>
                                <input type="text" name="groupName" id="name" placeholder="Required" required /><br>

                                <label for="remove-member">Remove Member</label>
                                <input type="checkbox" name="actions[]" value="remove-member" /><br>
                                <input type="text" id="member" name="member" /><br>

                                <label for="edit-group-name">Change Group Name</label>
                                <input type="checkbox" name="actions[]" value="change-group-name" /><br>
                                <input type="text" id="name" name="newGroupName" /><br>

                                <label for="edit-project-name">Edit Project Name</label>
                                <input type="checkbox" name="actions[]" value="edit-project-name" /><br>
                                <input type="text" name="project-name" id="project-name" /><br>

                                <label for="change-leader">Change Leader</label>
                                <input type="checkbox" name="actions[]" value="change-leader" /><br>
                                <input type="text" name="leader" id="leader" /><br>
                            </div>

                            <div class="button-pop">
                                <button type="submit">Save</button>
                            </div>
                        </form>


                    </div>
                </div>
                </p>
            </div>
        </div>


</body>

</html>