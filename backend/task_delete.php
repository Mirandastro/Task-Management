
<?php 



if (isset($_GET['id'])) 
{
  require_once "dbconn.php"; 

  $id = $_GET['id'];

  echo $_GET['id'];

  $sql = "DELETE FROM Task WHERE id=?;";
  $statement = mysqli_stmt_init($conn);

  mysqli_stmt_prepare($statement, $sql); 
  mysqli_stmt_bind_param($statement, 's', 
  htmlspecialchars($_GET["id"]));  

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






