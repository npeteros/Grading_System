<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $id = $_POST['id'];
        $group = $_POST['group'];
        $course = $_POST['course'];
        $schedule = $_POST['schedule'];

        $totalStudents = 0;

        $query = "UPDATE classes SET groupNumber = $group, courseCode = '$course', classSchedule = '$schedule' WHERE classID = $id";
        if(mysqli_query($dbc, $query)) echo "Class ID " . $id . " successfully modified!";        
       
        mysqli_close($dbc);
    }
?>