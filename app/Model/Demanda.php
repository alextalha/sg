<?php

App::uses('AppModel', 'Model');

class Demanda extends AppModel {
    
    public $displayField = 'nome';
    public $belongsTo = array('Processo', 'Grupo', 'Usuario', 'StatusAtividade');
    public $hasMany = array('Atividade');
    
    public $hasAndBelongsToMany = array(
        'UsuariosEnvolvidos' => array(
            'className' => 'Usuario',
            'joinTable' => 'demandas_usuarios',
            'foreignKey' => 'demanda_id',
            'associationForeignKey' => 'usuario_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'Arquivo' => array(
            'className' => 'Arquivo',
            'joinTable' => 'arquivos_demandas',
            'foreignKey' => 'demanda_id',
            'associationForeignKey' => 'arquivo_id',
            'unique' => 'keepExisting'
        )
    );
    
    var $validate = array(
        'processo_id' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser deixado em branco'
        ),
        'nome' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser deixado em branco'
        ),
        'grupo_id' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser deixado em branco'
        ),
        'motivo_cancelamento' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser deixado em branco'
        )
    );

    public $virtualFields = array(
        
        'fase'    => 'COALESCE((select E.nome from atividades as A inner join etapas as E on E.id = A.etapa_id
            where A.demanda_id = Demanda.id and A.data_cancelamento is null 
            and A.data_real_inicio is not null and A.parent_id is not null order by data_real_inicio,data_prevista_inicio desc limit 1),\'Não iniciada\')',
        'fase_id' => '(select E.id from atividades as A inner join etapas as E on E.id = A.etapa_id
            where A.demanda_id = Demanda.id and A.data_cancelamento is null 
            and A.data_real_inicio is not null and A.parent_id is not null order by data_real_inicio,data_prevista_inicio desc limit 1)',
        
        "data_inicio"           => "DATE_FORMAT(Demanda.data_inicio,'%d/%m/%Y')",
        "data_conclusao"        => "DATE_FORMAT(Demanda.data_conclusao,'%d/%m/%Y')",
        "data_cancelamento"     => "DATE_FORMAT(Demanda.data_cancelamento,'%d/%m/%Y')",
	"data_real_inicio"      => "DATE_FORMAT(Demanda.data_real_inicio,'%d/%m/%Y')",
	"data_real_termino"     => "DATE_FORMAT(Demanda.data_real_termino,'%d/%m/%Y')",
	"data_prevista_inicio"  => "DATE_FORMAT(Demanda.data_prevista_inicio,'%d/%m/%Y')",
	"data_prevista_termino" => "DATE_FORMAT(Demanda.data_prevista_termino,'%d/%m/%Y')",        
        
    );

    public function dateFormatBeforeSave( $dateString ){
        
        $array = implode("-", array_reverse(explode("/", $dateString)));
        return $array;
    }    

    public function beforeSave($options = array()) {
        
        if(isset($this->data['Demanda']['data_inicio'])){           $this->data['Demanda']['data_inicio'] = ( !is_null(             $this->data['Demanda']['data_inicio'] ) || !empty(          $this->data['Demanda']['data_inicio'] ) ) ? $this->dateFormatBeforeSave(            $this->data['Demanda']['data_inicio'] ) : null;}
        if(isset($this->data['Demanda']['data_conclusao'])){        $this->data['Demanda']['data_conclusao'] = ( !is_null(          $this->data['Demanda']['data_conclusao'] ) || !empty(       $this->data['Demanda']['data_conclusao'] ) ) ? $this->dateFormatBeforeSave(         $this->data['Demanda']['data_conclusao'] ) : null;}
        if(isset($this->data['Demanda']['data_real_inicio'])){      $this->data['Demanda']['data_real_inicio'] = ( !is_null(        $this->data['Demanda']['data_real_inicio'] ) || !empty(     $this->data['Demanda']['data_real_inicio'] ) ) ? $this->dateFormatBeforeSave(       $this->data['Demanda']['data_real_inicio'] ) : null;}
        if(isset($this->data['Demanda']['data_real_termino'])){     $this->data['Demanda']['data_real_termino'] = ( !is_null(       $this->data['Demanda']['data_real_termino'] ) || !empty(    $this->data['Demanda']['data_real_termino'] ) ) ? $this->dateFormatBeforeSave(      $this->data['Demanda']['data_real_termino'] ) : null;}
        if(isset($this->data['Demanda']['data_prevista_inicio'])){  $this->data['Demanda']['data_prevista_inicio'] = ( !is_null(    $this->data['Demanda']['data_prevista_inicio'] ) || !empty( $this->data['Demanda']['data_prevista_inicio'] ) ) ? $this->dateFormatBeforeSave(   $this->data['Demanda']['data_prevista_inicio'] ) : null;}
        if(isset($this->data['Demanda']['data_prevista_termino'])){ $this->data['Demanda']['data_prevista_termino'] = ( !is_null(   $this->data['Demanda']['data_prevista_termino'] ) || !empty( $this->data['Demanda']['data_prevista_termino'] ) ) ? $this->dateFormatBeforeSave( $this->data['Demanda']['data_prevista_termino'] ) : null;}
        if(isset($this->data['Demanda']['data_cancelamento'])){     $this->data['Demanda']['data_cancelamento'] = ( !is_null(       $this->data['Demanda']['data_cancelamento'] ) || !empty(    $this->data['Demanda']['data_cancelamento'] ) ) ? $this->dateFormatBeforeSave(      $this->data['Demanda']['data_cancelamento'] ) : null;}
    }    
   
    public function getDemanda( $id = null ){
        
        if( empty( $id ) ){ return false; }
        
        $demanda = $this->find('all', array(
            'conditions' => array( 'Demanda.id' => $id ),
            'recursive' => 0,
            )
        );
        
        return $demanda;
    }

    public function usuarioTemAcesso( $grupo_id, $demanda ){

        if ( $demanda['Demanda']['grupo_id'] == $grupo_id )
            return true;
        return $this->Processo->usuarioTemAcesso( $grupo_id, $demanda['Demanda']['processo_id'] );
    }
    
}
