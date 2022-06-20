<?php 

include_once (__DIR__ . '../../Login/database.php');

session_start();

if(!isset($_SESSION['rol'])){
    header('location: ../Login/login.php');


}else{
    if($_SESSION['rol'] != 1){
        header('location: ../Login/login.php');
    }
}

$dbh = new Database();
$client = $dbh->connect();

$condition="";
if(!empty($_POST)){
$valor= $_POST['search'];
if(!empty($valor)){
    $condicion= "WHERE Producto LIKE '%$valor%'";
}
}

$consulta= "SELECT * FROM users WHERE rol_id = 2 AND $condition";
$query = $client->prepare($consulta);
$query->execute();
$result = $query->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Admin/css/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Defi At Home</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../Admin/admin.php">
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
                  
                <a href="insert.php"> <button class="btn btn-lg btn-outline-success" type="submit">Agregar</button></a>
                <a href="logout.php"> <button class="btn btn-lg btn-outline-success" type="submit">Salir</button></a>
            </div>
              </div>
            </div>
          </nav>
   
    <h1 class="titulo">Busqueda de profesores</h1>
    <br>
    <br>
    <div class="col-sm-12 col-md-12 col-lg12">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="d-grid gap-2 col-6 mx-auto">
        <input type="text" name="search" class="form-control" placeholder="Ingrese el nombre del profesor" ><br>
        <input type="submit" class=" btn btn-outline-success btn-lg boton " value="Buscar" name="buscando">
        <br>
    </div>
        </form>
    
    <div class="table-responsive table-hover" id="Tabla-productos">
        <?php if($result>0){ ?>
              <table class="table ">
                  <thead class="text-muted table-dark">
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Edad</th>
                        <th class="text-center">Nacionalidad</th>
                        <th class="text-center">Herramientas</th>
                  </thead>
                  <tbody>
                   <?php
                      foreach($result as $row): ?>
                        <tr>
                        <td class="text-center"> <?php echo $row['id'];?> </td>
                        <td class="text-center"> <?php echo $row['name'];?> </td>
                        <td class="text-center"> <?php echo $row['age'];?> </td> 
                        <td class="text-center"> <?php echo  $row['nationality'];?> </td> 
                        </tr>
                        <?php
                      endforeach
                   ?>
                  </tbody>
              </table>
                <?php }else{ ?>
                     <p class="text-center text-danger"> No se encuentra ese profesor/a</p>
                <?php } ?>
          </div>
          </div>
</body>
</html>