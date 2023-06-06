<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include('../includes/mysqli_connect.php');
        $classID = $_POST['classID'];
        $name = $_POST['name'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $t_score = $_POST['t_score'];
        $p_score = $_POST['p_score'];
        $term = $_POST['term'];

        $query = "INSERT INTO exams (examClass, examName, exam_s_date, exam_e_date, totalScore, passingScore, term) VALUES ($classID, '$name', '$start', '$end', $t_score, $p_score, '$term')";
        if(mysqli_query($dbc, $query)) echo "Exam ID " . mysqli_insert_id($dbc) . " successfully added!";

        mysqli_close($dbc);
    }
?>