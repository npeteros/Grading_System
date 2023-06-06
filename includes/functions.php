<?php

function getSchedule($key, $mode=0) {
    include('mysqli_connect.php');
    if($mode == 0) {
        if($r = mysqli_query($dbc, "SELECT schedule FROM schedules WHERE schedID = $key")) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);
                return $row[0];
            }
        }
    } else if($mode == 1) {
        if($r = mysqli_query($dbc, "SELECT schedID FROM schedules WHERE schedule = '$key'")) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);
                return $row[0];
            }
        }
    }
    return -1;
}

function getClassroom($key, $mode=0) {
    include('mysqli_connect.php');
    if($mode == 0) {
        if($r = mysqli_query($dbc, "SELECT classroom FROM classrooms WHERE roomID = $key")) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);
                return $row[0];
            }
        }
    } else if($mode == 1) {
        if($r = mysqli_query($dbc, "SELECT roomID FROM classrooms WHERE classroom = '$key'")) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);
                return $row[0];
            }
        }
    }
    return -1;
}

function getCampus($key, $mode=0) {
    include('mysqli_connect.php');
    if($mode == 0) {
        if($r = mysqli_query($dbc, "SELECT campus FROM campuses WHERE campusID = $key")) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);
                return $row[0];
            }
        }
    } else if($mode == 1) {
        if($r = mysqli_query($dbc, "SELECT campusID FROM campuses WHERE campus = '$key'")) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);
                return $row[0];
            }
        }
    }
    return -1;
}

function getCourse($key, $mode=0) {
    include('mysqli_connect.php');
    if($mode == 0) {
        if($r = mysqli_query($dbc, "SELECT course FROM courses WHERE courseID = $key")) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);
                return $row[0];
            }
        }
    } else if($mode == 1) {
        if($r = mysqli_query($dbc, "SELECT courseID FROM courses WHERE course = '$key'")) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);
                return $row[0];
            }
        }
    }
    return -1;
}

function getStudent($key, $mode=0) {
    include('mysqli_connect.php');
    if($mode == 0) {
        if($r = mysqli_query($dbc, "SELECT studentName FROM students WHERE studentID = '$key'")) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);
                return $row[0];
            }
        }
    } else if($mode == 1) {
        if($r = mysqli_query($dbc, "SELECT studentID FROM students WHERE studentName = '$key'")) {
            if(mysqli_num_rows($r) > 0) {
                $row = mysqli_fetch_array($r);
                return $row[0];
            }
        }
    }
    return -1;
}

function formatTime($time) {
    return date('h:i A', strtotime($time));
}

function formatDate($date) {
    return date('M j, y - h:i A', strtotime($date));
}

function isValidClassID($id) {
    include('mysqli_connect.php');

    if($r = mysqli_query($dbc, "SELECT classID FROM classes WHERE classID = $id")) {
        if(mysqli_num_rows($r) > 0)  return true;
        else return false;
    }
}

function isValidExamID($id) {
    include('mysqli_connect.php');

    if($r = mysqli_query($dbc, "SELECT examID FROM exams WHERE examID = $id")) {
        if(mysqli_num_rows($r) > 0)  return true;
        else return false;
    }
}

function isValidCourse($key) {
    include('mysqli_connect.php');

    if($r = mysqli_query($dbc, "SELECT courseID FROM courses WHERE course = '$key'")) {
        if(mysqli_num_rows($r) > 0)  return true;
        else return false;
    }
}

function getHeadersFromFile($file) {
    if($fileContent = explode(",", $file)) {
        $header = array();
        $header_1 = explode(" ", $fileContent[15]);
        $header['groupnum'] = $header_1[1];
        $header['course'] = $header_1[2] . " " . $header_1[3];

        $header_2 = explode(" ", $fileContent[17]);
        $header['sched'] = $header_2[0];
        $header['s_time'] = $header_2[2] . " " . $header_2[3];
        $header['e_time'] = $header_2[5] . " " . $header_2[6];
        $header['room'] = trim(trim($header_2[7]), "TC");
        $header['campus'] = substr(trim($header_2[7]), -2);
        return $header;
    }
}

function getIDNumbersFromFile($file) {
    if($fileContent = explode(",", $file)) {
        $idNums = "";
        $ids = array();
        for($i = 22; $i < count($fileContent); $i+=5) {
            $idNums = trim($fileContent[$i]) . " ";
            array_push($ids, trim($idNums));
        }
        return $ids;
    }
}

function getStudentNamesFromFile($file) {
    if($fileContent = explode(",", $file)) {
        $names = "";
        $name_array = array();
        for($i = 23; $i < count($fileContent); $i+=5) {
            $names = ucwords(strtolower(trim($fileContent[($i+1)], "\" ") . " " . trim($fileContent[$i], "\" ")));
            array_push($name_array, trim($names));
        }
        return $name_array;
    }
}

function getStudentCoursesFromFile($file) {
    if($fileContent = explode(",", $file)) {
        $courses = "";
        $courses_array = array();
        for($i = 25; $i < count($fileContent); $i+=5) {
            $fileContent[$i] = explode(" ", $fileContent[$i]);
            $courses = $fileContent[$i][0] . " " . $fileContent[$i][1] . " ";
            array_push($courses_array, trim($courses));
        }
        return $courses_array;
    }
}