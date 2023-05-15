<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $examID = $_POST['examID'];
        $studentID = $_POST['studentID'];
        $studentScore = $_POST['studentScore'];

        $classID;
        $status = "";

        $query = "SELECT examClass, passingScore FROM exams WHERE examID = $examID";
        if($r = mysqli_query($dbc, $query)) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);

                $classID = $row['examClass'];
                if($studentScore >= $row['passingScore']) $status = "Passed";
                else $status = "Failed";
            }
        }

        $query = "SELECT * FROM students WHERE studentID = $studentID AND studentClass = $classID";
        if($r = mysqli_query($dbc, $query)) {
            if(mysqli_num_rows($r) > 0) {
                $query = "INSERT INTO exam_entries (examID, classID, studentID, score, status) VALUES ($examID, $classID, $studentID, $studentScore, '$status')";
                if(mysqli_query($dbc, $query))  echo "Entry ID " . mysqli_insert_id($dbc) . "  successfully added!";
            } else {
                echo "Error: Student not found!";
            }
        }


        
        mysqli_close($dbc);
    }
?>