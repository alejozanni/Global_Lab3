<?php 

session_start();
if(!isset($_SESSION['admin'])){
  header("location:http://localhost/Global_lab3/Admin/admin.php");
}

$dbhost= "localhost";
$dbuser ="root";
$dbpass ="";
$dbname = "defiathome2.0";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn){
    die("no hay conexion: ".mysqli_connect_error());
}

$condition="";

if(!empty($_POST)){
$value= $_POST['search'];
  if(!empty($value)){
    $condition= "WHERE name LIKE '%$value%'";
  }
}
$consulta= "SELECT * FROM teachers $condition";
$result= $conn->query($consulta);


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
                <a href="insert.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Agregar</button></a>
                <a href="logout.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Salir</button></a>
            </div>
              </div>
            </div>
          </nav>
   
    <h1 class="titulo">Busqueda de profesor/a</h1>
    <br>
    <br>
    <div class="col-sm-12 col-md-12 col-lg12">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="d-grid gap-2 col-6 mx-auto">
        <input type="text" name="search" class="form-control" placeholder="Ingrese el nombre del profesor/a" ><br>
        <input type="submit" class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" value="Buscar" name="buscando">
        <br>
    </div>
        </form>
    
    <div class="table-responsive table-hover table" id="Tabla-profesores">
        <?php if($result->num_rows>0){ ?>
          <table class="table-striped">
                  <thead class="text-muted table-bordered">
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre </th>
                        <th class="text-center">Edad</th>
                        <th class="text-center">Nacionalidad</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Editar</th>
                        <th class="text-center">Eliminar</th>
                        
                  </thead>
                  <tbody>
                    <?php
                    while($row =$result->fetch_assoc()){ ?>
                      <tr>
                        <td class="text-center"> <?php echo $row['id'];?></td>
                        <td class="text-center"> <?php echo $row['name'];?></td>
                        <td class="text-center"> <?php echo $row['age'];?></td>
                        <td class="text-center"> <?php echo $row['nationality'];?></td>
                        <td class="text-center "> <img  width="100px" src="data:image/jpg;base64 ,<?php echo base64_encode($row['photo']);?> " /></td>
                        <td class="text-center"> <a href="edit.php?id=<?php echo $row['id'] ?>">Editar</a></td>
                        <td class="text-center"> <a href="delete.php?id=<?php echo $row['id']?> ">Eliminar</a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
              </table>
                <?php }else{ ?>
                     <p class="text-center text-danger"> No se encuentran ese profesor/a </p>
                <?php } ?>
          </div>
          </div>
</body>
</html>

