<?php
$dbhost= "localhost";
$dbuser ="root";
$dbpass ="";
$dbname = "defiathome2.0";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn){
    die("no hay conexion: ".mysqli_connect_error());
}
?>