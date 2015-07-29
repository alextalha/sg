<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class AutoloadHelper extends AppHelper {
   
    var $helpers = array('Javascript', 'Html');
    
    function js()
    {
     $this->walker('js');
    }
    
    function css()
    {
     $this->walker('css');
    }


    private function walker( $subpath = "")
    {
     $path = WWW_ROOT .$subpath;
     
     $dir = new Folder($path);
     $files = $dir->find('.*\.'. $subpath);
     
     
     foreach($files as $file)
     {
      if($subpath == 'css')
      {
       echo $this->Html->css($file);
      }else
      {
       echo $this->Html->script($file);
      }
     }
    }
}
