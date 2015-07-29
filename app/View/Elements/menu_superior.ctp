<?php if(!$this->Session->check('exportar')){ ?>
<style>
    
      .ui-autocomplete {
      padding: 0;
      list-style: none;
      background-color: #fff;
      width: 218px;
      border: 1px solid #B0BECA;
      max-height: 350px;
      overflow-x: hidden;
    }
    .ui-autocomplete .ui-menu-item {
      border-top: 1px solid #B0BECA;
      display: block;
      padding: 4px 6px;
      color: #353D44;
      cursor: pointer;
    }
    .ui-autocomplete .ui-menu-item:first-child {
      border-top: none;
    }
    .ui-autocomplete .ui-menu-item.ui-state-focus {
      background-color: #D5E5F4;
      color: #161A1C;
    }
    
    
</style>


<script>

var lista,options, html = "";

    (function ($) {
        
        $("#link-login").on("click", function () {
            $("#login").dialog("open");
        });
        
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).parent().siblings().removeClass('open');
                $(this).parent().toggleClass('open');
            });
 

    })(jQuery);
    
       // jQuery('#busca-opcoes').selectToAutocomplete();
    
    
    function infoSistema(e) {
        e.preventDefault();
        $("#dialog-infoSistema").dialog({
            autoOpen: true,
            resizable: true,
            draggable: true,
            modal: true,
            width: '250px',
            height: 'auto',
            open: function (event, ui) {

                var win = $(this);
                $(this).data("uiDialog")._title = function (title) {
                    title.html(this.options.title);
                };
                $(this).dialog('option', 'title', "<?php echo $this->element('barra_cabecalho', array('title' => 'Informações do Sistema','no_help' => true)); ?>");
                $("button.ui-button").remove();

                $(this).prev().find("span#close_superior_window").on('click', function () {

                    win.dialog("close");
                });
            }
        });
    }
    
</script>

<div class="navbar  navbar-inverse">
    <div class='container-fluid'>
        
                <?php if ($this->session->read('UserAuth.Usuario')) : ?>
         
                    <ul class="nav nav-bar navbar-brand">
                        <li class="dropdown  "><a href="#" class="dropdown-toggle titulo_menu" data-toggle="dropdown"><b>BPO</b><i class="fa fa-lg fa-sort-desc fadown"></i></a>
                            <ul class="dropdown-menu multi-level" style="margin-top: 1px">
                                <li class="cabecalho"><span>MENU DO SISTEMA</span></li>
                                    <?php echo $this->element('menus_menu'); ?>

                            </ul>
                        </li> 

                        <li id="breadcrumb"> 
                            <div id="breadcrumb-de-sistema">
                                <ul id="lista-bread-crumb">
                                    <?php
                                        echo $this->element('lista_url', array('urls' => $this->session->read('crumb')));
                                    ?>
                                </ul>
                            </div>
                        </li>     
                    </ul>
            <!--</div> -->
            
       <!--  <div class="col-md-3">  -->
                <?php endif; ?>
                    <ul class="nav pull-right"  >
                        <?php if ($this->session->read('UserAuth.Usuario')) { ?>
                        <li>
                            
                            <!-- Campo de Busca -->
                            
                            <?php 
                            echo $this->Form->create('Menus', array(
                                    'url' => array('controller' => 'buscas' , 'action' => 'index'),
                                    'type' => 'post',
                                        'inputDefaults' => array(
                                        'label' => false,
                                        'div' => false
                            )));
                            
                            echo $this->Form->input(
                                    'menu_search',
                                    array(
                                        'options' => "",
                                        'type' => 'select',
                                        'placeholder' => 'Busca Rápida',
                                        'id' => 'busca-opcoes',
                                        'autocomplete' => 'off',
                                        'autofocus' => 'autofocus',
                                        'class' => 'busca'
                                       
                                     )
                            );
      
                            echo $this->Form->end();
      
                            ?>
        
 
                            </li>

                            <li class='icones_superiores' >
                                <ul>
                                    <li> <a href="<?php echo $this->Html->url("/"); ?>"> <?php echo $this->element('icon-factory', array('icon_name' => 'home', 'color_circle' => '#1C1C1C', 'bottom' => '1', 'title' => 'Home')); ?> </a> </li>
                                    <li> <a href="#">  </a> <?php echo $this->element('icon-factory', array('icon_name' => 'font', 'color_circle' => '#1C1C1C', 'bottom' => '1', 'title' => 'Aumentar Fonte')); ?> </li>
                                    <li onclick="toggleFullScreen(event)"> <a href="#">  </a> <?php echo $this->element('icon-factory', array('icon_name' => 'expand', 'color_circle' => '#1C1C1C', 'bottom' => '1', 'title' => 'Full Screen')); ?> </li>
                                    <li onclick="infoSistema(event)"> <a href="#">  </a> <?php echo $this->element('icon-factory', array('icon_name' => 'info', 'color_circle' => '#1C1C1C', 'bottom' => '1', 'title' => 'Informações do Sistema')); ?> </li>
                                    <li> <a href="<?php echo $this->Html->url(array('controller' => 'usuarios', 'action' => 'logout')); ?>"> <?php echo $this->element('icon-factory', array('icon_name' => 'times', 'color_circle' => '#1C1C1C', 'bottom' => '1', 'title' => 'Logoff')); ?> </a> </li>

                                    <?php
                                } else {
                                    echo $this->Html->link(__('Sign In'), '#', array('id' => 'link-login'));
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
      <!--  </div>  -->
    

          
          </div>
            
        </div>

    <div id="dialog-infoSistema" title="Informações" style="display: none">
        <div>
            <center><?php echo $this->Html->image(Router::url('/', true) . "/imagens/logo_triad.png"
                                                , array("alt"     => "Triad Systems"
                                                      , "title"   => "Triad Systems"
                                                      , "onclick" => "window.open('http://triadsystems.com.br/');"
                                                      , "style"   => "cursor:pointer"));
  ?></center><br />
            <div class="infostatusSistema"><b> Sobre Você : </b></div>
            <div class="infostatusSistema"><b> Usuário : </b><?php echo $this->Html->link($this->session->read('UserAuth.Usuario.nome')." ( ".$this->session->read('UserAuth.Usuario.username'). " )", '/usuarios/myprofile' , array('class' => ''));  ?></div>
            <div class="infostatusSistema"><b> Grupos : </b><?php 

     
     $x = "";
$grupos = $this->session->read('UserAuth.Grupo');
function ordenax($a, $b){ return strcmp($a["nome"], $b["nome"]); }
usort($grupos, "ordenax");
foreach($grupos as $k=>$v){ $x .= ", ".$v["nome"]; }
echo substr($x,2);

            
?></div>
            <!--<div class="infostatusSistema"> Perfil : </div>   -->
 
        </div>
        <div>
            <br />
            <div class="infostatusSistema"><b>Sobre o Sistema : </b></div>
            <div class="infostatusSistema"><b>Sistema :</b>  Portal BPO TRIAD/TIM © 2015 </div>
            <div class="infostatusSistema"><b>Versão : </b> 1.1.20 </div>
            <div class="infostatusSistema"><b> Core : </b>PHP 5.5 | Apache 2.4 | CakePHP 2.4 | Bootstrap 2.3.2 </div>
            <div class="infostatusSistema"><b> Base de Dados: </b> MySQL, Oracle, PostgreeSQL, SQLServer, SQLite </div>
        </div>

        <p>
            <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        </p>

    </div>
 

<script>
    
(function($){
    
  $(function(){
 // array de elementos do menu para popular na busca ;
            jQuery.ajax({
                url: "<?php echo Router::url("/", true); ?>" + "buscas/getlist",
                type: "POST",
                cache: false,
                dataType: "json"
                }).done(function(obj) {
                   
                   html = '<option value="" selected="selected"> --- </option>';
                      for(var key in obj) {
                             html += "<option name='" + obj[key] +"' value='" + obj[key] +"'>" + obj[key] + "</option>";
                        }
                    
                      jQuery('#busca-opcoes').append(html);
                      jQuery('select[placeholder="Busca Rápida"]').selectToAutocomplete();
     
    });
                });

  })(jQuery);

</script>

<?php } ?>
