<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $id = $_POST['mid'];
        $name = $_POST['name'];
        $course = $_POST['course'];

        $totalStudents = 0;

        $query = "UPDATE students SET studentName = '$name', courseID = '$course' WHERE studentID = $id";
        if(mysqli_query($dbc, $query)) echo "Student ID " . $id . " successfully modified!";
        
        mysqli_close($dbc);
    }
?>