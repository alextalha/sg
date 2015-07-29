<?php

App::uses('AppModel', 'Model');
App::uses('Parametro','Model');

class Processo extends AppModel {

    public $displayField = 'nome';
    
    public $belongsTo = array('Grupo' => array(
        
            'className'     => 'Grupo',
            'foreignKey'    => 'grupo_id',
            'conditions'    => '',
            'fields'        => '',
            'order'         => ''
    ));
    
    public $hasMany = array(
        
        'Demanda' => array(
            
            'className'     => 'Demanda',
            'foreignKey'    => 'processo_id',
            'dependent'     => true
        ),
        'Etapa' => array(
            
            'className'     => 'Etapa',
            'foreignKey'    => 'processo_id',
            'dependent'     => true
        )        
    );    

    var $validate = array(
        
        'grupo_id'  => array(
            
            'rule'      => 'notEmpty',
            'message'   => 'Este campo não pode ser deixado em branco'
        ),
        'nome'      => array(
            
            'rule'      => 'notEmpty',
            'message'   => 'Este campo não pode ser deixado em branco'
        )        
    );
    
    
    
     public function padraoJsonFiltro(){
               return '[{"id":"Processo.ativo","type":"boolean","val":"1"}]';        
    }
    
    
    public function getActiveProcesses(){
        
        $processes = $this->find('list',array(
            'conditions' => array( 'Processo.ativo' => 1 )
        ));
        return $processes;
    }
    
    public function usuarioTemAcesso($usuario_id, $processo_id) {
        // Usuário precisa ser do grupo responsável do processo ou de alguma de suas etapas
        $this->contain(array('Etapa'));
        $processo = $this->findById($processo_id);
        $grupos[] = $processo['Processo']['grupo_id'];
        foreach ($processo['Etapa'] as $etapa)
            $grupos[] = $etapa['grupo_id'];
        return $this->Grupo->usuarioPertenceAlgumDosGrupos($usuario_id, $grupos);
    }
    
    
    public  function duracaoTotal($etapas) {
        $duracaoTotal = 0;
            foreach ($etapas as $etapa) {
                $duracaoTotal += $etapa['duracao'];
        }
        return $duracaoTotal;
    }
    
        public  function encontraFolhas( $etapas, &$folhas ) {
        if (is_array($etapas)) {
            foreach ($etapas as $key => $etapa) {
                if (isset($etapa['children']) && count($etapa['children'])) {
                    $this->encontraFolhas($etapa['children'], $folhas);
                } else {
                    $folhas[] = $etapa;
                }
            }
        }
    }
    
    public  function OptionsArrayPaginateIndex($condition){
        
        if(empty($condition))
        {
            throw new Exception("Condition vazio");
        }
            $modelParametro = new Parametro();
        
        $opt = array(
                'conditions' => $condition,
                'order'      => array(
                'Grupo.nome',
                'Processo.nome',
                'Processo.versao'
            ),            
            'limit'  => $modelParametro->getParametro('paginator')
        );        
        
         return $opt;
    }
    
    
    public function DadosDemandaProcesso($id)
    {
        if(empty($id))
        {
            throw new Exception('Não pode achar o id referente');
        }
            $demandas = $this->Demanda->find( 'threaded',
            array(
                'recursive' => 0,
                'conditions'=> array( 'Processo.id' => $id )
                 )
            );
        return $demandas;
    }
            
    public function cleanID( &$obj )
    {
        if( empty( $obj ) || count( $obj ) == 0 ){return false;}
            foreach ( $obj as $i => $v )
            {
                $obj[$i]['id'] = null;
                    if( isset( $v['children'] ) ){
                        $this->cleanID( $obj[$i]['children'] );
                    }
            }
    }
                
            
}
