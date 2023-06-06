<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $classID = $_POST['classID'];
        $name = $_POST['name'];
        $id = $_POST['id'];
        $course = $_POST['course'];

        $query = "SELECT * FROM students WHERE studentID = $id";
        if($r = mysqli_query($dbc, $query)) {
            if(mysqli_num_rows($r) == 0) {
                $query = "INSERT INTO students (studentID, studentName, courseID, studentClass) VALUES('$id', '$name', '$course', '$classID')";
                if(mysqli_query($dbc, $query)) echo "Student ID " . mysqli_insert_id($dbc) . " successfully inserted!";

                $query = "UPDATE classes SET totalStudents = totalStudents + 1 WHERE classID = $classID";
                mysqli_query($dbc, $query);
            } else {
                echo "Student ID already exists!";
            }
        }

        
        
        mysqli_close($dbc);
    }
?>