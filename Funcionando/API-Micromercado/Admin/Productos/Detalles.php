<?php
ob_start();

include("../../coneccion.php"); 
$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    
    if (isset($_GET['Id']))
    {
      $sql = $dbConn->prepare("SELECT * FROM `detalleprod` WHERE `Id_Producto`=:id and Estado='1'");
      $sql->bindValue(':id', $_GET['Id']);
      $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
     // echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
     
     
    }
    
    else {
        /*
        $sql = $dbConn->prepare("SELECT
        ca.Id as IdCategoria,
        ca.Nombre as Categoria,
        pr.Id as idProducto,
        pr.Nombre as Producto,
        pr.Foto
        
    FROM
        producto pr,
        categoriaprod ca
    WHERE
        pr.Id_Categoria=ca.Id
        AND pr.Estado=1");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll()  );
        */
  }



}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    try{
        //$input = $_POST;
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $sql = "INSERT INTO `detalleprod`(
            `Nombre`,
            `Precio`,
            `Estado`,
            `Id_Producto`
        )
        VALUES(
            :Nombre,
            :Precio,
            '1',
            :Id_Producto
        )";
        $statement = $dbConn->prepare($sql);
        //bindAllValues($statement, $input,-1);
        $statement->bindValue(':Nombre', $input['Nombre'] );
        $statement->bindValue(':Precio', $input['Precio'] );
        $statement->bindValue(':Id_Producto', $input['Id_Producto'] );

        $statement->execute();
        $postId = $dbConn->lastInsertId();
    
        if($postId)
        {
        $input['Id'] = $postId;
        header("HTTP/1.1 200 OK");
        echo json_encode($input);
      
        }
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}
//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    /*
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
    */
}
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    try{
        
        //$input = (array) json_decode(file_get_contents('php://input'), TRUE);
        // $postId = $input['id'];
         $id = $_GET['Id'];
        $statement = $dbConn->prepare("UPDATE
        `detalleprod`
    SET
        `Estado`='0'
    WHERE
        `Id`=:id"); 
        $statement->bindValue(':id', $id);
        $statement->execute();
        $object3 = (object) [
            'id' => $id,
            'msj' => 'OK'
                        
          ];
        header("HTTP/1.1 200 OK");
        echo json_encode($object3);
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
ob_end_flush();