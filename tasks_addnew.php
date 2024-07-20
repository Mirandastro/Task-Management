<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}
?>


<div id="myModal" class="modal" style="display:block;">


  <!-- Modal content: add new task-->
  <div id="div_addnew" class="modal-content">
    <div class="modal-header">
      <a class="close" href="tasks.php">&times;</a>
      <h2 id="dt_head">Add a New Task</h2>
    </div>

    <div class="modal-body">

      <form method="post" action="backend/task_add.php">

        <div class="div_dts">

          <div class="div_dts_col1">

            <label>Task name:</label>
            <input type="text" name="name" required 
            placeholder="Required" />
        
            <label>Description:</label>
            <input type="text" name="desc"/>
        
            <label>Planned Start Time:</label>
            <input type="date" name="stime" />

            <label>Planned End Time:</label>
            <input type="date" name="etime" />

            <div>
              <input class="checkbox" type="checkbox" 
              name="isgroup" onclick="isgroupcheck(this)">
              <label for="inp_isgroup">
                This is a group task.</label>
            </div>

          </div>

          <div id="div_as_mb" class="div_dts_col2">

            <div class="assign_row" >
              <div class="assign_name">
                <h2>Assign to: </h2>
              </div>
            </div>

            <?php

              $conn_an = @mysqli_connect
              ("localhost", "dbadmin", "", "gtlmhd");
              if (!$conn_an) {
                echo "Debugging error: " . 
                mysqli_connect_error() . "<br>";
                exit;
              }

              $sql = "SELECT id, name, profilenum, email, position, jtime
              FROM Member";

              $result = mysqli_query($conn_an, $sql);
              if ($result) 
              {
                if (mysqli_num_rows($result) >= 1) 
                {
                  $rownum = 0;
                  while ($row = mysqli_fetch_assoc($result)) 
                  {
                    $rownum++;
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
                  mysqli_free_result($result);
                } 
              } 
              else 
              {
                echo "Query failed: " . mysqli_error($conn_an);
              } 
              mysqli_close($conn_an);

            ?>

                  
          </div>

          <div id="div_as_gp" class="div_dts_col2" style="display:none;">

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

        <br>
        <input id="btn_sbm" type="submit" value="SAVE"/>

      </form>

    </div>

    <br>

  </div>

</div>


