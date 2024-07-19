
<?php 
  /////////////////////////////////////////////////////////

  $myObj = new stdClass();
  $myObj->id = 0;
  $myObj->name = "John";
  $myObj->desc = "New York";
  $myObj->stime = "06/11/2023";
  $myObj->etime = "07/11/2023";

  if (isset($_GET['id'])) 
  {
    require_once "dbconn.php"; 

    $id = $_GET['id'];
    $sql = "SELECT id, name, description, stime, etime, 
    fileid, isgroup, groupid, mbnum, 
    mb1, mb2, mb3, mb4, mb5, mb6, mb7, mb8
    FROM Task WHERE id=$id;";

    $result = mysqli_query($conn, $sql);
    if ($result) 
    {
      if (mysqli_num_rows($result) >= 1) 
      {
        while ($row = mysqli_fetch_assoc($result)) 
        {
          $myObj->id = $row["id"];
          $myObj->name=$row["name"];
          $myObj->desc=$row["description"];
          $myObj->stime = $row["stime"];
          $myObj->etime = $row["etime"];     
          $myObj->fileid = $row["fileid"];     
          $myObj->isgroup = $row["isgroup"];    
          $myObj->groupid = $row["groupid"];    
          $myObj->mbnum = $row["mbnum"];  
          
          $myObj->mb1 = $row["mb1"];  
          $myObj->mb2 = $row["mb2"];  
          $myObj->mb3 = $row["mb3"];  
          $myObj->mb4 = $row["mb4"];  
          $myObj->mb5 = $row["mb5"];  
          $myObj->mb6 = $row["mb6"];  
          $myObj->mb7 = $row["mb7"];    
          $myObj->mb8 = $row["mb8"];  


        }
        mysqli_free_result($result);
      } 
    } 
    else 
    {
      echo "Query failed: " . mysqli_error($conn);
    } 
    mysqli_close($conn);

  } 

  $myJSON = json_encode($myObj);
  echo $myJSON;

  /////////////////////////////////////////////////////////
?>






