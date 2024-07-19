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
          <h1>Group view</h1>

          <?php
          require_once "backend/dbconn.php";

          $sql = "SELECT
                      g.group_name,
                      g.leader,
                      g.project_name,
                      (SELECT COUNT(*) FROM myMember m WHERE m.group_name = g.group_name) AS member_count
                  FROM
                      myGroup g
                  LEFT JOIN
                  myMember m ON g.group_name = m.group_name
                  GROUP BY
                  g.group_name;
                  ";

          $result = mysqli_query($conn, $sql);

          if ($result) {
            if (mysqli_num_rows($result) > 0) {
              echo "<table class='group-table' border='1'>
               <tr>
               <th>Group Name</th>
               <th>Leader</th>
               <th>Project Name</th>
               <th>Member count</th>
              </tr>";

              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td><a href='group_details.php?group_name={$row['group_name']}'>{$row['group_name']}</a></td>
                <td>{$row['leader']}</td>
                <td>{$row['project_name']}</td>
                <td>{$row['member_count']}</td>
               </tr>";
              }

              echo "</table>";

              mysqli_free_result($result);
            } else {
              echo "No data found in the 'Group' table.";
            }
          } else {
            echo "Error executing the query: " . mysqli_error($conn);
          }

          mysqli_close($conn);
          ?>
          </p>
        </div>
      </div>
</body>

</html>