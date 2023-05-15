<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $entryID = $_POST['entryID'];

        $query = "SELECT * FROM exam_entries WHERE resultID = $entryID";
        $r = mysqli_query($dbc, $query);
        if(mysqli_num_rows($r) > 0) {
            $query = "DELETE FROM exam_entries WHERE resultID = $entryID";
            mysqli_query($dbc, $query);
            echo "Entry ID " . $entryID . " permanently removed!";
        }
        else echo "Invalid Entry ID!";

        mysqli_close($dbc);
    }
?>