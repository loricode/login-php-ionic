<?php

class AuthController{

 public function autenticate($data){
   try{
      $email = $data['email'];
      $conexion = new Conexion();
      $db = $conexion->getConexion();
      $query = "SELECT name, email FROM user WHERE  email=:email";
      $statement = $db->prepare($query);
      $statement->bindParam(":email", $email);
      $statement->execute();
      return ["data" => $statement->fetch()];
       
   } catch (PDOException $e) {
    echo "¡Error!: " . $e->getMessage() . "<br/>";
   }
 }


 public function iniciarSesion($data){

  if(isset($data['email']) && isset($data['password']) ){
    $password = $data['password'];
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $query = "SELECT * FROM user WHERE email=:email AND password=':password'";
    $statement = $db->prepare($query);
    $statement->bindParam(":email", $email);
    $statement->bindParam(":password", $password);
    $result = $statement->execute();
    $db = null;
    if($result){
       return ["status" => "200", "email" => $email, "ok"=>$result];
    }else{
       return ["status" => "404", "email" => "error"];   
    }
  }
}

}//fin de la clase
?>