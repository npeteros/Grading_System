<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $id = $_POST['id'];
        $group = $_POST['group'];
        $course = $_POST['course'];
        $s_time = $_POST['s_time'];
        $e_time = $_POST['e_time'];
        $sched = $_POST['sched'];
        $room = $_POST['room'];
        $campus = $_POST['campus'];

        $query = "UPDATE classes SET groupNumber = $group, courseCode = '$course', s_time = '$s_time', e_time = '$e_time', schedID = $sched, roomID = $room, campusID = $campus WHERE classID = $id";
        if(mysqli_query($dbc, $query)) echo "Class ID " . $id . " successfully modified!";        
       
        mysqli_close($dbc);
    }
?>