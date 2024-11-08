<?php
function dbconnect(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    return $conn;
}
?>