<?php 
App::import('Vendor','tcpdf/tcpdf'); 

//carrega o construtor do pdf
$Pdf = new TCPDF();

$Pdf->setPrintHeader(false);

$Pdf->setPrintFooter(false);

$Pdf->SetMargins(10, 20, 0);

$Pdf->AddPage('P','A4');

$html = '
 <h1> PDF gerado pelo TCPDF</h1>
 <p>As configurações para cabeçalho e rodapé foram zeradas</p>';

$Pdf->writeHTML($html);

echo $Pdf->Output('etiqueta.pdf','I'); 