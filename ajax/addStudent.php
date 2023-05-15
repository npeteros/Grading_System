<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $classID = $_POST['classID'];
        $name = $_POST['name'];
        $course = $_POST['course'];

        $query = "INSERT INTO students (studentName, studentCourse, studentClass) VALUES('$name', '$course', '$classID')";
        if(mysqli_query($dbc, $query)) echo "Student ID " . mysqli_insert_id($dbc) . " successfully inserted!";

        $query = "UPDATE classes SET totalStudents = totalStudents + 1 WHERE classID = $classID";
        mysqli_query($dbc, $query);
        
        $query = "UPDATE global SET totalStudents = totalStudents + 1 WHERE unique_key = 1";
        mysqli_query($dbc, $query);
        
        mysqli_close($dbc);
    }
?>