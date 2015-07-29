<?php

App::uses('AppModel', 'Model');

class AvisoEtapa extends AppModel {

    public $belongsTo = array('Aviso', 'Etapa');
    
    var $validate = array(
        'aviso_id' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser deixado em branco'
        ),
        'destinatarios_aviso' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser deixado em branco'
        )        
    );    
}
