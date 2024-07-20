<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="HD">
    <meta name="description" content="GTLM">
    <title>GTLM-HD-C3</title>

    <link rel="stylesheet" type="text/css" href="styles/site.css">
    <link rel="stylesheet" type="text/css" href="styles/admin.css">

    <script src="scripts/admin.js" defer></script>
</head>

<body>
    <div class="site_content">
        <?php require_once "nav_top.php"; ?>
        <div class="site_center">
            <?php require_once "nav_left.php"; ?>
            <div class="site_main">
                <div class="top">
                    Administration
                    <p>
                        Employees management
                    </p>
                </div>

                <div class="row">
                    <div id="tsk_new">
                        <button id="btn_new">Add New</button>
                    </div>
                </div>

                <div class="site_main">
                    <div class="main">
                        <div class="members-container">
                            <?php
                            require_once "backend/dbconn.php";
                            function outputMemberDetails($row) {
                                echo '<div class="row">';
                                echo '<div class="name">';
                                echo '<img src="icons/character2.jpg">';
                                echo '<h1>' . $row["name"] . '</h1>';
                                echo '</div>';
                                echo '<div class="email">' . $row["email"] . '</div>';
                                echo '<div class="position">' . $row["position"] . '</div>';
                                echo '<div class="joined">Joined ' . $row["created_at"] . '</div>';
                                echo '<button class="btn_ed" data-member-id="' . $row["id"] . '" data-member-name="' . $row["name"] . '" data-member-email="' . $row["email"] . '" data-member-position="' . $row["position"] . '" data-member-joined="' . $row["jtime"] . '">Edit</button>';
                                echo '<button class="btn_dl" data-member-id="' . $row["id"] . '">Delete</button>';
                                echo '</div>';
                            }

                            $sql = "SELECT * FROM Member";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    outputMemberDetails($row);
                                }
                            } else {
                                echo "No members found.";
                            }
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Member Confirmation Modal -->
    <div id="deleteMemberModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">

    <a class="close" href="admin.php">&times;</a>
    
      <h2>Delete Member</h2>
    </div>
    <div class="modal-body">
      <form id="deleteMemberForm" action="admin_delete.php" method="POST">
        <input type="hidden" name="delete_member_id" id="deleteMemberId" value="">
        <p>Are you sure you want to delete this employee?</p>
        <!-- <button id="btn_cancel_delete" class="btn_s2">Cancel</button> -->
        <input id="btn" type="submit" class="btn_s2" value="Confirm">
      </form>
    </div>
  </div>
</div>

    <!-- Add New Member Modal -->
    <div id="myModal" class="modal">
    <div id="div_detail" class="modal-content">
    <div class="modal-header">

    <a class="close" href="admin.php">&times;</a>
    <h2>Employee Detail</h2>
    </div>

    <div class="modal-body">
      <form id="addEmployeeForm" action="admin_add_new.php" method="POST">
        <label>Name:</label>
        <br>
        <input type="text" name="employee_name" />
        <br>
        <label>Email:</label>
        <br>
        <input type="email" name="employee_email"/>
        <br>
        <label>Position</label>
        <br>
        <input type="text" name="employee_position" />
        <br>
        <label>Joined Date:</label>
        <br>
        <input type="date" name="employee_joined_date" />
        <br>
        <input id="btn" type="submit" value="Save" />
        <br>
      </form>
    </div>
    </div>
    </div>

        <!-- Edit Member Modal -->
    
        <div id="editMemberModal" class="modal">
    <div class="modal-content">
    <div class="modal-header">

    <!-- <span class="close" id="editModalClose">&times;</span> -->
    <a class="close" href="admin.php">&times;</a>
    <h2>Edit Member</h2>
    </div>
    
    <div class="modal-body">
      <form id="editMemberForm" action="admin_edit.php" method="POST">
        <input type="hidden" name="member_id" id="editMemberId" value="">
        <br>
        <label>Name:</label>
        <br>
        <input type="text" name="edit_employee_name" id="editEmployeeName" />
        <br>
        <label>Email:</label>
        <br>
        <input type="email" name="edit_employee_email" id="editEmployeeEmail" />
        <br>
        <label>Position:</label>
        <br>
        <input type="text" name="edit_employee_position" id="editEmployeePosition" />
        <br>
        <label>Joined Date:</label>
        <br>
        <input type="date" name="edit_employee_joined_date" id="editEmployeeJoinedDate" />
        <br>
        <input id="btn" type="submit" value="Save" />
      </form>
    </div>
    </div>
    </div>

    
</body>
</html>