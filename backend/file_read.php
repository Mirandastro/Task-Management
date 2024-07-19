<?php
///////////////////////////////////////////////////////
if (isset($_POST["file_name"])) {
    require_once "dbconn.php";

    $name = $_POST['file_name'];
    $description = $_POST['desc']; 
    if ($_FILES["fileToUpload"]["error"] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $dateUploaded = date('Y-m-d');
            $lastUpdated = date('Y-m-d');
            $mb_id = 1;  

            $sql = "INSERT INTO files (file_name, description, date_uploaded, last_updated, mb_id) 
                    VALUES (?, ?, ?, ?, ?)";

            $statement = mysqli_stmt_init($conn);

            mysqli_stmt_prepare($statement, $sql);
            mysqli_stmt_bind_param($statement, 'ssssi',
                htmlspecialchars($name), $description, $dateUploaded, $lastUpdated, $mb_id);

            if (mysqli_stmt_execute($statement)) {
                header("location: ../files.php");
            } else {
                echo mysqli_error($conn);
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "Error: " . $_FILES["fileToUpload"]["error"];
    }

    mysqli_close($conn);
}
?>