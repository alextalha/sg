<?php
require_once(APP . 'Vendor' . DS . '/html2pdf/html2pdf.class.php');

        $html2pdf = new HTML2PDF('P','A4');
             $content  =  "<!DOCTYPE html>";
                    $content .=  "<html lang='pt-br'><head>";
                    $content .=  "<meta charset='UTF-8'>";
                    $content .= file_get_contents(APP . 'Vendor' . DS . 'css_export.ctp');
                    $content .= "<body>";
                    $content .= $conteudo;
                    $content .= "</body></html>";
                    $content = preg_replace("/<td><\/td>/s","",$content);
                    $content = preg_replace("/<\/div><\/div>/s","</div>",$content);
                    $content = preg_replace(
                      "/<div class='fa fa-sort-asc'style='float: right; position: relative; margin-top: 7px;'><\/div>/s","",$content);
                    $content = preg_replace("/<script.*?\/script>/s", "", $content);
      
                    
         if($this->request['url']['exportar'] == "Pdf"){
              
                        $html2pdf = new HTML2PDF('P','A4');
                        $html2pdf->WriteHTML($content);
                        $html2pdf->Output();
             
                      
                       //echo $content;
                       
                     //  die();
                       
          }elseif($this->request['url']['exportar'] == "Xls"){
            header("Content-type: application/vnd.ms-excel");
            header("Content-type: text/html;charset=utf-8");
            header("Content-type: application/force-download");
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header("Content-Disposition: attachment;filename=\"{$this->params['controller']}.xls\"");
            header("Cache-Control: max-age=0");
            header('Pragma: no-cache'); // HTTP 1.0
            header('Expires: 0'); // Proxies
            ini_set('memory_limit', '512M');
            
            echo $content;
            
          }
                    
     // header_remove(); 