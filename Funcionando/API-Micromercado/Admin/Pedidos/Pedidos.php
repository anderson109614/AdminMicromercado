<?php
ob_start();

include("../../coneccion.php"); 
$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    
    if (isset($_GET['Id']))
    {
      $sql = $dbConn->prepare("SELECT
      pd.Id,
      dp.Nombre,
      pr.Nombre as Producto,
      dp.Precio,
      pd.Cantidad,
      dp.Precio * pd.Cantidad as Subtotal
  FROM
      pedido_det pd,
      detalleprod dp,
      producto pr
  WHERE
      pd.Id_Det_Prod=dp.Id
      and dp.Id_Producto=pr.Id
      and pd.Id_Pedido=:id");
      $sql->bindValue(':id', $_GET['Id']);
      $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
     // echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
     
     
    }
    else {
        $sql = $dbConn->prepare("SELECT
        p.Id,
        c.Cedula,
        c.Nombre,
        c.Apellido,
        c.Direccion,
        c.Celular,
        p.Fecha,
        p.Total,
        e.Nombre as Estado,
        e.Color
    FROM
        pedido p,
        cliente c,
        estado e
    WHERE
        p.Id_Cliente=c.Id and
        p.Id_Estado=e.Id");
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

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    try{
    //$input = $_GET;
    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
    
    $sql = "UPDATE
    pedido
SET
    Id_Estado =:idEstado
WHERE
    Id=:id";

    $statement = $dbConn->prepare($sql);
    //$sql->bindValue(':id', $postId);
    //bindAllValues2($statement, $input,1,18);

    $statement->bindValue(':idEstado',   $input['idEstado']);     
    $statement->bindValue(':id',   $input['id']);

    $statement->execute();
    
    header("HTTP/1.1 200 OK");
    echo json_encode($input);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}


header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
ob_end_flush();