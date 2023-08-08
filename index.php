<?php 
require_once 'vendor/autoload.php';
include_once 'session.php';
require_once 'controller/userController.php' ;
require_once 'controller/projectController.php' ;





$loader = new \Twig\Loader\FilesystemLoader('views');

$twig = new \Twig\Environment($loader);


 
  if (isset($_GET['action'])) {
     $action = $_GET['action'];
     switch ($action) {
//*----------------------------USERS---------------------------------*//
         case 'login':
            Login($twig);
             break;
         case 'LoginPost':
            LoginPost($_user,$twig);
             break;
         case 'viewUsers':
            GetUsers($_user,$twig);
            break;
        case 'LogOut':
            Logout($twig);
            break;


//*----------------------------Projects---------------------------------*//
        case 'viewProjects':
            GetProjects($_project,$twig);
            break;
        case 'editProject':
            EditProject($_project,$twig);
            break;
        case 'deleteProject':
            delete_project($_project,$twig);
            break;
        case 'viewProjectsDetaill':
            GetProjectsDetaills($_project,$twig);
            break;
        case 'AddProjetPost':
            addProject( $_project,$twig );
            break;
        case 'EditProjectPost':
            update_project( $_project,$twig );
            break;
     }}else{
        GetUsers($_user,$twig);
        echo $_SESSION['id'];
        
     }
 
 ?>