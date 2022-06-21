<?php
session_start();


$dbhost= "localhost";
$dbuser ="root";
$dbpass ="";
$dbname = "defiathome2.0";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);



if(!$conn){
    die("no hay conexion: ".mysqli_connect_error());
}
$id= $_REQUEST['id'];
$edit= "SELECT * FROM teachers WHERE id='$id' ";

$m = $conn->query($edit);
$dato = $m->fetch_array();

if(isset($_POST['edit'])){

$name= $conn->real_escape_string($_POST['name']);
$age= $conn->real_escape_string($_POST['age']);
$nationality= $conn->real_escape_string($_POST['nationality']);
//$photo=addslashes(file_get_contents($_FILES['photo']['tmp_name']));

if(!isset($_FILES['photo'])){
  $photo= $conn ->real_escape_string($_POST['photo']);
}else{
  $photo=addslashes(file_get_contents($_FILES['photo']['tmp_name']));
}


$up= "UPDATE teachers SET name= '$name', age = '$age', nationality = '$nationality', photo = '$photo' WHERE id = '$id' ";
$update= $conn->query($up);
header("location:admin.php");
  
}

if(!isset($_SESSION['admin'])){
  header("location:../Login/login.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../Admin/css/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Check Inventory</title>
  </head>
  <body>
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../Home/index.html">
                    <img
                      src="../img/logo/logoCompletoNegro.png"
                      alt=""
                      width="100"
                      height="100"
                      class="d-inline-block align-text-center logo-image"
                    />
                  </a>
              
                </div>
              
                <div class="d-flex">
                  
                 <a href="admin.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Volver</button></a>
                 <a href="insertar.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Agregar</button></a>
                 <a href="logout.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Salir</button></a>
            </div>
              </div>
            </div>
          </nav>
   

          <div class="titulo">
              <h1>Editar profesor/a</h1>
          </div>

         <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="id" value="<?php echo $dato['id']; ?>">
            <input type="text" name="name" value="<?php echo $dato['name']?>" class="form-control" placeholder="Nombre">
        </div>
        <div class="row">
            <input type="text" name="age" value="<?php echo $dato['age']?>" class="form-control" placeholder="Edad">
        </div>
        <div class="row">
            <input type="text" name="nationality" value="<?php echo $dato['nationality']?>" class="form-control" placeholder="Nacionalidad">
        </div>
        
        <div class="row">
        <img  width="100px" src="data:image/jpg;base64 ,<?php echo base64_encode($dato['photo']);?> " />
        
        <input type="file" name="photo" >
        </div>
       
        <div class="row">
            <input type="submit" name="edit" value="Editar" class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" >
        </div>
        
        </form>

    
  </body>
</html>

