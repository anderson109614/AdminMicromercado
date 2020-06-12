<?php
ob_start();

include("../../coneccion.php"); 
$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    
    if (isset($_GET['Id']))
    {
      $sql = $dbConn->prepare("SELECT
      ca.Id as IdCategoria,
      ca.Nombre as Categoria,
      pr.Id as idProducto,
      pr.Nombre as Producto,
      CONCAT('".$urlAPi."',pr.Foto) as Foto
      
      
  FROM
      producto pr,
      categoriaprod ca
  WHERE
      pr.Id_Categoria=ca.Id
      AND pr.Estado=1
      and pr.Id=:id");
      $sql->bindValue(':id', $_GET['Id']);
      $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll());
     // echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
     
     
    }
    else {
        $sql = $dbConn->prepare("SELECT
        ca.Id as IdCategoria,
        ca.Nombre as Categoria,
        pr.Id as idProducto,
        pr.Nombre as Producto,
        CONCAT('".$urlAPi."',pr.Foto) as Foto
        
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
  }



}
function GuardarImg($img,$nom)
{
    //$archivo =  "/var/www/html/webapp/sgp.ini";
    //$contenido = parse_ini_file($archivo, true);
    //$dbuPath = $contenido["DBU_PATH"];

    $base_to_php = explode(',', $img);
    $data = base64_decode($base_to_php[1]);
    //codigoCliente_codPaquete_campania-anio -mes-dia-hora-minuto.tipo  date("d") . " del " . date("m")
    $nomImg=date("Y")."-".date("m")."-".date("d")."-".date("G")."-".date("i").".png";
    //$filepath = "/home/www/micromercadoand.atwebpages.com/img/".$nomImg; // or image.jpg
    $filepath = "../../../img/".$nomImg; // or image.jpg
    file_put_contents($filepath, $data);
    return $nomImg;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    try{
        //$input = $_POST;
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $sql = "INSERT INTO `producto`(
            `Nombre`,
            `Foto`,
            `Id_Categoria`,
            `Estado`
        )
        VALUES(
            :Nombre,
            :Foto,
            :Id_Categoria,
            '1'
        )";

        $statement = $dbConn->prepare($sql);
        //bindAllValues($statement, $input,-1);
        $statement->bindValue(':Nombre', $input['Nombre'] );
        $nomI3='no-imagen.jpg';
        if(strlen($input['Foto'])>0){
            $nomI3=GuardarImg($input['Foto'],$input['Nombre']);
        } 
        $statement->bindValue(':Foto', $nomI3);
        $statement->bindValue(':Id_Categoria', $input['Id_Categoria'] );

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
    try{
    //$input = $_GET;
    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
    
    $sql = "UPDATE
    `producto`
SET
  
    `Nombre` =:Nombre ,
    `Foto` =:Foto,
    `Id_Categoria` = :Id_Categoria 
WHERE
    `Id`=:id";

    $statement = $dbConn->prepare($sql);
    //$sql->bindValue(':id', $postId);
    //bindAllValues2($statement, $input,1,18);

    $statement->bindValue(':Nombre', $input['Nombre'] );
    $nomI3='no-imagen.jpg';
        if(strlen($input['Foto'])>0){
		if($input['Foto'] != 'http://micromercadoand.atwebpages.com/img/no-imagen.jpg'){
           		 $nomI3=GuardarImg($input['Foto'],$input['Nombre']);
		}
        } 
        $statement->bindValue(':Foto', $nomI3);
    $statement->bindValue(':Id_Categoria', $input['Id_Categoria'] ); 
    $statement->bindValue(':id',   $input['Id']);

    $statement->execute();
    
    header("HTTP/1.1 200 OK");
    echo json_encode($input);

    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    try{
        
        //$input = (array) json_decode(file_get_contents('php://input'), TRUE);
        // $postId = $input['id'];
         $id = $_GET['Id'];
        $statement = $dbConn->prepare("UPDATE
        `producto`
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