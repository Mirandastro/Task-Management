<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$loged_in_user_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;

$message = '';

if (isset($_GET['saved'])) {
    $message = "File information inserted into the database successfully.";
}

if (isset($_POST["submit"])) {
    $dbHost = 'localhost';
    $dbUsername = 'dbadmin';
    $dbPassword = '';
    $dbName = 'gtlmhd';

   
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Connected to the database successfully";

    $target_dir = "uploads\\";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $dateUploaded = date('Y-m-d');
        $lastUpdated = date('Y-m-d');
        $mb_id = $loged_in_user_id;  

        
        $sql = "INSERT INTO files (file_name, file_type, date_uploaded, last_updated, mb_id) 
                VALUES ('$fileName', '$imageFileType', '$dateUploaded', '$lastUpdated', '$mb_id')";

        if ($conn->query($sql) === TRUE) {
            header("Location:files.php?saved");
        } else {
            $message =  "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message =  "File upload failed.";
    }

    $conn->close();
}


if (isset($_POST["deleteFile"])) {
    $fileIdToDelete = $_POST["deleteFile"];

    
    $dbHost = 'localhost';
    $dbUsername = 'dbadmin';
    $dbPassword = '';
    $dbName = 'gtlmhd';

    
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $deleteSql = "DELETE FROM files WHERE id = '$fileIdToDelete'";

    if ($conn->query($deleteSql) === TRUE) {
        $message = "File deleted successfully.";
    } else {
        $message = "Error deleting file: " . $conn->error;
    }
    
    $conn->close();
}


if (isset($_POST["file-edit"])) {

    $fileIdToEdit = $_POST["file-edit"];
    $fileName = $_POST["fileName"];
    $fileDescription = $_POST["fileDescription"];
    $lastUpdated = date('Y-m-d');


   
    $dbHost = 'localhost';
    $dbUsername = 'dbadmin';
    $dbPassword = '';
    $dbName = 'gtlmhd';

    
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $updateSql = "UPDATE files SET file_name = '$fileName', description = '$fileDescription', last_updated = '$lastUpdated' WHERE id = '$fileIdToEdit'";

    if ($conn->query($updateSql) === TRUE) {
        $message = "File updated successfully.";
    } else {
        $message = "Error deleting file: " . $conn->error;
    }
    $conn->close();
}


    $dbHost = 'localhost';
    $dbUsername = 'dbadmin';
    $dbPassword = '';
    $dbName = 'gtlmhd';

    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['my_files'])) {
        $sql = "SELECT f.*, m.name AS member_name
    FROM files f
    LEFT JOIN member m ON m.id = f.mb_id WHERE f.mb_id=$loged_in_user_id
    ORDER BY f.last_updated DESC ";
    } else {
        $sql = "SELECT f.*, m.name AS member_name
    FROM files f
    LEFT JOIN member m ON m.id = f.mb_id
    ORDER BY f.last_updated DESC";
    }



$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$currentUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$siteName = explode('/', parse_url($currentUrl, PHP_URL_PATH))[1];
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . $host . "/" . $siteName;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="HD">
    <meta name="description" content="GTLM">
    <title>GTLM-HD-C3</title>

    <link rel="stylesheet" type="text/css" href="styles/site.css">
    <link rel="stylesheet" type="text/css" href="styles/files.css">
    <script src="scripts/files.js" defer></script>
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
            <!-- ////////////////////////////////////////////////// -->
            <div class="site_main">
                <div class="top">
                    Files
                    <p>
                        Some description for your page.
                    </p>
                </div>

                <div class="main-container">
                    <div id="drop-area" class="drop-area">
                        <form action="files.php" method="post" enctype="multipart/form-data" id="fileUploadForm">
                            Select image to upload:
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submit">
                        </form>
                    </div>
                    <div class="attached-files">
                        <p style="color:green"><?= $message ?></p>
                        <div class="file-buttons">
                            <h2>Attached Files</h2>
                            <button id="viewAllButton">View All</button>
                            <button id="yourFilesButton">Your Files</button>
                            <!-- <button id="shareFilesButton">Share Files</button> -->
                            <div class="search-container">
                                <div class="search-input">
                                    <input type="text" placeholder="Search.." name="search" id="searchInput">
                                    <button id="submitimg" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="file-table" id="fileTable">
                                <!-- <thead>
                <tr>
                                    <th></th>
                                    <th>File Name</th>
                                    <th>Date Uploaded</th>
                                    <th>Last Updated</th>
                                    <th>Uploaded By</th>
                                    <th></th>
                                </tr>
                                
                </thead> -->

                                <tbody>



                                    <?php

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // Output table header
                                        echo "<table class='file-table' id='fileTable'>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<th></th>";
                                        echo "<th>File Name</th>";
                                        //echo "<th>File Type</th>";
                                        echo "<th>Date Uploaded</th>";
                                        echo "<th>Last Updated</th>";
                                        echo "<th>Uploaded By</th>";
                                        echo "<th></th>";
                                        echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";

                                        // Output data from the database
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr class='show-row'>";
                                            echo "<td class='select-checkbox'><input type='checkbox' class='fileCheckbox'></td>";
                                            echo "<td>" . $row["file_name"] . "</td>";
                                            echo "<td>" . $row["date_uploaded"] . "</td>";
                                            echo "<td>" . $row["last_updated"] . "</td>";
                                            echo "<td>" . $row["member_name"] . "</td>";
                                            echo "<td>";
                                            echo "<div class='button-container'>";
                                            echo "<form method='post' action='files.php'>";
                                            echo "<input type='hidden' name='deleteFile' value='" . $row["id"] . "'>";
                                            echo "<button type='submit' class='delete-button button'>Delete</button>";
                                            echo "</form>";
                                            echo "<button data-file-type='" . $row['file_type'] . "' data-id='" . $row['id'] . "' data-upload-date='" . $row['date_uploaded'] . "' data-update='" . $row['last_updated'] . "'  data-name='" . $row['file_name'] . "' data-description='" . $row['description'] . "' class='edit-button button'>Edit</button>";
                                            echo "<button class='share-button button' onclick=\"copy_link('" . $base_url . "/uploads/" . $row['file_name'] . "', " . $row['id'] . ")\">Share</button>";
                                            echo "</div>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }

                                        echo "</tbody>";
                                        echo "</table>";
                                    } else {
                                        echo "No files found in the database.";
                                    }

                                    $conn->close();

                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="edit-modal" id="editModal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Edit File</h2>

                <form action="files.php" method="POST">

                    <!-- File Name Input -->
                    <div class="file-detail">
                        <label for="fileName">File Name:</label>
                        <input type="text" id="fileName" name="fileName" required value="required">
                    </div>

                    <!-- File Type Input -->
                    <div class="file-detail">
                        <label for="fileType">File Type:</label>
                        <input type="text" id="fileType" name="fileType" placeholder="Enter file type">
                    </div>

                    <input type="hidden" name='file-edit' id='file-id' value=''>

                    <!-- Description Input -->
                    <div class="file-detail-Description">
                        <label for="fileDescription">Description:</label>
                        <textarea id="fileDescription" name="fileDescription" placeholder="Enter file description"></textarea>
                    </div>

                    <!-- Date Uploaded, Last Updated, Uploaded By Info -->
                    <!-- <table class="file-info">
                        <tr>
                            <th>Date Uploaded</th>
                            <th>Last Updated</th>
                            <th>Uploaded By</th>
                        </tr>
                        <tr>
                            <td id='date-uploaded'></td>
                            <td id='last-updated'></td>
                            <td id='uploaded-by'>User 1 (user1@example.com)</td>
                        </tr>
                    </table> -->

                    <!-- File Preview Section -->
                    <!-- <div class="file-preview">
                        <img src="icons/file.png" alt="File Preview">
                        <div class="file-info">
                            <p id='file-name'><strong>File Name:</strong> </p>
                            <p><strong>File Size:</strong> 2MB</p>
                        </div>
                        <button class="delete-button">Delete</button>
                    </div> -->

                    <!-- Drag and Drop Upload -->
                    <!-- <div class="drag-upload" id="dragUploadArea">
                              <img src="images/uploadfile.png" alt="Drag Icon">
                              <p>Drag and Drop to upload</p>
                            </div> -->

                    <!-- Buttons -->
                    <div class="button-container">
                        <button class="update-button" type='submit' id="">Update</button>
                        <!-- <button class="update-button" type='submit' id="updateButton">Update</button> -->
                        <button class="cancel-button" id="cancelButton">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="share-modal" id="shareModal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Share Modal Content</h2>
                <p>Invite your team to review and collaborate on this file.</p>

                <!-- Project Link -->
                <div class="projectlink">
                    <h4>Project Link</h4>
                    <div class="project-link-input">
                        <input type="text" id="share-link" value="https://example.com/project123" readonly>
                        <button class="copy-button" id="copy-link-button">Copy</button>
                    </div>
                </div>

                <!-- Project Link Credential -->

                <!-- <div class="credential-options">
                    <h4>Anyone with the link</h4>
                    <button class="credential-dropdown">Can View</button>
                    <div class="credential-dropdown-menu">
                        <ul>
                            <li>Can View</li>
                            <li>Can Edit</li>
                        </ul>
                    </div>
                </div> -->
                <input type="hidden" id='share-file-id' value=''>

                <!-- Invite Team Member -->
                <div class="inviteTeamMember">
                    <h4>Invite Team Member</h4>
                    <div class="invite-search">
                        <input type="text" placeholder="Search by email" id='search-email'>
                        <button id='search-user' class="send-invite-button">Send Invite</button>
                    </div>
                </div>

                <!-- Team Members -->
                <div class="TeamMember">
                    <h4>In this Group</h4>
                    <div class="team-members-row teams" id='team-member'>

                    </div>
                </div>
                <button class="Discard-Changes">Discard Changes</button>
                <button id='share' class="Save">Share</button>
            </div>
        </div>
        </td>
        </tr>

        <script>

            document.getElementById("copy-link-button").addEventListener("click", function() {
                const linkInput = document.getElementById("share-link");
                const linkText = linkInput.value;

                const tempInput = document.createElement("input");
                tempInput.value = linkText;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);

                alert("Link copied to clipboard");
            });

     
            var buttons = document.querySelectorAll(".edit-button");

            function showModal(name, description, date_uploaded, last_update, file_id) {
                document.getElementById("fileName").value = name;
                document.getElementById("fileDescription").textContent = description;
                document.getElementById("date-uploaded").textContent = date_uploaded;
                document.getElementById("last-updated").textContent = last_update;
                document.getElementById("file-name").innerHTML = "<strong>File Name:</strong> " + name;
                document.getElementById("file-id").value = file_id;
                modal.style.display = "block";
            }

            buttons.forEach(function(button) {
                button.addEventListener("click", function() {

                    var name = button.getAttribute("data-name");
                    var description = button.getAttribute("data-description");
                    var date_uploaded = button.getAttribute("data-upload-date");
                    var last_updated = button.getAttribute("data-update");
                    var file_id = button.getAttribute("data-id");
                    document.getElementById("file-id").value = file_id;

                    showModal(name, description, date_uploaded, last_updated, file_id);
                });
            });

            var shareButtons = document.querySelectorAll(".file-to-share");
    shareButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            var fileID = button.getAttribute("data-id");
            document.getElementById("share-file-id").value = fileID;
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        var searchButton = document.getElementById("search-user");
        var searchResults = document.getElementById("team-member");

        searchButton.addEventListener("click", function() {
            var email = document.getElementById("search-email").value;

            var serverURL = "search_users.php";

            var formData = new FormData();
            formData.append("email", email);

            fetch(serverURL, {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                searchResults.innerHTML = data;
            })
            .catch(error => {
                console.error("An error occurred:", error);
            });
        });
    });

            document.addEventListener("DOMContentLoaded", function() {
        var shareButton = document.getElementById("share");

        shareButton.addEventListener("click", function() {
            var selectedUserIDs = [];
            var checkboxes = document.querySelectorAll('.teams input[type="checkbox"]:checked');

            checkboxes.forEach(function(checkbox) {
                selectedUserIDs.push(checkbox.value);
            });

            if (selectedUserIDs.length === 0) {
                alert("Select at least one user to share the file with.");
            } else {
                var fileID = document.getElementById("share-file-id").value; // Replace with the file ID or information

                var data = new URLSearchParams();
                data.append("userIDs", JSON.stringify(selectedUserIDs));
                data.append("fileID", fileID);

                fetch("share_files.php", {
                    method: "POST",
                    body: data,
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    }
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload(); 
                })
                .catch(error => {
                    console.error("An error occurred:", error);
                });
            }
        });
    });
        </script>


</body>

</html>