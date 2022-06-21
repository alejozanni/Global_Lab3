<?php
session_start();

if(!isset($_SESSION['teacher'])){
  
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
  $consulta= "SELECT * FROM courses";
  $guardar = $conn->query($consulta);


$cant_filas= mysqli_num_rows($guardar);
$articulos_por_pagina=6;

$paginas= ceil( $cant_filas/$articulos_por_pagina);

if(isset($_GET['course'])){
  $name = $_GET['course'];
}else{
 $name= 'ASC';
}
if(isset($_GET['idcolumn'])){
  $idcolumn = $_GET['idcolumn'];
}else{
 $idcolumn= 'id';
}

//$ordenamiento= $conn->query("SELECT * FROM productos ORDER BY $idcolumn $nombre");
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
                  
                 <a href="search.php"> <button class="btn btn-lg btn-outline-success" type="submit">Buscar</button></a>
                 <a href="logout.php"> <button class="btn btn-lg btn-outline-success" type="submit">Salir</button></a>
   
            </div>
              </div>
            </div>
          </nav>
   

          <div class="titulo">
              <h1>Cursos</h1>
          </div>

          <div class="table-responsive table-hover table-dark" id="Tabla-cursos">
            <br>
            <?php 
              if($name=='DESC'){
                   $name = 'ASC' ;
              } else if($name = 'ASC'){
                $name='DESC';
              }
              ?>
              <table class="table ">
                  <thead class="text-muted table-dark">
                        <th class="text-center"> <a href="?idcolumn=id&Producto=<?php echo $name?>&pagina= <?php echo $_GET['pagina'] ?>"> ID</a></th>
                        <th class="text-center"><a href="?idcolumn=Producto&Producto=<?php echo $name?>&pagina=<?php echo $_GET['pagina'] ?>"> Nombre</a></th>
                        <th class="text-center">Descripcion</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Video</th>                   
                  </thead>
                  <tbody>

                    <?php
                    if(!$_GET['pagina']){
                      header('location: teacher.php?pagina=1');
                    }

                    $contador_paginacion=  ($_GET['pagina']-1)*$articulos_por_pagina;
                 
                    $start_from = ($_GET['pagina']-1)*$articulos_por_pagina;

                    $query = "SELECT * FROM courses ORDER BY $idcolumn $name LIMIT $start_from, $articulos_por_pagina";
                  $result = mysqli_query($conn, $query);

                 foreach($result as $row):
                
                     ?>
                      <tr>
                        <td class="text-center"> <?php echo $row['id'];?></td>
                        <td class="text-center"> <?php echo $row['name'];?></td>
                        <td class="text-center"> <?php echo $row['description'];?></td>
                        <td class="text-center "> <img  width="100px" src="data:image/jpg;base64 ,<?php echo base64_encode($row['Foto']);?> " /></td>
                        <td class="text-center"> <a href="video.php?id=<?php echo $row['id']  ?>">-Ver-</td>
                        <!-- pasamos los datos de esa fila a travez del campo id -->
                      
                      </tr>
                    <?php endforeach ?>
                  </tbody>
              </table>

              
              <nav aria-label="Page navigation example " class="paginas">
  <ul class="pagination">
    <li class="page-item <?php echo $_GET['pagina']<$paginas? 'disabled': '' ?>"><a class="page-link" href=" <?php echo 'index.php?pagina='.$_GET['pagina']-1 ?> ">Anterior</a></li>
   <?php for ($i=0; $i < $paginas; $i++):  ?>
    <li class="page-item <?php echo $_GET['pagina']==$i+1  ? 'active' : ''  ?>"> <!--esta linea de codigo php muestra en que pagina estamos -->
      <a class="page-link" href="index.php?pagina=<?php echo $i+1?>"><?php echo $i+1?></a></li>
    <?php endfor ?>
    <li class="page-item <?php echo $_GET['pagina']>=$paginas? 'disabled': '' ?>"><a class="page-link" href="<?php echo 'index.php?pagina='.$_GET['pagina']+1 ?>">Siguiente</a></li>
  </ul>
</nav>
          </div>

    
  </body>
</html>