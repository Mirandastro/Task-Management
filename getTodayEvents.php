<?php
require_once "backend/dbconn.php";

$tasks = [];

$sql = "SELECT id, name, description, stime, etime FROM Task WHERE state=1;";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = [
            'name' => $row["name"],
            'stime' => $row["stime"],
            'etime' => $row["etime"],
            'description' => $row["description"]
        ];
    }
    mysqli_free_result($result);
}

echo json_encode($tasks);
mysqli_close($conn);
?>
