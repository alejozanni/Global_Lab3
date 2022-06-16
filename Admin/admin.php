<?php
    include_once '../Login/database.php';

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: ../Login/login.php');

    
    }else{
        if($_SESSION['rol'] != 1){
            header('location: ../Login/login.php');
        }
    }

    $one=1;

    $dbhost= "localhost";
    $dbuser ="root";
    $dbpass ="";
    $dbname = "defiathome";
    $conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if(!$conn){
        die("no hay conexion: ".mysqli_connect_error());
    }

    $consulta= "SELECT * FROM users";
    $resultado= $conn->query($consulta);

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
                      src="../img/logo/soloCompletoNegro.png"
                      alt=""
                      width="100"
                      height="100"
                      class="d-inline-block align-text-center logo-image"
                    />
                    Defi At Home
                  </a>
              
                </div>
              
                <div class="d-flex">
                  
                  <a href="search.php"> <button class="btn btn-lg btn-outline-success" type="submit">Buscar</button></a>
                  <a href="insert.php"> <button class="btn btn-lg btn-outline-success" type="submit">Agregar</button></a>
                  <a href="logout.php"> <button class="btn btn-lg btn-outline-success" type="submit">Salir</button></a>
   
            </div>
              </div>
            </div>
          </nav>
   

          <div class="titulo">
              <h1>Listado de profesores</h1>
          </div>

          <div class="table-responsive table-hover table-dark" id="Tabla-productos">
            <br>
              <table class="table ">
                  <thead class="text-muted table-dark">
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre </th>
                        <th class="text-center">Edad</th>
                        <th class="text-center">Nacionalidad</th>
                        <th class="text-center">Foto</th>
                        
                  </thead>
                  <tbody>
                    <?php
 
                    while($row =$query->fetch()){ ?>
                      <tr>
                        <td class="text-center"> <?php echo $row['id'];?></td>
                        <td class="text-center"> <?php echo $row['name'];?></td>
                        <td class="text-center"> <?php echo $row['age'];?></td>
                        <td class="text-center"> <?php echo $row['nacionality'];?></td>
                        <td class="text-center "> <img  width="100px" src="data:image/jpg;base64 ,<?php echo base64_encode($row['Foto']);?> " /></td>
                        <!-- pasamos los datos de esa fila a travez del campo id -->
                        <td class="text-center"> <a href="edit.php?id=<?php echo $row['id']  ?>">Editar-<a href="delete.php?id=<?php echo $row['id']?> ">Borrar</a></td>
                      </tr>
                    <?php } ?>
                  </tbody>
              </table>

          </div>

    
  </body>
</html>