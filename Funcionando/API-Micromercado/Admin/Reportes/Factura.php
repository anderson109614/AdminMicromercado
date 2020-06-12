<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT
    *
FROM
    pedido pe,
    cliente cl
WHERE
    pe.Id_Cliente=cl.Id
    and pe.Id=".$_GET['id'];

	$resultado = $mysqli->query($query);
	
    $pdf = new PDF();
    
  

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	//$pdf->Cell(100,6,'Nombre',1,0,'C',1);
	//$pdf->Cell(40,6,'Precio',1,1,'C',1);
	$pdf->SetFont('Arial','',10);
	$total='0';
	while($row = $resultado->fetch_assoc())
	{
       // $pdf->Text(10, 10, 'string txt');
       $pdf->Cell(70,6,'',0,0,'C');
		$pdf->Cell(70,6,'Factura',0,0,'C');
        $pdf->Cell(35,6,$row['Id'],1,1,'C');
        $pdf->Cell(70,6,'',0,0,'C');
        $pdf->Cell(70,6,'Fecha',0,0,'C');
        $pdf->Cell(35,6,$row['Fecha'].'',0,1,'C');

        $pdf->SetFillColor(232,232,232);
        $pdf->Cell(175,6,'Datos del Cliente',1,1,'C');

        $pdf->Cell(70,6,'      Cedula: '.$row['Cedula'],1,0,'L');
        $pdf->Cell(35,6,'Telefono',1,0,'C');
        $pdf->Cell(70,6,$row['Telefono'].'/'.$row['Celular'],1,1,'L');
       // $pdf->Cell(70,6,$row['Cedula'],1,1,'C');
        $pdf->Cell(70,6,'      Nombre:'.$row['Nombre'].' '.$row['Apellido'],1,0,'L');
       // $pdf->Cell(70,6,$row['Nombre'].' '.$row['Apellido'],0,1,'C');
        
        
        $pdf->Cell(35,6,'Direccion',1,0,'C');
        $pdf->Cell(70,6,$row['Direccion'],1,1,'L');
        $pdf->Cell(175,6,'E-mail: '.$row['Email'],1,1,'C');
       // $pdf->Cell(105,6,$row['Email'],0,1,'C');
        $total=$row['Total'];
        /*
        $pdf->Cell(70,6,'Factura',1,0,'C');
        $pdf->Cell(70,6,$row['Id'],1,1,'C');

        $pdf->Cell(70,6,'Fecha',1,0,'C');
        $pdf->Cell(70,6,$row['Fecha'].'',1,1,'C');

        $pdf->SetFillColor(232,232,232);
        $pdf->Cell(140,6,'Datos del Cliente',1,1,'C');

        $pdf->Cell(70,6,'Cedula',1,0,'C');
        $pdf->Cell(70,6,$row['Cedula'],1,1,'C');
        $pdf->Cell(70,6,'Nombre',1,0,'C');
        $pdf->Cell(70,6,$row['Nombre'].' '.$row['Apellido'],1,1,'C');
        
        $pdf->Cell(35,6,'Telefono',1,0,'C');
        $pdf->Cell(35,6,$row['Telefono'].'/'.$row['Celular'],1,0,'C');
        $pdf->Cell(35,6,'Direccion',1,0,'C');
        $pdf->Cell(35,6,$row['Direccion'],1,1,'C');
        $pdf->Cell(35,6,'E-mail',1,0,'C');
        $pdf->Cell(105,6,$row['Email'],1,1,'C');
        ///
        $pdf->SetFillColor(232,232,232);
        $pdf->Cell(140,6,'Datos del Combustible',1,1,'C');


        $pdf->Cell(35,6,'Combustible',1,0,'C');
        $pdf->Cell(35,6,'P/GL',1,0,'C');
        $pdf->Cell(35,6,'Cantidad',1,0,'C');
        $pdf->Cell(35,6,'Total',1,1,'C');

        $pdf->Cell(35,6,$row['NombreCom'],1,0,'C');
        $pdf->Cell(35,6,$row['Precio'].' $',1,0,'C');
        $pdf->Cell(35,6,$row['Cantidad'].' GL',1,0,'C');
        $pdf->Cell(35,6,$row['Total'].' $',1,1,'C');

        $pdf->SetFillColor(232,232,232);
        $pdf->Cell(140,6,'Datos de la Venta',1,1,'C');

        $pdf->Cell(35,6,'Usuario',1,0,'C');
        $pdf->Cell(35,6,'Isla',1,0,'C');
        $pdf->Cell(35,6,'Maquina',1,0,'C');
        $pdf->Cell(35,6,'Dispensador',1,1,'C');

        $pdf->Cell(35,6,$row['CedUsr'],1,0,'C');
        $pdf->Cell(35,6,$row['DesIsla'],1,0,'C');
        $pdf->Cell(35,6,$row['DesMaquina'],1,0,'C');
        $pdf->Cell(35,6,$row['Descripcion'],1,1,'C');
*/

    }
    
    $query = "SELECT
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
    and pd.Id_Pedido=".$_GET['id'];

    $resultado = $mysqli->query($query);
    
    $pdf->SetFillColor(232,232,232);
    $pdf->Cell(175,6,'',1,1,'C');
    $pdf->Cell(70,6,'Producto',1,0,'C');
    $pdf->Cell(35,6,'P.Unitario',1,0,'C');
    $pdf->Cell(35,6,'Cantidad',1,0,'C');
    $pdf->Cell(35,6,'Total',1,1,'C');
    while($row = $resultado->fetch_assoc())
	{
       
        

        

        $pdf->Cell(70,6,$row['Producto'].'-'.$row['Nombre'],1,0,'C');
        $pdf->Cell(35,6,$row['Precio'].' $',1,0,'C');
        $pdf->Cell(35,6,$row['Cantidad'].' ',1,0,'C');
        $pdf->Cell(35,6,$row['Subtotal'].' $',1,1,'C');

       


    }
    $pdf->Cell(70,6,'',0,0,'C');
    $pdf->Cell(35,6,'',0,0,'C');
    $pdf->Cell(35,6,'Total',1,0,'C');
    $pdf->Cell(35,6,$total,1,1,'C');

	$pdf->Output();
?>