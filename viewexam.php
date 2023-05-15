<?php 
    include('includes/header.php');
    if(!isset($_GET['id'])) header("Location: index.php"); 
    $id = $_GET['id'];
    include('includes/mysqli_connect.php');

    $classID;

    $query = "SELECT examClass FROM exams WHERE examID = $id";
    if($r = mysqli_query($dbc, $query)) {
        if(mysqli_num_rows($r) > 0) {
            $row = mysqli_fetch_array($r);
            $classID = $row['examClass'];
        }
    }
?>
	    <fieldset>
            <legend>Actions Available</legend>
            <h1 class="title">ACTIONS</h1>
            <div id="generatedForm" class="generatedForm">
            </div>
            <div id="btnList">
                <input type="button" value="Add Entry" class="option" aria-label="<?php echo $id; ?>" id="addEntry">
                <input type="button" value="Remove Entry" class="option" aria-label="<?php echo $id; ?>" id="removeEntry">
                <input type="button" value="Modify Entry" class="option" aria-label="<?php echo $id; ?>" id="modifyEntry">
                <input type="button" value="Return to Exam List" class="option" onclick="window.location.href='viewexams.php?id=<?php echo $classID; ?>'">
            </div>
            <div id="output"></div>
	    </fieldset>
    </div>
    <div class="output">
        <fieldset id="fieldOutput">
            <legend id="fieldLegend">Exam Entries (Exam ID: <?php echo $id; ?>)</legend>
            <table id="tableOutput">
                <thead>
                    <tr>
                        <th>Entry ID</th>
                        <th>Student Name</th>
                        <th>Overall Score</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('includes/mysqli_connect.php');

                        $student_name = "";
                        
                        $query = "SELECT * FROM exam_entries WHERE examID = $id";
                        if($r = mysqli_query($dbc, $query)) {
                            while($row = mysqli_fetch_array($r)) {
                                $student_id = $row['studentID'];
                                $query = "SELECT studentName FROM students WHERE studentID = $student_id";
                                if($res = mysqli_query($dbc, $query)) {
                                    if(mysqli_num_rows($res) > 0) {
                                        $result = mysqli_fetch_array($res);
                                        $student_name = $result[0];
                                    }
                                }
                                echo "<tr>
                                    <td>" . $row['resultID'] . "</td>
                                    <td>" . $student_name . "</td>
                                    <td>" . $row['score'] . "</td>
                                    <td>" . $row['status'] . "</td>
                                </tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>
<?php include('includes/footer.php'); ?>