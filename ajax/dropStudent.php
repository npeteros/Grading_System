<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $classID = $_POST['classID'];
        $studentID = $_POST['studentID'];

        $query = "DELETE FROM students WHERE studentID = '$studentID'";
        if(mysqli_query($dbc, $query)) echo "Student ID " . $studentID . " permanently dropped!";

        $query = "UPDATE classes SET totalStudents = totalStudents - 1 WHERE classID = $classID";
        mysqli_query($dbc, $query);
        
        mysqli_close($dbc);
    }
?>