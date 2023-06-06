<?php 
    include('includes/header.php'); 
    if(!isset($_GET['id']) || !isValidClassID($_GET['id'])) header("Location: index.php"); 
    $id = $_GET['id'];
    include('includes/mysqli_connect.php');
?>
	    <fieldset>
            <legend>Actions Available</legend>
            <h1 class="title">ACTIONS</h1>
            <div id="generatedForm" class="generatedForm">
            </div>
            <div id="btnList">
                <input type="button" value="Add Exam" class="option" aria-label="<?php echo $id; ?>" id="addExam">
                <input type="button" value="Remove Exam" class="option" aria-label="<?php echo $id; ?>" id="removeExam">
                <input type="button" value="Modify Exam" class="option" aria-label="<?php echo $id; ?>" id="modifyExam">
                <input type="button" value="Return to Student List" class="option" onclick="window.location.href='viewclass.php?id=<?php echo $id; ?>'">
            </div>
            <div id="output"></div>
	    </fieldset>
    </div>
    <div class="output">
        <fieldset id="fieldOutput">
            <legend id="fieldLegend">Exam List (Class ID: <?php echo $id; ?>)</legend>
            <table id="tableOutput">
                <thead>
                    <tr>
                        <th>Exam ID</th>
                        <th>Exam Name</th>
                        <th>Exam Start</th>
                        <th>Exam End</th>
                        <th>Total Score</th>
                        <th>Passing Score</th>
                        <th>Term</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('includes/mysqli_connect.php');
                            
                        $query = "SELECT * FROM exams WHERE examClass = $id";
                        if($r = mysqli_query($dbc, $query)) {
                            //while($row = mysqli_fetch_array($r)) {
                            for($i = 0; $i < mysqli_num_rows($r); $i++) {
                                $row = mysqli_fetch_array($r);
                                echo "<tr>
                                        <td>" . $row['examID'] . "</td>
                                        <td>" . $row['examName'] . "</td>
                                        <td>" . formatDate($row['exam_s_Date']) . "</td>
                                        <td>" . formatDate($row['exam_e_Date']) . "</td>
                                        <td>" . $row['totalScore'] . "</td>
                                        <td>" . $row['passingScore'] . "</td>
                                        <td>" . $row['term'] . "</td>
                                        <td><input type='button' value='View Exam' class='action viewExam' id='viewExam' aria-label='" . $row['examID'] . "'></td>
                                    </tr>";
                            }
                        }
                        
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>
<?php include('includes/footer.php'); ?>