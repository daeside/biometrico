<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once ('PHPMailer-master/src/Exception.php');
require ('PHPMailer-master/src/PHPMailer.php');
require ('PHPMailer-master/src/SMTP.php');
require_once ('PHPMailer-master/src/PHPMailer.php');
define('__ROOT__', dirname(dirname(__FILE__)));
require_once ('../DbHelper/Connection.php');
require_once ('PdfLib/fpdf.php');

if (isset($_POST['data']) && isset($_POST['idCotizacion'])) 
{
    $dataRaw = $_POST['data'];
    $id = $_POST['idCotizacion'];
    $correos = [];

    for($i = 0; $i < count($dataRaw); $i++)
    {
      $correos[] = $dataRaw[$i]["value"];
    }

    for($i = 0; $i < count($correos); $i++)
    {
      if($correos[$i] === "Selecciona destinatario")
      {
        unset($correos[$i]);
      }
    }
    $correos = array_values($correos);

$data = Connection::ObtenerCotizaciones('NULL', 'NULL', $id, 'NULL', 'NULL', 'NULL');
$obj = json_decode(json_encode($data[0], JSON_NUMERIC_CHECK));
$date = new DateTime($obj->creation_date);
$vigency = new DateTime($obj->creation_date); 
$vigency = $vigency->add(new DateInterval('P15D'));
$ejecutivo = $obj->nombre_usuario . ' ' . $obj->apellido_usuario;
$items = json_decode($obj->items);
$total = (($obj->total / 100) * 16) + $obj->total;
$table = "";

$html = file_get_contents("Plantilla.html");

$pdf = new FPDF();
$pdf->AddPage();

$pdf->Image('img/logo.png',10,10,-300);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0 , 5, utf8_decode('TECNOTRONIK TECNOLOGÍA INTELIGENTE'), 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0 , 5, utf8_decode('COTIZACIÓN'), 0, 1, 'R');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(75 , 5, 'R.F.C. : ', 0, 0, 'R');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0 , 5, 'GOSR750928I63', 0, 0, 'L');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0 , 5, "Folio: $id" . " " . $date->format('d/m/Y'), 0, 1, 'R');
$pdf->Cell(0 , 5, "Ejecutivo: $ejecutivo", 0, 0, 'R');
$pdf->Cell(0 , 2, '', 0, 1, 'L');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(126 , 5, utf8_decode('Calle: Av. Xel-Ha Edificio Siglo XXI Smz. 24 # 105'), 0, 0, 'R');
$pdf->Cell(0 , 2, '', 0, 1, 'L');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0 , 8, "Vigencia: " . $vigency->format('d/m/Y'), 0, 1, 'R');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(198 , 0, utf8_decode('CP: 77509, BENITO JUAREZ, QUINTANA ROO, MÉXICO'), 0, 1, 'C');
$pdf->Cell(0 , 2, '', 0, 1, 'L');

$pdf->Cell(165 , 8, 'email: ventas@tecnotronik.com', 0, 1, 'C');
$pdf->Cell(170 , 5, 'Tel: (998) 527 0790 / (998) 254 9495', 0, 1, 'C');
$pdf->Cell(0 , 2, '', 'B', 1, 'L');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(5 , 10, 'Cliente (Alias)', 0, 0, 'L');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60 , 10, utf8_decode($obj->name), 0, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0 , 5, 'Direccion del cliente', 0, 1, 'L');
//$pdf->Cell(0 , 5, 'Region 221', 0, 1, 'L');

$pdf->Cell(0 , 7, '', 'B', 1, 'L');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(30 , 10, 'Cantidad', 0, 0, 'L');
$pdf->Cell(30 , 10, 'Clave', 0, 0, 'L');
$pdf->Cell(80 , 10, utf8_decode('Descripción'), 0, 0, 'L');
$pdf->Cell(30 , 10, 'P/U', 0, 0, 'L');
$pdf->Cell(30 , 10, 'Importe', 0, 1, 'L');

$pdf->Cell(0 , 1, '', 'B', 1, 'L');

$pdf->SetFont('Arial', '', 9);

foreach($items as $item)
{
  $pdf->Cell(30 , 7, $item->quantity, 0, 0, 'L'); // cantidad
  $pdf->Cell(30 , 7, $item->code, 0, 0, 'L'); // clave
  $pdf->Cell(80 , 7, utf8_decode(substr($item->description, 0, 40)), 0, 0, 'L'); // descripcion
  $pdf->Cell(30 , 7, $item->precio, 0, 0, 'L'); // P/U
  $pdf->Cell(30 , 7, $item->total, 0, 1, 'L'); // Importe
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100 , 20, utf8_decode('*PRECIOS SUJETOS A CAMBIO SIN PREVIO AVISO'), 0, 0, 'L');
$pdf->Cell(0 , 20, utf8_decode('*ARTICULOS DISPONIBLES SALVO PREVIA VENTA'), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(150 , 5, 'Subtotal', 0, 0, 'R');
$pdf->Cell(0 , 5, $obj->total, 0, 1, 'R');
//$pdf->Cell(150 , 5, 'Descuento', 0, 0, 'R');
//$pdf->Cell(0 , 5, 0, 0, 1, 'R');
$pdf->Cell(150 , 5, 'I.V.A.', 0, 0, 'R');
$pdf->Cell(0 , 5, ($obj->total / 100) * 16, 0, 1, 'R');
$pdf->Cell(150 , 5, 'Total', 0, 0, 'R');
$pdf->Cell(0 , 5, $total, 0, 1, 'R');


$pdf->Image('img/promo1.jpg', 10, 150, 190);
$pdf->Image('img/promo2.jpg', 10, 189, 190);


$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(150 , 100, '', 0, 1, 'R');
$pdf->Cell(0 , 5, utf8_decode("Todos los derechos reservados. Todos los nombres y marcas mencionadas son propiedad de sus respectivos dueños."), 0, 1, 'C');
$pdf->Cell(0 , 5, utf8_decode("Precios y especificaciones sujetas a cambio sin previo aviso. CONSULTE TERMINOS Y CONDICIONES EN tecnotronik.com"), 0, 0, 'C');


$pdf->Output("pdfs/$id.pdf", "F");

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp"; 
$mail->CharSet = 'UTF-8';

$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "ssl";
$mail->Port       = 465;
$mail->Host       = "tecnotronik.com";
$mail->Username   = "ventas@tecnotronik.com";
$mail->Password   = "ti;W2=@JCVMG";

$mail->AddAttachment("pdfs/$id.pdf");
$mail->IsHTML(true);

for($i = 0; $i < count($correos); $i++)
{
  $mail->AddAddress($correos[$i], $correos[$i]);
}
$mail->SetFrom("ventas@tecnotronik.com", $ejecutivo);
//$mail->AddCC("webdeveloper3@thedolphinco.com", $obj->name);
$mail->Subject = "Envio de cotizacion";
$content = $html;
$mail->Body = "Envio de cotizacion numero $id";
$mail->MsgHTML($content);

if($mail->Send())
{
  Connection::ChangeStatus($id); 
}

echo $mail->Send();

}
?>