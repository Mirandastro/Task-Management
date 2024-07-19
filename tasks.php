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
    <title>GTLM-HD-C3</title>

    <link rel="stylesheet" type="text/css" href="styles/site.css">
    <link rel="stylesheet" type="text/css" href="styles/tasks.css">

    <script src="scripts/tasks.js" defer></script>

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
        <div class="site_main">

          <div class="top">
            Tasks
            <p>
              Tasks management allows users to view, add, edit, 
              and assign tasks.
            </p>
            <div id="tsk_new">
              Add New
            </div>
          </div>

          <div class="main">

            <div class="col">
              <div class="col_top">
                New
              </div>

              <div class="col_main" id="col_new" 
              ondrop="drop(event)" ondragover="allowDrop(event)">

                <?php
                  require_once "backend/dbconn.php";

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

                        echo '<div class="tsk_card"
                        draggable="true" ondragstart="drag(event)" 
                        id="drag1'.$row["id"].'" >' .
                        '<h1>'.$row["name"].'</h1>' . 
                        '<p>'.$stime.' -- '.$etime.'</p>'. 
                        '<p>'.$row["description"].'</p>' . 

                        '<a class="tsk_dt_btn"
                        href="tasks.php?detail=1&' .
                        'id=' . $row["id"] .'">
                        Details &nbsp; &gt;</a>' .

                        '</div>';

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
                  // mysqli_close($conn);

                ?>

              </div>

            </div>

            <!-- /////////////////////////////////////////////////// -->
            <div class="col">
              <div class="col_top">
                Started
              </div>

              <div class="col_main" id="col_started"
              ondrop="drop(event)" ondragover="allowDrop(event)">

                <?php
                  // require_once "backend/dbconn.php";

                  $sql = "SELECT id, name, description, stime, etime 
                  FROM Task WHERE state=1;";

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

                        echo '<div class="tsk_card"
                        draggable="true" ondragstart="drag(event)" 
                        id="drag1'.$row["id"].'" >' .
                        '<h1>'.$row["name"].'</h1>' . 
                        '<p>'.$stime.' -- '.$etime.'</p>'. 
                        '<p>'.$row["description"].'</p>' . 

                        '<a class="tsk_dt_btn"
                        href="tasks.php?detail=1&' .
                        'id=' . $row["id"] .'">
                        Details &nbsp; &gt;</a>' .

                        '</div>';

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
                  // mysqli_close($conn);

                ?>

              </div>
              
            </div>

            <!-- //////////////////////////////////////////////// -->
            <div class="col">
              <div class="col_top">
                Done
              </div>

              <div class="col_main" id="col_done"
              ondrop="drop(event)" ondragover="allowDrop(event)">

                <?php
                  // require_once "backend/dbconn.php";

                  $sql = "SELECT id, name, description, stime, etime 
                  FROM Task WHERE state=2;";

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

                        echo '<div class="tsk_card"
                        draggable="true" ondragstart="drag(event)" 
                        id="drag1'.$row["id"].'" >' .
                        '<h1>'.$row["name"].'</h1>' . 
                        '<p>'.$stime.' -- '.$etime.'</p>'. 
                        '<p>'.$row["description"].'</p>' . 

                        '<a class="tsk_dt_btn"
                        href="tasks.php?detail=1&' .
                        'id=' . $row["id"] .'">
                        Details &nbsp; &gt;</a>' .

                        '</div>'
                        ;

                      }
                      mysqli_free_result($result);
                    } 
                    else 
                    {
                      // echo " No tasks found.    ";
                    }
                  } 
                  else 
                  {
                    echo "Query failed: " . mysqli_error($conn);
                  } 
                  mysqli_close($conn);

                ?>

              </div>
    
            </div>

          </div>

        </div>

        <!-- //////////////////////////////////////////////////// -->
        <!-- //////////////////////////////////////////////////// -->

        <?php
        if (isset($_GET["new"])) 
        {
          include "tasks_addnew.php";
        }
        else if (isset($_GET["detail"])) 
        {
          include "tasks_detail.php";
        }
        else
        {
          echo 
          '<div id="myModal" class="modal">' .
            '<div class="modal-content">
              <div class="modal-header">
                <h2 id="dt_head">Task</h2>
              </div>
            </div>
          </div>'
          ;
        }
        ?>

        
      <!-- //////////////////////////////////////////////////// -->
      </div>

    </div>

  </body>

</html>

<!--------------------------------------------------------------->



