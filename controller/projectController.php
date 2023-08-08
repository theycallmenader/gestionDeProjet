<?php 
require_once 'db/config.php' ;
// require_once 'views/includes/session.php';
require_once 'controller/userController.php' ;
require_once 'models/user.php';

function addProject($project){

    if(isset($_POST['submitProject'])){
         $projectAdminID=$_POST['projectAdminID'];
         $projectDetaills=$_POST['projectDetaills'];
          $projectMembersID=$_POST['projectMembersID'];
        $projectStartDate=$_POST['projectStartDate'];
        $projectEndDate=$_POST['projectEndDate'];
       
    $result=$project->AddProject($projectAdminID,$projectDetaills,$projectMembersID,$projectStartDate,$projectEndDate);
        if($result){
            echo '';
        }
        else{
           echo 'error';
        } 
    }
}
function EditProject($project,$twig)  {
    $id=$_GET['id'];
    $result=$project->getProjectDetails($id);

    echo $twig->render('editProject.html',array(
        'r'=>$result
    
    ));
}
function update_project($project,$twig){
    if(isset($_POST['submitProjectUpdate'])){
  $id =$_POST['id'];
  $projectStartDate =$_POST['projectStartDate'];
  $projectEndDate =$_POST['projectEndDate'];
    $projectDetaills =$_POST['projectDetaills'] ;
  $projectMembersID =$_POST['projectMembersID'] ;




  $result = $project->updateProject($id,$projectDetaills,$projectStartDate,$projectEndDate,$projectMembersID,$answer);
  //redirected to index
  if($result) {
    header("Location: adminPage.php");
  }
  else {
   echo "error on update";
  }
}

}
function delete_project($project,$twig){
    if(!$_GET['id']){
    header("location: adminPage.php");
}else{
//get id values    
    $id=$_GET['id'];
// Call Crud Function
    $result=$project->deleteProject($id);
    //Redirct TO index.php
if($result){
    header("location:adminPage.php");
}
    else
    {
      echo "error on delete";
}
}
}



function GetProjects($project,$twig)  {
    $result=$project->getProject();
    $id=$_SESSION['id'];
      echo $twig->render('viewProjects.html',array(
      'result'=>$result,

      ));
  }

  
function GetProjectsDetaills($project,$twig)  {
    $id=$_GET['id'];
    $result=$project->getProjectDetails($id);
    echo $twig->render('viewProjectDetail.html',array(
        'r'=>$result
    
    ));
}
?>
      
