<?php

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        include("../includes/mysqli_connect.php");
        $data = array();
        $query = "SELECT * FROM global LIMIT 1";
        if($r = mysqli_query($dbc, $query)) {
            if(mysqli_num_rows($r) == 1) {
                while($row = mysqli_fetch_array($r)) {
                    $data = $row;
                }
            }
        }
        echo json_encode($data);
        mysqli_close($dbc);
    }

?>