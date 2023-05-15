<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $examID = $_POST['examID'];

        $query = "SELECT * FROM exams WHERE examID = $examID";
        $r = mysqli_query($dbc, $query);
        if(mysqli_num_rows($r) > 0) {
            $query = "DELETE FROM exams WHERE examID = $examID";
            mysqli_query($dbc, $query);
            echo "Exam ID " . $entryID . " permanently removed!";
        }
        else echo "Invalid Exam ID!";

        mysqli_close($dbc);
    }
?>