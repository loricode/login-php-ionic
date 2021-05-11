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
   try{
    $password = $data['password'];
    $conexion = new Conexion();
    $db = $conexion->getConexion();
    $query = "SELECT * FROM user WHERE clave=:clave";
    $statement = $db->prepare($query);
    $statement->bindParam(":clave", $password);
    $statement->execute();
    $resultData = $statement->fetch();
    if($resultData == null){
      return ["status" => "400", "data"=>  $resultData, "login" => false ];  
    }else{
       //puede hacer un token en esta parte
       return ["status" => "200", 
              "data"=> ["name"=>$resultData["name"],"id" => $resultData["id"]],
              "login" => true
         ];
      } 
    } catch (PDOException $e) {
        echo "¡Error!: " . $e->getMessage() . "<br/>";
    }
 }

}//fin de la clase
?>