<!DOCTYPE html>
<!---------------------------------------------------------------------------->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="author" content="HD">
  <meta name="description" content="GTLM">
  <title>GTLM-HD-C3</title>

  <link rel="stylesheet" type="text/css" href="styles/site.css">
  <link rel="stylesheet" type="text/css" href="styles/groups.css">
  <script src="scripts/groups.js" defer></script>

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
          Groups Management
          <p>
            <?php require_once "backend/groupmenu.php"; ?>

          <?php
          require_once "backend/dbconn.php";

          if (isset($_GET['group_name'])) {
            $group_name = $_GET['group_name'];
        
            $sql = "SELECT group_member, email, member_role FROM myMember WHERE group_name = '$group_name'";
            $result = mysqli_query($conn, $sql);
        
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    echo "<h1>Group Details for $group_name</h1>";
                    echo "<table class='member-table'>
                          <tr>
                            <th>Member Name</th>
                            <th>Email</th>
                            <th>Role</th>
                          </tr>";
        
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['group_member']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['member_role']}</td>
                              </tr>";
                    }
        
                    echo "</table>";
                } else {
                    echo "<p>No members found for the selected group.</p>";
                }
            } else {
                echo "Error executing the query: " . mysqli_error($conn);
            }
        } else {
            echo "<p>No group selected.</p>";
        }

          mysqli_close($conn);
          ?>
          </p>
        </div>
      </div>
</body>

</html>