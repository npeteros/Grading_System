<?php

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        include('../includes/mysqli_connect.php');

        $data = array();
        $query = "SELECT * FROM schedules";
        if($r = mysqli_query($dbc, $query)) {
            $i = 0;
            if(mysqli_num_rows($r) > 0) {
                while($row = mysqli_fetch_array($r)) {
                    $data[$i] = $row[1];
                    $i++;
                }
            }
        }
        mysqli_close($dbc);
        echo json_encode($data);
    }

?>