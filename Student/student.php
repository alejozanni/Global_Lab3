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

$consulta= "SELECT * FROM courses";
$save = $conn->query($consulta);


$nrows= mysqli_num_rows($save);
$pagArticles=2;

$pages= ceil( $nrows/$pagArticles);

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
                <a class="navbar-brand" href="../Home/index.html">
                    <img src="../img/logo/logoCompletoNegro.png" alt="" width="100" height="100" class="d-inline-block align-text-center logo-image"/>
                </a>
              
                <div class="d-flex">
                  <a href="logout.php"> <button class="btn btn-primary btn-sm ps-3 pe-3 me-sm-3" type="submit">Salir</button></a>
                </div>
            </div>
        </nav>

        <h1>Cursos</h1>

          <div class="table-responsive table-hover table" id="Tabla-cursos">
            <br>
              <table class="table-striped">
                  <thead class="text-muted table-bordered">
                        <!-- <th class="text-center"> <a href="?idcolumn=id&course=<?php echo $name?>&pagina= <?php echo $_GET['pagina'] ?>"> ID</a></th> -->
                        <!-- <th class="text-center"> <a href="?idcolumn=course&course=<?php echo $name?>&pagina=<?php echo $_GET['pagina'] ?>"> Nombre</a></th> -->
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Descripcion</th>
                        <th class="text-center">Video</th>                   
                  </thead>
                  <tbody>

                    <?php
                    if(!$_GET['pagina']){
                      header('location: student.php?pagina=1');
                    }

                    $contador_paginacion=  ($_GET['pagina']-1)*$pagArticles;
                 
                    $start_from = ($_GET['pagina']-1)*$pagArticles;

                    $query = "SELECT * FROM courses ORDER BY $idcolumn $name LIMIT $start_from, $pagArticles";
                  $result = mysqli_query($conn, $query);

                 foreach($result as $row):
                     ?>
                      <tr>
                       <!-- <td class="text-center"> <?php echo $row['id'];?></td> -->
                        <td class="text-center"> <?php echo $row['name'];?></td>
                        <td class="text-center"> <?php echo $row['description'];?></td>
                        <td class="text-center"> <a href="video.php?id=<?php echo $row['id']  ?>">Ver</td>
                      
                      </tr>
                    <?php endforeach ?>
                  </tbody>
              </table>

              <br><br><br>

              <nav aria-label="Page navigation example " class="paginas">
                <ul class="pagination justify-content-center">
                 <li class="page-item <?php echo $_GET['pagina']<$pages? 'disabled': '' ?>"><a class="page-link" href=" <?php echo 'student.php?pagina='.$_GET['pagina']-1 ?> ">Anterior</a></li>
                   <?php for ($i=0; $i < $pages; $i++):  ?>
                 <li class="page-item <?php echo $_GET['pagina']==$i+1  ? 'active' : ''  ?>"> 
                   <a class="page-link" href="student.php?pagina=<?php echo $i+1?>"><?php echo $i+1?></a></li>
                    <?php endfor ?>
                  <li class="page-item <?php echo $_GET['pagina']>=$pages? 'disabled': '' ?>"><a class="page-link" href="<?php echo 'student.php?pagina='.$_GET['pagina']+1 ?>">Siguiente</a></li>
                </ul>
              </nav>
          </div>
  </body>
</html>