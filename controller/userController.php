<?php
require_once 'db/config.php';
require_once 'session.php';

require_once 'models/user.php';
require_once 'vendor/autoload.php';


function addUser($_user){
        if(isset($_POST['submit'])){
            $fName=$_POST['firstname'];
            $lName=$_POST['lastname'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $dob=$_POST['dob'];
            $role=$_POST['role'];
            
        $result=$_user->AddUser($fName,$lName,$email,$password,$dob,$role);
           
        
            if($result){
                echo 'succ';        
            }
            else{
               echo 'error';
                            } 
        }
    }

// ----------------------------- Login -----------------------------------

function Login($twig)  {
  
    
    echo $twig->render('login.html',array(
    
    ));
}

function LoginPost($_user, $twig) {
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];
    $new_password = md5($password . $email);
    $result = $_user->getUser($email, $new_password);

    if (!$result) {
        echo $twig->render('login.html', array(
            'msg' => "Email or Password are incorrect",
            'p'=>1
        ));
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $result['id'];
        $id = $_SESSION['id'];
        $result = $_user->getUserDetails($id);

        echo $twig->render('profile.html',array(
            'r'=>$result
        
        ));
    }
}

// ----------------------------- END Login -----------------------------------


// ----------------------------- Users -----------------------------------
function GetUsers($_user,$twig)  {
    $result=$_user->getUsers();
      echo $twig->render('viewUsers.html',array(
      'result'=>$result
      ));
  }
// ----------------------------- END Users -----------------------------------

    function delete_user($user){
        if(!$_GET['id']){
        // echo 'error';
        // include 'includes/error.php';
        header("location: users.php");
    }else{
    //get id values    
        $id=$_GET['id'];
    // Call Crud Function
        $result=$user->deleteUser($id);
        //Redirct TO index.php
    if($result){
        header("location:users.php");
    }
        else
        {
          echo "error on delete";
    }
    }
    }
    
    function update_user($user){
         if(isset($_POST['submitUserUpdate'])){
            $id=$_POST['id'];
            $firstname=$_POST['firstname'];
            $lastname=$_POST['lastname'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $dob=$_POST['dob'];
            $role=$_POST['role'];
        $result=$user->updateUser($id,$firstname,$lastname,$email,$password,$dob,$role);
           
        
            if($result){
                 header("Location: users.php");
        
            }
            else{
               echo 'error';
                            } 
        }
        if(!isset($_GET['id'])){
        header('location :users.php');
    }
    else {
        $id = $_GET['id'];
        $user = $user->getUserDetails($id);
    }
    }
    function get_user_details($user){
        if(!isset($_GET['id'])){
    echo "error on get user";
    }else{
    
        $id = $_GET['id'];
        $result = $user->getUserDetails($id);}
    
    }
    
    function Logout($twig)  {
        session_destroy();

        echo $twig->render('Login.html',array(
        
        ));
    }

?>

