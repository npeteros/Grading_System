<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $id = $_POST['id'];
        $studentID = $_POST['studentID'];
        $score = $_POST['score'];

        $status = "";
        $examID;

        $query = "SELECT examID FROM exam_entries WHERE resultID = $id";
        if($r = mysqlI_query($dbc, $query)) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);

                $examID = $row['examID'];
            }
        }

        $query = "SELECT passingScore FROM exams WHERE examID = $examID";
        if($r = mysqli_query($dbc, $query)) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);

                if($score >= $row['passingScore']) $status = "Passed";
                else $status = "Failed";
            }
        }

        $query = "SELECT * FROM students WHERE studentID = $studentID";
        $r = mysqli_query($dbc, $query);
        if(mysqli_num_rows($r) > 0) {
            $query = "UPDATE exam_entries SET studentID = $studentID, score = $score, status = '$status' WHERE resultID = $id";
            if(mysqli_query($dbc, $query)) echo "Entry ID " . $id . " successfully modified!";
        } else echo "Invalid Student ID";
        
        mysqli_close($dbc);
    }
?>