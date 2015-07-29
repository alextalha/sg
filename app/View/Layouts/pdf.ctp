<?php
    require_once(APP . 'Vendor' . DS . '/html2pdf/html2pdf.class.php');
    //$content  = "<h1> Flashman </h1> <br /> <p> Changeman </p>";
    
    
//    $html2pdf = new HTML2PDF('P','A4','en');
    $content = $this->fetch('content');
//    $html2pdf->pdf->SetDisplayMode('fullpage');
//    $html2pdf->WriteHTML($content);
//    $html2pdf->Output('exemple.pdf');
//    
    echo $content;
    
    
  
  