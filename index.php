<?php include('includes/header.php'); ?>
	    <fieldset>
            <legend>Actions Available</legend>
            <h1 class="title">ACTIONS</h1>
            <div id="generatedForm" class="generatedForm">
            </div>
            <div id="btnList">
                <input type="button" value="Add Class" class="option" id="addClass">
                <input type="button" value="Dissolve Class" class="option" id="dissolveClass">
                <input type="button" value="Modify Class" class="option" id="modifyClass">
                <!-- <input type="button" value="Adjust Grading System" class="option" id="adjustGrading"> -->
            </div>
            <div id="output"></div>
	    </fieldset>
    </div>
    <div class="output">
        <fieldset id="fieldOutput">
            <legend id="fieldLegend">Class List</legend>
            <table id="tableOutput">
                <thead>
                    <tr>
                        <th>Class ID</th>
                        <th>Group Number</th>
                        <th>Course Code</th>
                        <th>Class Schedule</th>
                        <th>Total Students</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('includes/mysqli_connect.php');
                        
                        $query = "SELECT * FROM classes";
                        if($r = mysqli_query($dbc, $query)) {
                            while($row = mysqli_fetch_array($r)) {
                                echo "<tr>
                                    <td>" . $row['classID'] . "</td>
                                    <td>" . $row['groupNumber'] . "</td>
                                    <td>" . $row['courseCode'] . "</td>
                                    <td>" . $row['classSchedule'] . "</td>
                                    <td>" . $row['totalStudents'] . "</td>
                                    <td><input type='button' value='View Class' class='action viewClass' id='viewClass' aria-label='" . $row['classID'] . "'></td>
                                </tr>";
                            }
                        }
                        mysqli_close($dbc);
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>
<?php include('includes/footer.php'); ?>