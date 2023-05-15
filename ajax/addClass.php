<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $group = $_POST['group'];
        $course = $_POST['course'];
        $schedule = $_POST['schedule'];

        $query = "INSERT INTO classes (groupNumber, courseCode, classSchedule) VALUES($group, '$course', '$schedule')";
        if(mysqli_query($dbc, $query)) echo "Class ID " . mysqli_insert_id($dbc) . " successfully inserted!";
        
        $query = "UPDATE global SET totalClasses = totalClasses + 1 WHERE unique_key = 1";
        mysqli_query($dbc, $query);
        
        mysqli_close($dbc);
    }
?>