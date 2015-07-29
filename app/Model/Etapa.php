<?php

App::uses('AppModel', 'Model');

class Etapa extends AppModel {

    public $displayField = 'nome';
    public $belongsTo = array('Processo',
        'ParentEtapa' => array(
            'className' => 'Etapa',
            'foreignKey' => 'parent_id'
        ), 'Grupo' 
    );
    
    public $hasMany = array('ChildEtapa' => array(
            'className' => 'Etapa',
            'foreignKey' => 'parent_id',
            'dependent' => true
        ), 'Atividade', 'AvisoEtapa');
    
    public $hasAndBelongsToMany = array(
        'Aviso' => array(
            'className' => 'Aviso',
            'joinTable' => 'avisos_etapas',
            'foreignKey' => 'etapa_id',
            'associationForeignKey' => 'aviso_id'
        )
    );
    var $validate = array(
        'nome' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser deixado em branco'
        ),
        'duracao' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser deixado em branco'
        )
    );

    public function considerar_apenas_dias_uteis($etapa_id) {

        $this->id = $etapa_id;
        if (!$this->exists())
            return false;
        return $this->field('considerar_apenas_dias_uteis');
    }

    public function calculaDatas($inicio_demanda, $etapa, &$data_inicio, &$data_fim) {
        if ($etapa['duracao_apenas_horario_comercial'] === 0) {
            $inicio = strtotime($inicio_demanda) + $etapa['duracao_etapas_anteriores'] * 60;
            $data_inicio = date("Y-m-d H:i", $inicio);
            $data_fim = date("Y-m-d H:i", $inicio + $etapa['duracao'] * 60);
        }
    }

    // Retorna array de campos_a_retornar das etapas superiores. 
    public function etapasSuperiores($etapa_id, &$etapas_superiores, $campo_a_retornar = 'parent_id') {
        if ($etapa_id) {
            $this->id = $etapa_id;
            $etapas_superiores[] = $this->field($campo_a_retornar);
            $this->etapasSuperiores($this->field('parent_id'), $etapas_superiores, $campo_a_retornar);
        }
    }

    public function usuarioTemAcesso($usuario_id, $etapa_id) {
        // Usuário precisa ser do grupo responsável da etapa, de alguma etapa superior ou do processo
        $this->contain(array('Processo'));
        $etapa = $this->findById($etapa_id);
        $grupos = array($etapa['Processo']['grupo_id'], $etapa['Etapa']['grupo_id']);
        $this->etapasSuperiores($etapa['Etapa']['parent_id'], $grupos, 'grupo_id');
        return $this->Grupo->usuarioPertenceAlgumDosGrupos($usuario_id, $grupos);
    }

}
