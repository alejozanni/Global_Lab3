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

if(isset($_POST['login'])){
    $email= $_POST["email"];
    $pass = $_POST["password"];

    $query = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email' and password ='$pass'");
    $arr=mysqli_fetch_row($query);

    $nro = mysqli_num_rows($query);
    if($nro == 1){
        if($arr[3]==1){
            $_SESSION['admin']='login';
            header("location: ../Admin/admin.php");
        }
        
        if($arr[3]==2){
            $_SESSION['teacher']='login';
            header("location: ../Teacher/teacher.php");
        }

        if($arr[3]==3){
            $_SESSION['student']='login';
            header("location: ../Student/student.php");
        }

    }else{
    
    echo "<script>alert('Error nombre o usuario incorrecto');
        window.location =  'http://localhost/Global_lab3/Login/login.php';  
    </script>";
    }   
}

?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
</head>
<body>
   <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
   <a class="home" href="../Home/index.html">
       <img src="../img/logo/logoCompletoBlanco.png" alt="" width="130" height="120">
   </a>
   <h1 class="animate__animated animate__.backInLeft">Ingresa a tu cuenta</h1>

   <p><input type="email" placeholder="Email" name="email"></p>
   <p><input type="password" placeholder="Contraseña" name="password"></p>

   <a href="" id="formulario"> <input type="submit" name="login" value="Ingresar">

   <p><br> ¿No tienes una cuenta? <a href="../Sign up/index.html">Registrarme </a></br></p>
   </form> 
   
   </section>
      <script src="/Login/sessionError.js"></script>
    
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>

</body>
</html>