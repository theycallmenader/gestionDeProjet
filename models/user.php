<?php 
class _user{
    private $db;
    //constructor to initialize private to the database connection
    function __construct($conn)
    {
        $this->db=$conn;
    }
    public function AddUser($firstname,$lastname,$email,$password,$dob,$role){
        try {
            $result=$this->getUserByEmail($email);
            if($result['num']>0){
                return false;
            }
            else{
                $new_password=md5($password.$email);

    $sql='INSERT INTO users (firstname,lastname,email,password,dob,role) VALUES(:fName,:lName,:email,:password,:dob,:role)';
  
    $stmt=$this->db->prepare($sql);

    $stmt->bindparam(':fName',$firstname);
    $stmt->bindparam(':lName',$lastname);
    $stmt->bindparam(':email',$email);
    $stmt->bindparam(':password',$new_password);
    $stmt->bindparam(':dob',$dob);
    $stmt->bindparam(':role',$role);
//execute statment
    $stmt->execute();
    return true;
            }
        
        } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
        }
    }

    //login
    public function getUser($email,$password){
        try{
            $sql="SELECT * FROM users where email=:email and password=:password";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':email',$email);
            $stmt->bindparam(':password',$password);
            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getUserByEmail($email){
        try{
            $sql="SELECT count(*) as num FROM users where email= :email";
            $stmt=$this->db->prepare($sql);
            $stmt->bindparam(':email',$email);

            $stmt->execute();
            $result=$stmt->fetch();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

     public function getUsers(){
        try {
              $sql = "SELECT * FROM `users` ";
        $result = $this->db->query($sql);
        return $result;
        }
      catch (PDOExeption $e) {
    //throw $th;
    echo $e->getMessage();
    return false;
}
}
       public function getUserDetails($id){
        $sql="SELECT * FROM `users` where id = :id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindparam(':id',$id);
        $stmt->execute();
        $result=$stmt->fetch();
        return $result;
 }
  public function deleteUser($id){
        try {
        $sql = "DELETE from users where id = :id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindparam(':id',$id);
        $stmt->execute();
        return true;
        } catch (PDOExeption $e) {
             echo $e->getMessage();
    return false;
        }
    }

       public function updateUser($id,$firstname,$lastname,$email,$password,$dob,$role){
        try {
                $sql = "UPDATE `users` SET `firstname`=:firstname,`lastname`=
       :lastname,`email`=:email,`password`=:password,`dob`=:dob ,`role`=:role   WHERE id = :id" ;
         $stmt = $this->db->prepare($sql);
  $stmt ->bindparam(':id',$id);
  $stmt ->bindparam(':firstname',$firstname);
  $stmt ->bindparam(':lastname',$lastname);
  $stmt ->bindparam(':email',$email);
  $stmt ->bindparam(':password',$password);
  $stmt ->bindparam(':dob',$dob);
  $stmt ->bindparam(':role',$role);
  $stmt->execute();
  return true;
        } catch (PDOExeption $e) {
           //throw $th;
    echo $e->getMessage();
    return false;
        }
    }
        public function getUserByUser_id($id){
        try{
            $sql="SELECT * FROM users where id= :id";
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


}
?>