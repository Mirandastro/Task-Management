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
    <title>GTLM-HD-C2 Dashboard</title>

    <link rel="stylesheet" type="text/css" href="styles/site.css">
    <link rel="stylesheet" type="text/css" href="styles/dashboard.css">

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
            Dashboard - Overview
            <p>
              <!-- Overview -->
            </p>
          </div>

          <?php
            require_once "backend/dbconn.php";

            $newtasknum = 0;
            $sql = "SELECT id, name, description, stime, etime 
            FROM Task WHERE state=0;";

            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
              if (mysqli_num_rows($result) >= 1) 
              {
                while ($row = mysqli_fetch_assoc($result)) 
                {
                  $stime = date('d/m/Y',strtotime($row["stime"]));
                  $etime = date('d/m/Y',strtotime($row["etime"]));
                  $id = $row["id"];
                  $name = $row["name"];

                  $newtasknum++;
                }
                mysqli_free_result($result);
              } 
              else 
              {
                // echo " No tasks found.";
              }
            } 
            else 
            {
              echo "Query failed: " . mysqli_error($conn);
            } 


            $startedtasknum = 0;
            $sql = "SELECT id, name, description, stime, etime 
            FROM Task WHERE state=1;";

            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
              if (mysqli_num_rows($result) >= 1) 
              {
                while ($row = mysqli_fetch_assoc($result)) 
                {
                  $startedtasknum++;
                }
                mysqli_free_result($result);
              } 
              else 
              {
                // echo " No tasks found.";
              }
            } 
            else 
            {
              echo "Query failed: " . mysqli_error($conn);
            } 

            $donetasknum = 0;
            $sql = "SELECT id, name, description, stime, etime 
            FROM Task WHERE state=2;";

            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
              if (mysqli_num_rows($result) >= 1) 
              {
                while ($row = mysqli_fetch_assoc($result)) 
                {
                  $donetasknum++;
                }
                mysqli_free_result($result);
              } 
              else 
              {
                // echo " No tasks found.";
              }
            } 
            else 
            {
              echo "Query failed: " . mysqli_error($conn);
            } 

            $mbnum = 0;
            $sql = "SELECT id, name
            FROM member";

            $result = mysqli_query($conn, $sql);
            if ($result) 
            {
              if (mysqli_num_rows($result) >= 1) 
              {
                while ($row = mysqli_fetch_assoc($result)) 
                {
                  $mbnum++;
                }
                mysqli_free_result($result);
              } 
              else 
              {
                // echo " No tasks found.";
              }
            } 
            else 
            {
              echo "Query failed: " . mysqli_error($conn);
            } 



            mysqli_close($conn);

          ?>

          
          <div class="calendar">
            <h2>Today's Date</h2>
            <p id="date"></p>
          </div>
          <div class="dashboard-features">
            <div class="feature upcoming-task">
              <h2>New Tasks</h2>
              <p><?php echo $newtasknum; ?></p>
            </div>
            <div class="feature task-completed">
              <h2>Processing Tasks</h2>
              <p><?php echo $startedtasknum; ?></p>
            </div>
            <div class="feature overall-progress">
              <h2>Completed Tasks</h2>
              <p><?php echo $donetasknum; ?></p>
            </div>
            <div class="feature overall-progress">
              <h2>Registered Members</h2>
              <p><?php echo $mbnum; ?></p>
            </div>
          </div>
          
          <!-- <div class="recent-tasks">
            <h3>Recent Tasks</h3>
            <table>
              <thead>
                <tr>
                  <th>Task Name</th>
                  <th>Subject</th>
                  <th>Status</th>
                  <th>Last Update</th>
                </tr>
              </thead>
              <tbody id="task-list">
                Task rows will be dynamically added here
              </tbody>
            </table>
          </div> -->
          
          </div>

        </div>

      </div>

    
    </div>

    

    <script src="scripts/dashboard.js"></script>

  </body>



</html>




