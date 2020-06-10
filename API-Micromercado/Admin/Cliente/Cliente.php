<?php
ob_start();

include("../../coneccion.php"); 
$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    
    if (isset($_GET['id']))
    {
      $sql = $dbConn->prepare("");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll()  );
     // echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
     
     
    }
    else {
        $sql = $dbConn->prepare("SELECT * FROM `cliente`");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll()  );
  }



}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    /*
    try{
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        //echo($input);
        
        $sql = "SELECT *  FROM usuarios
        WHERE  Usuario=:usuario  AND	Contrasena=:contrasena";
        $statement = $dbConn->prepare($sql);
       
        $statement->bindValue(':usuario', $input['usuario'] );
        $statement->bindValue(':contrasena', $input['contrasena'] );
        $statement->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC) );
        
        $sql = $dbConn->prepare("SELECT * FROM `usuarioweb` WHERE `Cedula`=:cedula and `Contrasena`=:contrasena");
        $sql->bindValue(':cedula', $input['cedula'] );
        $sql->bindValue(':contrasena', $input['contrasena'] );
        $sql->execute();
          $sql->setFetchMode(PDO::FETCH_ASSOC);
          header("HTTP/1.1 200 OK");
          echo json_encode( $sql->fetchAll()  );
       // echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      
   
    } catch (Exception $e) {
        //echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        $input['error'] =$e->getMessage() ;
        echo json_encode($input);
    }
    */
    
}




header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods','*');
header('Access-Control-Allow-Headers: *');
ob_end_flush();