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

    $consulta= "SELECT * FROM users WHERE rol_id = 2";
    $query = $client->prepare($consulta);
    $query->execute();
    $result = $query->fetchAll();
    
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

          <div class="table-responsive table-hover table" id="Tabla-productos">
            <br>
              <table class="table-striped">
                  <thead class="text-muted table-bordered">
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre </th>
                        <th class="text-center">Edad</th>
                        <th class="text-center">Nacionalidad</th>
                        <th class="text-center">Herramientas</th>
                        
                  </thead>
                  <tbody>
                   <?php
                     // for($index = 0; count($result) > $index;$index++){
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

          </div>

    
  </body>
</html>