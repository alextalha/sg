<style>
 #expand-export {
    background: rgba(0, 0, 0, 0) linear-gradient(to bottom, rgba(154, 154, 154, 1) 51%, rgba(149, 149, 149, 1) 51%, rgba(142, 142, 142, 1) 51%, rgba(142, 142, 142, 1) 53%, rgba(142, 142, 142, 1) 53%, rgba(142, 142, 142, 1) 54%, rgba(142, 142, 142, 1) 58%, rgba(173, 173, 173, 1) 100%) repeat scroll 0 0;
    
    border-radius: 0 8px 8px 0;
    color: white;
    display: block;
    height: auto;
    overflow: hidden;
    transition: width 1s ease 0s;
    vertical-align: middle;
    white-space: nowrap;
    width: 0;
}

#expand-export.in {
    border: 0.5px solid #858889;
    border-radius: 3px;
    display: block;
    height: 97%;
    width: 79px;
}

    .expand-icon {
      border:1px solid gray;
    }

    #div-icon-expand span, #div-icon-expand span:hover  {
        cursor: pointer;
        font-size: 18px;
        position: relative;
        top: 9px;
        padding: 3px;
    }
 
    #div-icon-expand a {
        margin-top: 30px;
        top: 7px;
        position: relative;
        font-size: 24px;
        color: white;
        margin-left: 2px;
        cursor: pointer;
       
    }
    
.icon-expand {
    background: rgba(0, 0, 0, 0) linear-gradient(to bottom, rgba(154, 154, 154, 1) 51%, rgba(149, 149, 149, 1) 51%, rgba(142, 142, 142, 1) 51%, rgba(142, 142, 142, 1) 53%, rgba(142, 142, 142, 1) 53%, rgba(142, 142, 142, 1) 54%, rgba(142, 142, 142, 1) 58%, rgba(173, 173, 173, 1) 100%) repeat scroll 0 0;
    border: 0.5px solid gray;
    border-radius: 0 2px 2px 0;
    top: -1px;
}

icon-expand, .icon-seta {
    color:black;
    height: 44px;
    top: 3px;
}
.icon-seta-white{
    color:white !important;
}




</style>
 
<script>
       

$(function(){
 
    $("[data-toggle='toggle']").click(function() {
        var selector = $(this).data("target");
        $(selector).toggleClass('in');
        $('#div-icon-expand').toggleClass('icon-expand');
        $('div.icon-seta').toggleClass('icon-seta-white');
        
       });

       });


</script>


<div id="div-icon-expand" data-toggle="toggle" data-target="#expand-export">
    <div class="icon-seta"> <span>&#8227;</span> </div>
</div>

<div id="expand-export" class="">
    
    <?php
    echo $this->element('icon-botoes', array('onclick' => '', 'botao' => 'botao', 'icon' => 'fa fa-file-excel-o',
        "class" => "pesquisar pesquisar_botoes_form", "text" => "Xls", "title" => "Xls"));
    
    echo $this->element('icon-botoes', array('onclick' => '', 'botao'=>'botao', "icon" => "fa fa-file-pdf-o",
        "class" => "pesquisar pesquisar_botoes_form", "text" => "Pdf", "title" => "Pdf" ));
    ?>

</div>