<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $group = $_POST['group'];
        $course = $_POST['course'];
        $s_time = $_POST['s_time'];
        $e_time = $_POST['e_time'];
        $sched = $_POST['sched'];
        $room = $_POST['room'];
        $campus = $_POST['campus'];
        
        $query = "INSERT INTO classes (groupNumber, courseCode, s_time, e_time, schedID, roomID, campusID) VALUES($group, '$course', '$s_time', '$e_time', $sched, $room, $campus)";
        if(mysqli_query($dbc, $query)) echo "Class ID " . mysqli_insert_id($dbc) . " successfully inserted!";
        
        mysqli_close($dbc);
    }
?>