<?php

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        include("../includes/mysqli_connect.php");
        $data = array();

        $query = "SELECT * FROM classes";
        if($r = mysqli_query($dbc, $query)) {
            $data[0] = mysqli_num_rows($r);
        }

        $query = "SELECT * FROM students";
        if($r = mysqli_query($dbc, $query)) {
            $data[1] = mysqli_num_rows($r);
        }

        echo json_encode($data);
        mysqli_close($dbc);
    }

?>