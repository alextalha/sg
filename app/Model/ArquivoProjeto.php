<?php
App::uses('AppModel', 'Model');

class ArquivoDemanda extends AppModel {
    
        
	public $belongsTo = array('Arquivo','Demanda');
}

