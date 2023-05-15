<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');

        $id = $_POST['id'];
        $name = $_POST['name'];
        $date = $_POST['date'];
        $t_score = $_POST['t_score'];
        $p_score = $_POST['p_score'];
        $term = $_POST['term'];

        $query = "UPDATE exams SET examName = '$name', examDate = '$date', totalScore = $t_score, passingScore = $p_score, term = '$term' WHERE examID = $id";
        if(mysqli_query($dbc, $query)) echo "Exam ID " . $id . " successfully modified!";
        
        mysqli_close($dbc);
    }
?>