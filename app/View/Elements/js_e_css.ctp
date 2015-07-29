<?php 

echo $this->Html->script(array(
            'jquery/jquery',            // jQuery v1.11.1 
            'bootstrap',
            'bootstrap.min',
            'jquery/jquery-ui', // jQuery UI - v1.11.0 
            'jquery/chosen.jquery',
            'jquery/functions.js',
            'jquery-fullscreen-plugin',
            'jquery.select-to-autocomplete',
            'draggable',
            'fancybox/jquery-fancybox-2.1.5',
            'filtro',
            'breadcrumb_sistema',
            'lib_demand',
            'plugins/remover_acentos',
        ));

        echo $this->Html->css(array(
           'jquery-ui.css',
            'bootstrap',
            'bootstrap.min',
            'bootstrap-responsive',
            'bootstrap-responsive.min',
            'font-awesome.min.css',
            'chosen.css',
            'style.css',
            'normalize.css',
            'menu_superior.css',
            'filtro.css',
            'form.css',
            'fancybox/jquery.fancybox-2.1.5.css',
            'loading.css',
        ));
        
        echo $this->fetch('meta');
      //  echo $this->fetch('css');
       // echo $this->fetch('script');
        
        