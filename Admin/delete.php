<?php 
session_start();
if(!isset($_SESSION['admin'])){
    header("location: http://localhost/Global_lab3/Login/login.php");
  }
$dbhost= "localhost";
$dbuser ="root";
$dbpass ="";
$dbname = "defiathome2.0";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn){
    die("no hay conexion: ".mysqli_connect_error());
}

//consulta sql para eliminar
$id= $_GET['id'];
 $queryEliminar= "DELETE FROM teachers WHERE id = '$id'";
 $elimina = $conn->query($queryEliminar);
 header("location:admin.php");
 $conn->close();
?>