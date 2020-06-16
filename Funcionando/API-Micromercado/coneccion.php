<?php

$db = [
    'host' => 'btmb3qlrmuy0ckijcl3g-mysql.services.clever-cloud.com',
    'username' => 'umjuyueocaxayceh',
    'password' => 'vy2F5qFFA0clu5QN0zlj',
    'db' => 'btmb3qlrmuy0ckijcl3g' 
];

$urlAPi='http://app-ee239fef-4504-41bf-9543-34aa7055f385.cleverapps.io/img/';
  //Abrir conexion a la base de datos
  function connect($db)
  {
      try {
          $conn = new PDO("mysql:host={$db['host']};dbname={$db['db']};charset=UTF8", $db['username'], $db['password']);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $conn;
      } catch (PDOException $exception) {
          exit($exception->getMessage());
      }
  }
 //Obtener parametros para updates
 function getParams($input)
 {
    $filterParams = [];
    foreach($input as $param => $value)
    {
            $filterParams[] = "$param=:$param";
    }
    return implode(", ", $filterParams);
  }
  //Asociar todos los parametros a un sql
  function bindAllValues($statement, $params,$total)
  {
    $con=0;
    foreach($params as $param => $value)
    {
        if($con!=$total){
            if($value=='null'){
                $statement->bindValue(':'.$param, null);
            }else{
                $statement->bindValue(':'.$param, $value);
            }
        }
        $con=$con+1;
        
    }
    return $statement;
   }
   function bindAllValues2($statement, $params,$total,$total2)
  {
    $con=0;
    foreach($params as $param => $value)
    {
        if($con!=$total && $con != $total2){
            if($value=='null'){
                $statement->bindValue(':'.$param, null);
            }else{
                $statement->bindValue(':'.$param, $value);
            }
        }
        $con=$con+1;
        
    }
    return $statement;
   }
?>