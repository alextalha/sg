<?php 
echo $this->Html->script('pivottable');
echo $this->Html->script('koolajax');
echo $table;

//debug($this->Paginator->params());
//echo $this->Paginator->counter(array('format' => __('<div class="paginacao span12"><span class="paginacao-total">Total de registros: {:count}</span><span class="paginacao-paginas">Total de páginas: {:pages}</span>'.$this->Paginator->pagination().'</div>')));