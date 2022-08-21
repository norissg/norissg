<?php
//localhost: server aka my laptop
$sname= "localhost";
$unmae= "root";
$password = "";
//name of the db
$db_name = "test_db";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);
//if the four parameters above do not pass, send message: connection failed
if (!$conn) {
    echo "Connection failed!";
}

