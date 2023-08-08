<?php 

class _project{

    private $db;
    //constructor to initialize private to the database connection
    function __construct($conn)
    {
        $this->db=$conn;
    }
       
    //function to insert a new record into the attendee database
    public function AddProject($projectAdminID,$projectDetaills,$projectMembersID,$projectStartDate,$projectEndDate){
     
        try {
    // define sql statement to be executed
    $sql="INSERT INTO project (projectAdminID,projectDetaills,projectMembersID,projectStartDate,projectEndDate) VALUES(:projectAdminID,:projectDetaills,:projectMembersID,:projectStartDate,:projectEndDate)";
    //prepare the sql statement to be executuin
    $stmt=$this->db->prepare($sql);
//bin all placeholders to the actual values
    $stmt->bindparam(':projectAdminID',$projectAdminID);
    $stmt->bindparam(':projectMembersID',$projectMembersID);
    $stmt->bindparam(':projectStartDate',$projectStartDate);
    $stmt->bindparam(':projectEndDate',$projectEndDate);
    $stmt->bindparam(':projectDetaills',$projectDetaills);
  

//execute statment
    $stmt->execute();
    return true;
} catch (PDOException $e) {
echo $e->getMessage();
return false;
}
    }

 public function getProject(){
    try{
        $sql="SELECT * FROM `project` ";
        $results=$this->db->query($sql);
        return $results;
    }catch (PDOException $e) {
    echo $e->getMessage();
    return false;
}

 }


 public function getProjectDetails($id){
    try{
        $sql="SELECT * FROM `project` where projectID = :id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindparam(':id',$id);
        $stmt->execute();
        $result=$stmt->fetch();
        return $result;
    }catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}

 public function getAllProject(){
    $sql="SELECT * FROM `project`";
    $stmt=$this->db->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetch();
    return $result;
}


  public function deleteProject($id){
        try {
                $sql = "DELETE from project where projectID = :id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindparam(':id',$id);
        $stmt->execute();
        return true;
        } catch (PDOExeption $e) {
             echo $e->getMessage();
    return false;
        }
    }
    
    public function updateProject($id,$projectDetaills,$projectMembersID,$projectStartDate,$projectEndDate){
        try {
                $sql = "UPDATE `project` SET `projectDetaills`=:projectDetaills,`projectMembersID`=
       :projectMembersID,`projectStartDate`=:projectStartDate,`projectEndDate`=:projectEndDate WHERE projectID = :id" ;
         $stmt = $this->db->prepare($sql);
  $stmt ->bindparam(':id',$id);
  $stmt ->bindparam(':projectDetaills',$projectDetaills);
  $stmt ->bindparam(':projectMembersID',$projectMembersID);
  $stmt ->bindparam(':projectStartDate',$projectStartDate);
  $stmt ->bindparam(':projectEndDate',$projectEndDate);
  $stmt->execute();
  return true;
        } catch (PDOExeption $e) {
           //throw $th;
    echo $e->getMessage();
    return false;
        }
  
    }
}
?>