<?php
    $host='127.0.0.1';
    $db='gestiondeprojet';
    $user='root';
    $pass='';
    $charset='utf8mb4';
    $dsn="mysql:host=$host;dbname=$db;charset=$charset";
    try {
        $pdo=new PDO($dsn,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }

   
    require_once  'models/user.php';
    require_once 'models/project.php';
    require_once  'controller/userController.php';
    require_once  'controller/projectController.php';

    $_user=new _user($pdo);
    $_project=new _project($pdo);

    $_user->AddUser("admin","admin","admin@gmail.com","admin","","","");

?>