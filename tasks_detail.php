<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}
?>

<?php
  $conn_dt = @mysqli_connect
  ("localhost", "dbadmin", "", "gtlmhd");
  if (!$conn_dt) {
    echo "Debugging error: " . 
    mysqli_connect_error() . "<br>";
    exit;
  }

  $id = $_GET['id'];
  $sql = "SELECT id, name, description, stime, etime, 
  fileid, isgroup, groupid, mbnum, 
  mb1, mb2, mb3, mb4, mb5, mb6, mb7, mb8
  FROM Task WHERE id=$id;";

  $result = mysqli_query($conn_dt, $sql);
  if ($result) 
  {
    if (mysqli_num_rows($result) >= 1) 
    {
      while ($row = mysqli_fetch_assoc($result)) 
      {
        $id = $row["id"];
        $name=$row["name"];
        $desc=$row["description"];
        $stime = $row["stime"];
        $etime = $row["etime"];     
        $fileid = $row["fileid"];     
        $isgroup = $row["isgroup"];    
        $groupid = $row["groupid"];    
        $mbnum = $row["mbnum"];  
        $mb1 = $row["mb1"];  
        $mb2 = $row["mb2"];  
        $mb3 = $row["mb3"];  
        $mb4 = $row["mb4"];  
        $mb5 = $row["mb5"];  
        $mb6 = $row["mb6"];  
        $mb7 = $row["mb7"];    
        $mb8 = $row["mb8"];  
      }
      mysqli_free_result($result);
    } 
  } 
  else 
  {
    echo "Query failed: " . mysqli_error($conn_dt);
  } 
  mysqli_close($conn_dt);

?>



<div id="myModal" class="modal" style="display:block;">

  <!-- Modal content: add new task-->
  <div id="div_addnew" class="modal-content">
    <div class="modal-header">
      <a class="close" href="tasks.php">&times;</a>
      <h2 id="dt_head"><?php echo $name; ?></h2>
    </div>

    <div class="modal-body">
    <form method="post" action="backend/task_update.php">

      <div class="div_dts">

        <div class="div_dts_col1">

          <input type="text" name="id" style="display:none;"
          value="<?php echo $id; ?>" />

          <label>Task name:</label>
          <input type="text" name="name" required 
          value="<?php echo $name; ?>" />
      
          <label>Description:</label>
          <input type="text" name="desc" 
          value="<?php echo $desc; ?>" />
      
          <label>Planned Start Time:</label>
          <input type="date" name="stime" 
          value="<?php echo $stime; ?>" />

          <label>Planned End Time:</label>
          <input type="date" name="etime" 
          value="<?php echo $etime; ?>" />

          <div>
          <?php

            if($isgroup>0)
            {
              echo
              '<input class="checkbox" type="checkbox" 
              name="isgroup" onclick="isgroupcheck(this)"
              checked>';
            }
            else
            {
              echo
              '<input class="checkbox" type="checkbox" 
              name="isgroup" onclick="isgroupcheck(this)"
              >';
            }

            

          ?>

            <label for="inp_isgroup">
              This is a group task.</label>
          </div>

        </div>

         <!-- //////////////////////////////////////////// -->

        <?php
        if($isgroup>0)
        {
          echo
          '<div id="div_as_mb" class="div_dts_col2"
          style="display:none;">';
        }
        else
        {
          echo
          '<div id="div_as_mb" class="div_dts_col2"
          style="display:flex;">';
        }
        ?>

          <div class="assign_row" >
            <div class="assign_name">
              <h2>Assign to: </h2>
            </div>
          </div>

          <?php

          $conn_mb = @mysqli_connect
          ("localhost", "dbadmin", "", "gtlmhd");
          if (!$conn_mb) {
            echo "Debugging error: " . 
            mysqli_connect_error() . "<br>";
            exit;
          }

          $sql = "SELECT id, name, profilenum, email, position, jtime
          FROM Member";

          $result = mysqli_query($conn_mb, $sql);
          if ($result) 
          {
            if (mysqli_num_rows($result) >= 1) 
            {
              $rownum = 0;
              while ($row = mysqli_fetch_assoc($result)) 
              {
                $rownum++;

                if(($row["id"] != $mb1) && ($row["id"] != $mb2) &&
                ($row["id"] != $mb3) && ($row["id"] != $mb4) && 
                ($row["id"] != $mb5) && ($row["id"] != $mb6) &&
                ($row["id"] != $mb7) && ($row["id"] != $mb8))
                {
                  $profilenum = $row["profilenum"];
                  if($profilenum < 1) $profilenum = 3;
                echo 
                '<div class="assign_row" >' . 
                  '<div class="assign_name">' . 
                    '<img src="profiles/p'.$profilenum.
                    '.jpg">' . 
                    '<h1>'.$row["name"].'</h1>' . 
                  '</div>' . 
                  '<div class="assign_position">' . 
                    $row["position"] . 
                  '</div>' .
                  '<input class="checkbox2" 
                  type="checkbox" name="mb'.$rownum.'"
                  value='.$row["id"].'>' . 
                '</div>'
                ;
                }
                else 
                {
                  echo 
                  '<div class="assign_row" >' . 
                  '<div class="assign_name">' . 
                    '<img src="profiles/p'.$row["profilenum"].
                    '.jpg">' . 
                    '<h1>'.$row["name"].'</h1>' . 
                  '</div>' . 
                  '<div class="assign_position">' . 
                    $row["position"] . 
                  '</div>' .
                  '<input class="checkbox2" 
                  type="checkbox" name="mb'.$rownum.'"
                  value='.$row["id"].' checked>' . 
                  '</div>'
                  ;
                }


              }
              mysqli_free_result($result);
            } 
          } 
          else 
          {
            echo "Query failed: " . mysqli_error($conn_mb);
          } 
          mysqli_close($conn_mb);

        ?>

        </div>

        <!-- //////////////////////////////////////////// -->

        <?php
        if($isgroup>0)
        {
          echo
          '<div id="div_as_gp" class="div_dts_col2"
          style="display:flex;">';
        }
        else
        {
          echo
          '<div id="div_as_gp" class="div_dts_col2"
          style="display:none;">';
        }
        ?>
        
          <div class="assign_row" >
            <div class="assign_name">
              <h2>Assign to: </h2>
            </div>
          </div>

          <?php

          $conn_gr = @mysqli_connect
          ("localhost", "dbadmin", "", "gtlmhd");
          if (!$conn_gr) {
            echo "Debugging error: ". mysqli_connect_error() ."<br>";
            exit;
          }

          $sql = "SELECT id, group_name
          FROM MyGroup";

          $result = mysqli_query($conn_gr, $sql);
          if ($result) 
          {
            if (mysqli_num_rows($result) >= 1) 
            {
              while ($row = mysqli_fetch_assoc($result)) 
              {
                if(($row["id"] != $groupid))
                {
                  echo 
                  '<div class="assign_row" >' . 
                    '<div class="assign_name">' . 
                      '<h1>'.$row["group_name"].'</h1>' . 
                    '</div>' . 
                    '<input class="checkbox2" 
                    type="radio" name="groupid" 
                    value='.$row["id"].'>' . 
                  '</div>'
                  ;
                }
                else
                {
                  echo 
                  '<div class="assign_row" >' . 
                    '<div class="assign_name">' . 
                      '<h1>'.$row["group_name"].'</h1>' . 
                    '</div>' . 
                    '<input class="checkbox2" 
                    type="radio" name="groupid" 
                    value='.$row["id"].' checked>' . 
                  '</div>'
                  ;
                }
              }
              mysqli_free_result($result);
            } 
          } 
          else 
          {
            echo "Query failed: " . mysqli_error($conn_gr);
          } 
          mysqli_close($conn_gr);

          ?>

        </div>


      </div>

      <div id="btnline">

        <input type="submit" class="btnc3"
        value="Update"/>

        <a class="btnc3" id="btn_cancel"
        href="tasks.php">Cancel</a>

        <a class="btnc3" id="btn_delete"
        href="backend/task_delete.php?id=
        <?php echo $_GET["id"]; ?>">
        Delete</a>

      </div>

    </form>
    </div>

    <br> <br>

  </div>

</div>

