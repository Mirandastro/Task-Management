<?php


$logged_in_user_id = isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : 0;
$user_name = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : '';


?>

<script>
function goToWelcomePage() {
  window.location.href = 'welcome-page.html';
}
</script>

<div class="site_top">

  <div class="site_top_logo" onclick="goToWelcomePage()">
    <img src="icons/logo1.jpg">
  </div>

  <nav class="site_top_nav">

    <a id="nav_ds" class="site_top_nav_item" 
      href="dashboard.php">Dashboard</a>

    <a id="nav_file" class="site_top_nav_item"
      href="files.php">Files</a>

    <a id="nav_task" class="site_top_nav_item"
      href="tasks.php">Tasks</a>

    <a id="nav_gp" class="site_top_nav_item"
      href="groups.php">Groups</a>

    <a id="nav_calendar" class="site_top_nav_item"
      href="calendar.php">Calendar</a>
          
    <a id="nav_admin" class="site_top_nav_item"
      href="admin.php">Admin</a>
    
  </nav>
  
  <div class="site_top_right">
  <a id="nav_admin" class="site_top_nav_item" style="float: right; padding:20px" href="logout.php">Logout</a>

      <!-- <img src="icons/character2.jpg"> -->
  </div>

</div>

<!--------------------------------------------------------------->



