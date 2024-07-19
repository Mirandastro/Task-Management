
<?php 

  /////////////////////////////////////////////////////////
  if (isset($_POST["name"])) 
  {
    require_once "dbconn.php"; 
  
    $name = $_POST['name'];

    $description = "undefined";
    if(isset($_POST["desc"])) {
      $description = $_POST['desc'];
    }

    $stime = $_POST['stime'];
    if(strlen($stime)<2) {
      $stime = "2023-09-20";
    }

    $etime = $_POST['etime'];
    if(strlen($etime)<2) {
      $etime = "2023-09-20";
    }

    $isgroup = 0;
    if(isset($_POST['isgroup'])) {
      $isgroup = 1;
    }

    $groupid = 0;
    if(isset($_POST['groupid'])) {
      $groupid = $_POST['groupid'];
    }
  
    $mbnum = 0; 
    $mb1 = 0;
    if(isset($_POST['mb1'])) {
      $mb1 = $_POST['mb1'];
      $mbnum++;
    }
    $mb2 = 0;
    if(isset($_POST['mb2'])) {
      $mb2 = $_POST['mb2'];
      $mbnum++;
    }
    $mb3 = 0;
    if(isset($_POST['mb3'])) {
      $mb3 = $_POST['mb3'];
      $mbnum++;
    }
    $mb4 = 0;
    if(isset($_POST['mb4'])) {
      $mb4 = $_POST['mb4'];
      $mbnum++;
    }
    $mb5 = 0;
    if(isset($_POST['mb5'])) {
      $mb5 = $_POST['mb5'];
      $mbnum++;
    }
    $mb6 = 0;
    if(isset($_POST['mb6'])) {
      $mb6 = $_POST['mb6'];
      $mbnum++;
    }
    $mb7 = 0;
    if(isset($_POST['mb7'])) {
      $mb7 = $_POST['mb7'];
      $mbnum++;
    }
    $mb8 = 0;
    if(isset($_POST['mb8'])) {
      $mb8 = $_POST['mb8'];
      $mbnum++;
    }

    $sql = "INSERT INTO Task(name, description, stime, etime,
    isgroup, groupid, mbnum,
    mb1, mb2, mb3, mb4, mb5, mb6, mb7, mb8) 
    VALUES(?,?,?,?, ?,?,?,  ?,?,?,?,?,?,?,?);" ;

    $statement = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($statement, $sql); 
    mysqli_stmt_bind_param($statement, 'ssssisiiiiiiiii', 
    $name, $description, $stime, $etime, 
    $isgroup, $groupid, $mbnum, 
    $mb1, $mb2, $mb3, $mb4, 
    $mb5, $mb6, $mb7, $mb8);  

    if(mysqli_stmt_execute($statement)) 
    {
      header("location: ../tasks.php"); 
    }
    else
    {
      echo mysqli_error($conn);
    }
  
    mysqli_close($conn);

  } 

?>






