<?php
    if($_SERVER['REQUEST_METHOD'] == "GET") {
        include('../includes/mysqli_connect.php');
        
        $id = $_GET['id'];
        $data = array();

        $query = "SELECT * FROM classes WHERE classID = $id";
        if($r = mysqli_query($dbc, $query)) {
            if(mysqli_num_rows($r) == 1) {
                while($row = mysqli_fetch_array($r)) {
                    $data = $row;
                }
                echo json_encode($data);
            } else echo json_encode(-1);
        }
    }
?>