<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        include "../includes/functions.php";
        include "../includes/mysqli_connect.php";
        if($_FILES['upload']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['upload']['tmp_name'];
            $fileName = $_FILES['upload']['name'];
            $fileType = $_FILES['upload']['type'];

            if($fileType == "text/csv") {
                $fileContent = file_get_contents($fileTmpPath);
                $headers = getHeadersFromFile($fileContent);
                /**
                     * $headers['groupnum']
                     * $headers['course']
                     * $headers['sched']
                     * $header['s_time']
                     * $header['e_time']
                     * $header['room'] 
                     * $header['campus']
                 */
                $idNums = getIDNumbersFromFile($fileContent);
                $names = getStudentNamesFromFile($fileContent);
                $courses = getStudentCoursesFromFile($fileContent);
                $schedID = getSchedule($headers['sched'], 1);
                $roomID = getClassroom($headers['room'], 1);
                $campusID = getCampus($headers['campus'], 1);
                
                for ($i=0; $i < count($courses); $i++) { 
                    if(!isValidCourse($courses[$i])) {
                        $query = "INSERT INTO courses (course) VALUES ('" . $courses[$i] . "')";
                        mysqli_query($dbc, $query);
                    }
                }
                if($schedID == -1) {
                    $query = "INSERT INTO schedules (schedule) VALUES ('" . $headers['sched'] . "')";
                    mysqli_query($dbc, $query);
                }
                if($roomID == -1) {
                    $query = "INSERT INTO classrooms (classroom) VALUES ('" . $headers['room'] . "')";
                    mysqli_query($dbc, $query);
                }
                if($campusID == -1) {
                    $query = "INSERT INTO campuses (campus) VALUES ('" . $headers['campus'] . "')";
                    mysqli_query($dbc, $query);
                }
                
                $totalStudents = count($idNums);

                $query = "INSERT INTO classes 
                                    (groupNumber, courseCode, s_time, e_time, schedID, roomID, campusID, totalStudents)
                                    VALUES 
                                    ('" . $headers['groupnum'] . "', '" . $headers['course'] . "', '" . $headers['s_time'] . "', '" . $headers['e_time'] . "', $schedID, $roomID, $campusID, $totalStudents)";
                mysqli_query($dbc, $query);

                $classID = mysqli_insert_id($dbc);

                for ($i=0; $i < $totalStudents; $i++) { 
                    $courseID = getCourse($courses[$i], 1);
                    $query = "INSERT INTO students
                                        (studentID, studentName, courseID, studentClass)
                                        VALUES
                                        ('" . $idNums[$i] . "', '" . $names[$i] . "', $courseID, $classID)";
                    mysqli_query($dbc, $query);
                }

                echo "Class ID $classID successfully imported ($totalStudents students added)!";
            }
        
            
        } else {
            echo "File upload failed.";
        }
    }
?>