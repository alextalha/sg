<?php $url = (isset($url)) ? $this->Html->url(array('controller'=>'arquivos','action' => 'download', $id)) : '#'; ?>
<a class="download" href="<?php echo $url;?>" id="<?php echo $id;?>">
    <div class="botao" title="Download">
        <i class="fa fa-download"></i>
        <!-- download -->
    </div>
</a>
