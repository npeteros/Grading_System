<?php 
    include('includes/header.php');
    if(!isset($_GET['id'])) header("Location: index.php"); 
    $id = $_GET['id'];
    include('includes/mysqli_connect.php');

    $classID;

    $query = "SELECT studentClass FROM students WHERE studentID = $id";
    if($r = mysqli_query($dbc, $query)) {
        if(mysqli_num_rows($r) > 0) {
            $row = mysqli_fetch_array($r);
            $classID = $row['studentClass'];
        }
    }
?>
	    <fieldset>
            <legend>Actions Available</legend>
            <h1 class="title">ACTIONS</h1>
            <div id="generatedForm" class="generatedForm">
            </div>
            <div id="btnList">
                <input type="button" value="Return to Class List" class="option" onclick="window.location.href = 'viewclass.php?id=<?php echo $classID; ?>'">
            </div>
            <div id="output"></div>
	    </fieldset>
    </div>
    <div class="output">
        <fieldset id="fieldOutput">
            <legend id="fieldLegend">Student List</legend>
            <table id="tableOutput">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Student Course</th>
                        <th>Midterms Grade</th>
                        <th>Finals Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('includes/mysqli_connect.php');
                        
                        $query = "SELECT * FROM students WHERE studentClass = $id";
                        if($r = mysqli_query($dbc, $query)) {
                            while($row = mysqli_fetch_array($r)) {
                                echo "<tr>
                                    <td>" . $row['studentID'] . "</td>
                                    <td>" . $row['studentName'] . "</td>
                                    <td>" . $row['studentCourse'] . "</td>
                                    <td>" . $row['midterms_grade'] . "</td>
                                    <td>" . $row['finals_grade'] . "</td>
                                </tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>
<?php include('includes/footer.php'); ?>