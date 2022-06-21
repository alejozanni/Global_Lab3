<?php
session_start();
if(!isset($_SESSION['admin'])){
  header("location:../Login/login.php");
}
$dbhost= "localhost";
$dbuser ="root";
$dbpass ="";
$dbname = "defiathome2.0";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);



if(!$conn){
    die("no hay conexion: ".mysqli_connect_error());
}



//esta sentencia lo que hace es ver si ya se ha pulsado el boton de submit (agregar es el name del input submit)
if(isset($_POST['insert'])){
//extraer los datos del formulario 

$name= $conn->real_escape_string($_POST['name']);
$age= $conn->real_escape_string($_POST['age']);

if(!isset($_FILES['photo'])){
  $photo= '../../img/foto por defecto.jpg';
}else{
$photo=addslashes(file_get_contents($_FILES['photo']['tmp_name']));
}
$nationality= $conn->real_escape_string($_POST['nationality']);
$insertQuery= "INSERT INTO teachers( `name`, `age`, `nationality`, `photo`) VALUES(  '$name', '$age', '$nationality', '$photo')";
$insert= $conn->query($insertQuery);
header("location:admin.php");
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

    <title>Defi At Home</title>
  </head>
  <body>
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../Home/index.html">
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
                 <a href="search.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Buscar</button></a>
                 <a href="logout.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Salir</button></a>
            </div>
              </div>
            </div>
          </nav>
   

          <div class="tittle">
              <h1>Agregar profesor/a</h1>
          </div>

         <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="row">
           
            <input type="text" name="name"  class="form-control" placeholder="Nombre" required>
            <br>
        </div>
        <div class="row">
            <input type="text" name="age"  class="form-control" placeholder="Edad" required>
            <br>
        </div>
        <div class="row">
            <input type="text" name="nationality" class="form-control" placeholder="Nacionalidad" required>
            <br>
        </div>
        <div class="row">
        <br>
           <input type="file" name="photo"  placeholder="Insertar imagen" required >
           
        </div>
        <div class="row">
            <input type="submit" name="insert" value="Agregar" class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" >
        </div>
        </form>

    
  </body>
</html>