<?php
    include_once 'database.php';
    
    session_start();
    
    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
            case 1:
                header('location: ../Admin/admin.php');
            break;

            case 2:
                header('location: ../Teacher/teacher.php');
            break;

            case 3:
                header('location: ../Student/student.php');
                break;

            default:
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Database();
        $query = $db->connect()->prepare('SELECT *FROM users WHERE username = :username AND password = :password');
        $query->execute(['username' => $username, 'password' => $password]);

        $row = $query->fetch(PDO::FETCH_NUM);
        
        if($row == true){
            $rol = $row[3];
            
            $_SESSION['rol'] = $rol;
            switch($rol){
                case 1:
                    header('location: ../Admin/admin.php');
                break;

                case 2:
                    header('location: ../Teacher/teacher.php');
                break;

                case 3:
                    header('location: ../Student/student.php');
                    break;

                default:
            }
        }else{
            // no existe el usuario
            echo "Nombre de usuario o contraseña incorrecto";
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
   <form action="#" method="post">
   <a class="home" href="../Home/index.html">
       <img src="../img/logo/logoCompletoBlanco.png" alt="" width="130" height="120">
   </a>
   <h1 class="animate__animated animate__.backInLeft">Ingresa a tu cuenta</h1>

   <p><input type="text" placeholder="Nombre de usuario" name="username"></p>
   <p><input type="password" placeholder="Contraseña" name="password"></p>

   <input type="submit" value="Ingresar">
   <p><br> ¿No tienes una cuenta? <a href="../Sign up/index.html">Registrarme </a></br></p>
   </form> 

</body>
</html>