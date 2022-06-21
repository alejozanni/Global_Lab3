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

$consulta= "SELECT * FROM teachers";
$guardar = $conn->query($consulta);

$cant_filas= mysqli_num_rows($guardar);
$articulos_por_pagina=2;

$paginas= ceil( $cant_filas/$articulos_por_pagina);


  if(isset($_GET['name'])){
    $name = $_GET['name'];
  }else{
   $name= 'ASC';
  }
  
  if(isset($_GET['idcolumn'])){
    $idcolumn = $_GET['idcolumn'];
  }else{
   $idcolumn= 'id';
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
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../Home/index.html">
                    <img src="../img/logo/logoCompletoNegro.png" alt="" width="100" height="100" class="d-inline-block align-text-center logo-image"/>
                </a>
              
                <div class="d-flex">
                  <a href="search.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Buscar</button></a>
                  <a href="insert.php"> <button class="bbtn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Agregar</button></a>
                  <a href="logout.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Salir</button></a>
                </div>
            </div>
        </nav>

        <div class="tittle">
          <h1>Profesores</h1>
        </div>

        <div class="table-responsive table-hover table" id="Tabla-profesores">
            <br>
              <table class="table-striped">
                  <thead class="text-muted table-bordered">
                        <th class="text-center"> <a href="?idcolumn=id&name=<?php echo $name?>&pagina= <?php echo $_GET['pagina'] ?>">ID</a></th>
                        <th class="text-center"> <a href="?idcolumn=name&name=<?php echo $name?>&pagina=<?php echo $_GET['pagina'] ?>"> Nombre</a></th>
                        <!-- <th class="text-center">ID</th>  -->
                        <!-- <th class="text-center">Nombre </th> -->
                        <th class="text-center">Edad</th>
                        <th class="text-center">Nacionalidad</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Editar</th>
                        <th class="text-center">Eliminar</th>
                        
                  </thead>
                  <tbody>
                    <?php
                    if(!$_GET['pagina']){
                      header('location: admin.php?pagina=1');
                    }

                    $contador_paginacion=  ($_GET['pagina']-1)*$articulos_por_pagina;
                 
                    $start_from = ($_GET['pagina']-1)*$articulos_por_pagina;

                    $query = "SELECT * FROM teachers ORDER BY $idcolumn $name LIMIT $start_from, $articulos_por_pagina";
                    $result = mysqli_query($conn, $query);

                 foreach($result as $row):
                  ?>
                      <tr>
                        <td class="text-center"> <?php echo $row['id'];?></td>
                        <td class="text-center"> <?php echo $row['name'];?></td>
                        <td class="text-center"> <?php echo $row['age'];?></td>
                        <td class="text-center"> <?php echo $row['nationality'];?></td>
                        <td class="text-center "> <img  width="100px" src="data:image/jpg;base64 ,<?php echo base64_encode($row['photo']);?> " /></td>
                        <!-- pasamos los datos de esa fila a travez del campo id -->
                        <td class="text-center"> <a href="edit.php?id=<?php echo $row['id'] ?>">Editar</a></td>
                        <td class="text-center"> <a href="delete.php?id=<?php echo $row['id']?> ">Eliminar</a></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
             
              </table>
        </div>

        <br><br><br>

    <nav aria-label="Page navigation example " class="paginas">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php echo $_GET['pagina']<$paginas? 'disabled': '' ?>"><a class="page-link" href=" <?php echo 'admin.php?pagina='.$_GET['pagina']-1 ?> ">Anterior</a></li>
          <?php for ($i=0; $i < $paginas; $i++):  ?>
        <li class="page-item <?php echo $_GET['pagina']==$i+1  ? 'active' : ''  ?>"> 
        <a class="page-link" href="admin.php?pagina=<?php echo $i+1?>"><?php echo $i+1?></a></li>
          <?php endfor ?>
        <li class="page-item <?php echo $_GET['pagina']>$paginas? 'disabled': '' ?>"><a class="page-link" href="<?php echo 'admin.php?pagina='.$_GET['pagina']+1 ?>">Siguiente</a></li>
      </ul>
    </nav>


  </body>
</html>