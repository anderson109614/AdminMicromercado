<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT
    
    usr.Cedula,
    CONCAT(usr.Nombre,' ',usr.Apellido) as Nombre,
    TRUNCATE(sum(ven.Total),2)  as Total
FROM
    ventas ven,
    dispensador dis,
    maquias maq,
    islas isl,
    usuarios usr
WHERE
    ven.ID_Dispensador=dis.Id
    AND dis.Id_Maquina=maq.Id
    AND maq.Id_Isla=isl.Id
    AND isl.Id_Usuario=usr.Id
GROUP by usr.Id";

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