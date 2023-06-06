<?php
    $DB_HOST = "localhost";
    $DB_USERNAME = "root";
    $DB_PASSWORD = "";
    $DB_NAME = "grading_sys.sql";

    $dbc = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    mysqli_set_charset($dbc, "utf8");