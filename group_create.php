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
          <h1>Create Group</h1>


          <div class="groupcreate">
            <form action="group_add.php" method="POST">
              <div class="input">
                <label for="group_name">Group Name</label><br>
                <input type="text" name="groupName" id="name" placeholder="Required" required /><br>

                <label for="leader">Leader</label><br>
                <input type="text" id="leader" name="leader" placeholder="Required" required /><br>

                <label for="project-name">Project Name</label><br>
                <input type="text" name="project-name" id="project-name" placeholder="Required" required /><br>

              </div>

              <div class="button-pop">
              <button type="submit">Save</button>
            </div>
            </form>

            
          </div>
          </p>
        </div>
      </div>


</body>

</html>