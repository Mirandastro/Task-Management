<?php
session_start();

if (isset($_SESSION['user'])) {
  header('Location: Dashboard.php');
}


$message = '';
$success_message = '';
$conn = new mysqli("localhost", "dbadmin", "", "gtlmhd");


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['registered'])) {
  $success_message = "Registered Successfully.";
}
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['psw'];

  $sql = "SELECT * FROM member WHERE email = '$email' AND password = '$password'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $result = mysqli_fetch_assoc($result);
    $_SESSION['user'] = $result;
    header("location:dashboard.php");
  } else {
    $message = "Email or password maybe incorrect";
  }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="styles/login.css">
</head>

<body>

  <div class="image-container">
    <img src="icons/logo1.png" alt="Logo" class="logo">
    <form action="#" method="POST" id="">
      <div class="imgcontainer">

      </div>

      <div class="container">
        <p style="color:green"><?php echo $success_message ?></p>
        <p style="color:red"><?php echo $message ?></p>

        <h2>Log in to GTML</h2>

        <label for="email"><b>Email</b></label>
        <input type="email" name="email" placeholder="Enter Email" value="" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" name="psw" placeholder="Enter Password" id="password" required>

        <div>
          <button type="submit" name="submit">Login</button>
        </div>

        <div>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
        </div>

      </div>

      <div class="container1">
        <button type="button" class="cancelbtn" onclick="goToSignUpPage()">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </form>
  </div>
</body>

</html>