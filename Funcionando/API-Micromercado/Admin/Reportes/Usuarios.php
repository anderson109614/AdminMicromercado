<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT
    
    cli.Cedula,
    CONCAT(CLI.Nombre,' ',cli.Apellido) as Nombre,
    TRUNCATE(sum(ven.Total),2)  as Total
FROM
    ventas ven,
    autos aut,
    clientes cli
WHERE
    ven.ID_Placa=aut.Id
    AND AUT.Id_cliente=CLI.Id
GROUP by cli.Cedula";

	$resultado = $mysqli->query($query);
	
    $pdf = new PDF();
    
  

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(40,6,'Cedula',1,0,'C',1);
	$pdf->Cell(100,6,'Nombre',1,0,'C',1);
	$pdf->Cell(40,6,'Total Consumo',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(40,6,utf8_decode($row['Cedula']),1,0,'C');
		$pdf->Cell(100,6,$row['Nombre'],1,0,'C');
		$pdf->Cell(40,6,utf8_decode($row['Total'].' $'),1,1,'C');
	}
	$pdf->Output();
?>