<?php
include('db.php');
$username=$_POST['username'];
$password=$_POST['password'];
session_start();
$_SESSION['username']=$username;


$connection=mysqli_connect("localhost","root","","defiathome");

$consult="SELECT*FROM users where username='$username' and password='$password'";
$result=mysqli_query($connection,$consult);

$filas=mysqli_num_rows($result);

if($filas){
  
    header("location:home.php");

}else{
    ?>
    <?php
    include("index.html");

  ?>
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
  <?php
}
mysqli_free_result($result);
mysqli_close($connection);