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
                <input type="button" value="Add Student" class="option" aria-label="<?php echo $id; ?>" id="addStudent">
                <input type="button" value="Drop Student" class="option" aria-label="<?php echo $id; ?>" id="dropStudent">
                <input type="button" value="Modify Student" class="option" aria-label="<?php echo $id; ?>" id="modifyStudent">
                <input type="button" value="View Exams"class="option" id="viewExams" onclick="window.location.href='viewexams.php?id=<?php echo $id; ?>'">
                <input type="button" value="Return to Class List" class="option" onclick="window.location.href = 'index.php'">
            </div>
            <div id="output"></div>
	    </fieldset>
    </div>
    <div class="output">
        <fieldset id="fieldOutput">
            <legend id="fieldLegend">Student List (Class ID: <?php echo $id; ?>)</legend>
            <table id="tableOutput">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Student Course</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        $query = "SELECT * FROM students WHERE studentClass = $id";
                        if($r = mysqli_query($dbc, $query)) {
                            while($row = mysqli_fetch_array($r)) {
                                echo "<tr>
                                    <td>" . $row['studentID'] . "</td>
                                    <td>" . $row['studentName'] . "</td>
                                    <td>" . getCourse($row['courseID']) . "</td>
                                    <td><input type='button' value='View Student' class='action viewStudent' id='viewStudent' aria-label='" . $row['studentID'] . "'></td>
                                </tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>
<?php include('includes/footer.php'); ?>