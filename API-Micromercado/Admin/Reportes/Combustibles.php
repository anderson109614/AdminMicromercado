<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT `Nombre`, `Precio`, `Cant_Disponible` FROM `combustibles` WHERE Estado=1";
	$resultado = $mysqli->query($query);
	
    $pdf = new PDF();
    
  

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(100,6,'Nombre',1,0,'C',1);
	$pdf->Cell(40,6,'Precio',1,0,'C',1);
	$pdf->Cell(40,6,'Cantidad',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(100,6,utf8_decode($row['Nombre']),1,0,'C');
		$pdf->Cell(40,6,$row['Precio'].'$',1,0,'C');
		$pdf->Cell(40,6,utf8_decode($row['Cant_Disponible'].' GL'),1,1,'C');
	}
	$pdf->Output();
?>