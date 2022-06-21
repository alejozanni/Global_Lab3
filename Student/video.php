<?php
session_start();

if(!isset($_SESSION['student'])){
  
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

$id= $_REQUEST['id'];
$consulta= "SELECT * FROM courses WHERE id='$id'";
$resultados=mysqli_query($conn,$consulta);
//$guardar = $conn->query($consulta);
$dato = $resultados->fetch_array();

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Student/css/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Defi At Home</title>
</head>

<body>


    <div class="container">
      <h2 class="text-center mt-3 mb-5" style="color:#666; font-weight: 800;">
        <?php echo $dato['name']; ?>
      </h2>

      <div class="row text-center">
        <div class="video-responsive">
            <iframe width="560" height="315" src="<?php echo $dato['url']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>

    <div >
      <br>
    <a href="student.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3 justify-content-center" type="submit">Volver</button></a>

</body>
</html>