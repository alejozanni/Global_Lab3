<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: login.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: login.php');
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="image/png" sizes="32x32" href="../../resources/images/1.png">
        <link rel="stylesheet" href="../../resources/css/docIndex.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <script src="https://kit.fontawesome.com/36defbaad1.js" crossorigin="anonymous"></script>
        <title>Defi At Home</title>
    </head>
    <body>

      <div class="container-fluid">
        <div class="row flex-nowrap">
          <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-white">
            <div class="d-flex flex-column px-3 pt-2 text-white min-vh-100">
              <a href="/" class="d-flex align-items-center justify-content-center pb-3 mb-md-0 me-m  text-decoration-none">
                <img class="img-fluid logo" src="../../resources/images/3.png" alt="">
              </a>
              <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                <li class="nav-item">
                  <a href="admin.php" class="nav-link align-middle px-0">
                    <i class="fa-solid fa-house-user me-2"></i>Panel principal
                  </a>
      
                  <a href="../Admin/addTeacher.php" class="nav-link align-middle px-0">
                    <i class= "fa-solid fa-address-book me-2"></i>Añadir profesor
                  </a>
      
                  <a href="listTeachers.php" class="nav-link align-middle px-0">
                    <i class="fa-solid fa-calendar-days me-2"></i>Lista de profesores
                  </a>
                  
                  <a href="doctorSearch.php" class="nav-link align-middle px-0">
                    <i class="fa-solid fa-calendar-days me-2"></i>Buscador
                  </a>
      
                  <a href="configuration.html" class="nav-link align-middle disabled px-0">
                    <i class="fa-solid fa-gear me-2"></i>Configuracion
                  </a>
                </li>
                
                <li class="mt-4 mb-1">
                  <a href="index.html">
                    <button type="button" class="btn btn-primary btn-sm ps-3 pe-3 me-sm-2 buttonsNav">
                      <a href="logout.php" class="logoutButton" style="text-decoration: none;"> 
                        Cerrar sesion
                      </a>
                    </button>     
                  </a>
                </li>
              </ul>
              
              <div class="align-items-center pb-4">
                <div class="d-flex align-items-center justify-content-center flex-column bd-highlight bottom-0 start-0" style="margin-top: 100%;">
                  <div class="p-2 bd-highlight align-items-center" style="padding:0 !important;">
                    <div class="card align-items-center pt-4 pb-3" style="border: none; background-color: #c8d2e6;width: 13rem !important; border-radius: 30px;">
                    <img src="../../resources/images/sideBarImage.png" class="card-img-top img-fluid" style="max-width: 7rem;" alt="...">
                    <div class="card-body text-center text-black">
                      <h5 class="card-title">Defi</h5>
                      <p class="card-text">medicalihistory@info.com</p>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col py-3" style="background-color:#c8d2e6">
            <header class="navbar justify-content-start sticky-top flex-md-nowrap p-0">
              <div>
                <h3 class="navbarText">Panel de Admin</h3>
              </div>
          
              <div class="topnav">
                <input type="text" class="searchBar" placeholder="Buscar">
          
                <i class="fa-solid fa-magnifying-glass"></i>
              </div>
              
              <div class="dropdown d-flex flex-row-reverse">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="resources/images/profile.jpg" alt="" width="32" height="32" class="rounded-circle me-2 ms-2 border border-white border-3">
                <strong>Admin</strong>
                </a>
                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton1"> 
                <li><a class="dropdown-item" href="#">Editar perfil</a></li>
                </ul>
          
                <a class="d-flex align-items-center text-decoration-none notificationsIcon">
                <i class="fa-solid fa-bell me-2 ms-2"></i>
                <i class="fa-solid fa-user me-2 ms-2"></i>
                </a>
              </div>
            </header>				
        
          </div>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>