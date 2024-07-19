
<?php 
  /////////////////////////////////////////////////////////

  $myObj = new stdClass();
  $myObj->id = 0;
  $myObj->name = "John";
  $myObj->pnum = 1;
  $myObj->email = "hd";
  $myObj->pos = "hd";
  $myObj->jtime = "07/11/2023";

  if (isset($_GET['id'])) 
  {
    require_once "dbconn.php"; 

    $id = $_GET['id'];
    $sql = "SELECT id, name, profilenum, email, position, 
    jtime
    FROM Member WHERE id=$id;";

    $result = mysqli_query($conn, $sql);
    if ($result) 
    {
      if (mysqli_num_rows($result) >= 1) 
      {
        while ($row = mysqli_fetch_assoc($result)) 
        {
          $myObj->id = $row["id"];
          $myObj->name=$row["name"];
          $myObj->pnum=$row["profilenum"];
          $myObj->email = $row["email"];
          $myObj->pos = $row["position"];
          $myObj->jtime = $row["jtime"];     
        
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






