<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
}
$conn = new mysqli("localhost", "dbadmin", "", "gtlmhd");

$message = '';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['psw'];
        $repeat_pass = $_POST['psw-repeat'];

        if (empty($name) || empty($email) || empty($password) || empty($repeat_pass)) {
            $message = 'All fields are required';
        } elseif ($password !== $repeat_pass) {
            $message = 'Password does not match';
        } else {
            $check_sql = "SELECT * FROM member WHERE email = '{$email}'";
            $check_result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                $message = 'Email already exists. Please use a different email.';
            } else {
                $sql = "INSERT INTO member (name, email, password) VALUES ('{$name}', '{$email}', '{$password}')";
                $result = mysqli_query($conn, $sql);

                
                if ($result) {
                    header("location: index.php?registered");
                } else {
                    $message = 'Error: Unable to register the user.';
                }
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="styles/sign-up.css">
</head>

<body>
    <div class="image-container">
        <img src="icons/logo1.png" alt="Logo" class="logo">
        <form action="#" method="POST" id="signupForm" class="container-form">
            <div class="container">
                <h1>Sign Up to GTLM</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <p style="color: red;"><?php echo $message ?></p>


                <label for="name"><b>Full Name</b><br></br></label>
                <input type="text" value="<?= isset($_POST['name']) ? $_POST['name']: ''  ?>" placeholder="Enter Full Name" name="name" required>
                <br></br>
                <label for="email"><b>Email</b></label>
                <input type="email" value="<?= isset($_POST['email']) ? $_POST['email']: ''  ?>"  placeholder="Enter Email" name="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Enter Repeat Password" name="psw-repeat" required>

                <label>
                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                </label>

                <p>By creating an account you agree to our <a href="privacy-policy.html" style="color:dodgerblue">Terms & Privacy</a>.</p>

                <div class="clearfix">
                    <button type="button" class="cancelbtn" onclick="goToWelcomePage()">Cancel</button>
                    <button type="submit" class="signupbtn" name="submit">Sign Up</button>
                </div>
            </div>
        </form>
    </div>


</body>

</html>