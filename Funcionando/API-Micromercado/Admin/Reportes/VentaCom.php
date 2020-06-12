<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT
    
    com.Nombre,
    com.Precio,
    TRUNCATE(sum(ven.Total),2)  as Total
FROM
    ventas ven,
    combustibles com,
    dispensador dis
WHERE
    ven.ID_Dispensador=dis.Id
    AND dis.Id_Combustible=com.Id
GROUP by com.Id";

	$resultado = $mysqli->query($query);
	
    $pdf = new PDF();
    
  

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(80,6,'Nombre',1,0,'C',1);
	$pdf->Cell(60,6,'Precio',1,0,'C',1);
	$pdf->Cell(40,6,'Total Consumo',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(80,6,utf8_decode($row['Nombre']),1,0,'C');
		$pdf->Cell(60,6,$row['Precio'],1,0,'C');
		$pdf->Cell(40,6,utf8_decode($row['Total'].' $'),1,1,'C');
	}
	$pdf->Output();
?>