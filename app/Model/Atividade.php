<?php

App::uses('AppModel', 'Model');
App::uses('CakeSession', 'Model/Datasource');

class Atividade extends AppModel{

    public $displayField = 'nome';
    
    public $belongsTo = array('Demanda', 'Etapa', 'Usuario', 'StatusAtividade',
        'ParentAtividade' => array(
            'className' => 'Atividade',
            'foreignKey' => 'parent_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    public $hasMany = array(
        'Atividade' => array(
            'className' => 'Atividade',
            'foreignKey' => 'parent_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    
    public $hasAndBelongsToMany = array(
        'UsuariosEnvolvidos' => array(
            'className' => 'Usuario',
            'joinTable' => 'atividades_usuarios',
            'foreignKey' => 'atividade_id',
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
            'foreignKey' => 'atividade_id',
            'associationForeignKey' => 'arquivo_id',
            'unique' => 'keepExisting'
        )        
    );
    
    public $virtualFields = array(
        
        "data_cancelamento"     => "DATE_FORMAT(Atividade.data_cancelamento,'%d/%m/%Y')",
	"data_real_inicio"      => "DATE_FORMAT(Atividade.data_real_inicio,'%d/%m/%Y')",
	"data_real_termino"     => "DATE_FORMAT(Atividade.data_real_termino,'%d/%m/%Y')",
	"data_prevista_inicio"  => "DATE_FORMAT(Atividade.data_prevista_inicio,'%d/%m/%Y')",
	"data_prevista_termino" => "DATE_FORMAT(Atividade.data_prevista_termino,'%d/%m/%Y')",
    );
    
    private function dateFormatBeforeSave( $dateString ){
        
        $array = implode( "-", array_reverse( explode( "/", $dateString ) ) );
        return $array;
    }
    
    private function dateFormatBeforeFind( $dateString ){
        
        $date_format = DateTime::createFromFormat('d/m/Y', $dateString);
        return $date_format;
    }       

    public function beforeSave($options = array()) {
        
        if(isset($this->data['Atividade']['data_real_inicio'])){$this->data['Atividade']['data_real_inicio'] = ( !is_null( $this->data['Atividade']['data_real_inicio'] ) || !empty( $this->data['Atividade']['data_real_inicio'] ) ) ? $this->dateFormatBeforeSave( $this->data['Atividade']['data_real_inicio'] ) : null;}
        if(isset($this->data['Atividade']['data_real_termino'])){$this->data['Atividade']['data_real_termino'] = ( !is_null( $this->data['Atividade']['data_real_termino'] ) || !empty( $this->data['Atividade']['data_real_termino'] ) ) ? $this->dateFormatBeforeSave( $this->data['Atividade']['data_real_termino'] ) : null;}
        if(isset($this->data['Atividade']['data_prevista_inicio'])){$this->data['Atividade']['data_prevista_inicio'] = ( !is_null( $this->data['Atividade']['data_prevista_inicio'] ) || !empty( $this->data['Atividade']['data_prevista_inicio'] ) ) ? $this->dateFormatBeforeSave( $this->data['Atividade']['data_prevista_inicio'] ) : null;}
        if(isset($this->data['Atividade']['data_prevista_termino'])){$this->data['Atividade']['data_prevista_termino'] = ( !is_null( $this->data['Atividade']['data_prevista_termino'] ) || !empty( $this->data['Atividade']['data_prevista_termino'] ) ) ? $this->dateFormatBeforeSave( $this->data['Atividade']['data_prevista_termino'] ) : null;}
        if(isset($this->data['Atividade']['data_cancelamento'])){$this->data['Atividade']['data_cancelamento'] = ( !is_null( $this->data['Atividade']['data_cancelamento'] ) || !empty( $this->data['Atividade']['data_cancelamento'] ) ) ? $this->dateFormatBeforeSave( $this->data['Atividade']['data_cancelamento'] ) : null;}
    }

    public function getNome($atividade_id) {

        $this->id = $atividade_id;
        return $this->field('nome');
    }

    public function usuarioTemAcesso($usuario_id, $atividade_id) {
        $atividade = $this->findById($atividade_id);
        if ($atividade['Atividade']['usuario_id'] == $usuario_id)
            return true;
        return ($this->Demanda->usuarioTemAcesso($usuario_id, $atividade['Atividade']['demanda_id']) || ($atividade['Atividade']['etapa_id'] && $this->Etapa->usuarioTemAcesso($usuario_id, $atividade['Atividade']['etapa_id'])));
    }

    // Retorna objetos inteiros das atividades superiores.
    public function atividadesSuperiores($atividade_id, &$atividades_superiores) {
        if ($atividade_id) {
            $atividade = $this->findById($atividade_id);
            $atividades_superiores[] = $atividade;
            $this->atividadesSuperiores($atividade['Atividade']['parent_id'], $atividades_superiores);
        }
    }

    // Retorna array de campos_a_retornar das atividades superiores. 
    public function atividadesSuperioresCampos($atividade_id, &$atividades_superiores, $campo_a_retornar = 'parent_id') {
        if ($atividade_id) {
            $this->id = $atividade_id;
            $atividades_superiores[] = $this->field($campo_a_retornar);
            $this->atividadesSuperioresCampos($this->field('parent_id'), $atividades_superiores, $campo_a_retornar);
        }
    }

    public function subAtividades($atividade_id, &$subatividades) {
        if ($atividade_id) {
            $this->recursive = -1;
            $subatividades_parcial = $this->findAllByParentId($atividade_id);
            $subatividades = array_merge($subatividades, $subatividades_parcial);
            foreach ($subatividades_parcial as $subatividade) {
                $this->subAtividades($subatividade['Atividade']['id'], $subatividades);
            }
        }
    }

    public function subAtividadesCampos($atividade_id, &$subatividades, $campo_a_retornar = 'id') {
        if ($atividade_id) {
            $this->recursive = -1;
            $subatividades_parcial = $this->findAllByParentId($atividade_id);
            foreach ($subatividades_parcial as $subatividade) {
                $this->id = $subatividade['id'];
                $subatividades[] = ($campo_a_retornar == 'id') ? $subatividade['id'] : $this->field($campo_a_retornar);
                $this->subAtividadesCampos($subatividade['id'], $subatividades, $campo_a_retornar);
            }
        }
    }

    public function getEmailsResponsaveis( $atividade_id ){
        
        $atividade = $this->findById($atividade_id);
        $usuarios_id = array($atividade['Atividade']['usuario_id'], $atividade['Demanda']['usuario_id']);
        $this->atividadesSuperioresCampos($atividade['Atividade']['parent_id'], $usuarios_id, 'usuario_id');
        $usuarios = $this->Usuario->find('list', array(
            'fields' => array('Usuario.id', 'Usuario.email'),
            'conditions' => array('Usuario.id' => $usuarios_id)
        ));
        foreach ($usuarios as $id => $email)
            $to .= $email . ",";
        return $to;
    }

    public function getGruposResponsaveis($atividade_id) {
        $this->contain(array("Etapa" => array("Processo")));
        $atividade = $this->findById($atividade_id);
        $grupos_id = array($atividade['Etapa']['grupo_id'], $atividade['Etapa']['Processo']['grupo_id']);
        $this->Etapa->etapasSuperiores($atividade['Etapa']['parent_id'], $grupos_id, 'grupo_id');
        return $grupos_id;
    }

    public function getDestinatariosAviso($destinarios_aviso, $atividade_id){
        
        switch ($destinarios_aviso) {
            
            case 'usuario':
                
                $to = $this->getEmailsResponsaveis($atividade_id);
                break;
            
            case 'grupo':
                
                $grupos_responsaveis_id = $this->getGruposResponsaveis($atividade_id);
                $grupo = ClassRegistry::init( 'Grupo' );
                $to    = $grupo->getEmailsUsuariosGrupos($grupos_responsaveis_id);
                
                break;
            
            case 'todos_envolvidos':
                
                $this->contain(array(
                    "UsuariosEnvolvidos",
                    "Etapa" => array("Grupo" => array("Usuario")),
                    "Demanda" => array("UsuariosEnvolvidos",
                        "Processo" => array("Grupo" => array("Usuario"))
                    )
                ));
                $estruturaCompleta = $this->findById($atividade_id);
                $usuarios = array_merge($estruturaCompleta['UsuariosEnvolvidos'], $estruturaCompleta['Demanda']['UsuariosEnvolvidos']);
                $this->getSubArraysWithThisKey($estruturaCompleta, "Usuario", $usuarios);
                $to = "";
                foreach ($usuarios as $usuario)
                    $to .= $usuario['email'] . ",";
                break;
            default:
                break;
        }
        return $to;
    }

    public function preencheDados($dados, $atividade_id) {
        $atividade = $this->findById($atividade_id);
        $dados_preenchidos = array();
        foreach ($dados as $dado) {
            $conteudo = $atividade;
            $chaves = explode(".", $dado);
            foreach ($chaves as $chave)
                $conteudo = $conteudo[$chave];
            $dados_preenchidos[] = $conteudo;
        }
        return $dados_preenchidos;
    }

    public function alteraCamposDatas($elemento_alterado_por_usuario, &$atividade_sendo_propagada, $prorrogacao = false) {
        if ($prorrogacao) {
            
        } else {
            if (isset($elemento_alterado_por_usuario['data_cancelamento']))
                $atividade_sendo_propagada['data_cancelamento'] = $elemento_alterado_por_usuario['data_cancelamento'];
            if (isset($elemento_alterado_por_usuario['motivo_cancelamento']))
                $atividade_sendo_propagada['motivo_cancelamento'] = $elemento_alterado_por_usuario['motivo_cancelamento'];
            if (isset($elemento_alterado_por_usuario['data_conclusao']))
                $atividade_sendo_propagada['data_conclusao'] = $elemento_alterado_por_usuario['data_conclusao'];
            if (isset($elemento_alterado_por_usuario['descricao_conclusao']))
                $atividade_sendo_propagada['descricao_conclusao'] = $elemento_alterado_por_usuario['descricao_conclusao'];
            if (isset($elemento_alterado_por_usuario['percentual_conclusao']))
                $atividade_sendo_propagada['percentual_conclusao'] = $elemento_alterado_por_usuario['percentual_conclusao'];
        }
    }

    public function propagaAcaoSubatividades($atividade_alterada_por_usuario, $prorrogacao = false) {
        $subatividades[] = $atividade_alterada_por_usuario;
        $this->subAtividades($atividade_alterada_por_usuario['Atividade']['id'], $subatividades);
        foreach ($subatividades as $key => $variavel_nao_utilizada) {
            $this->alteraCamposDatas($atividade_alterada_por_usuario['Atividade'], $subatividades[$key]['Atividade'], $prorrogacao);
        }
        return $subatividades;
    }

    public function propagaAcaoAtividadesDeDemanda($demanda_alterado_por_usuario, $prorrogacao = false){
        $this->recursive = -1;
        $demanda_com_atividades = $demanda_alterado_por_usuario;
        $demanda_com_atividades['Atividade'] = $this->findAllByDemandaId($demanda_alterado_por_usuario['Demanda']['id']);
        foreach ($demanda_com_atividades['Atividade'] as $key => $v) {
            $demanda_com_atividades['Atividade'][$key] = $demanda_com_atividades['Atividade'][$key]['Atividade'];
            $this->alteraCamposDatas($demanda_alterado_por_usuario['Demanda'], $demanda_com_atividades['Atividade'][$key], $prorrogacao);
        }
        return $demanda_com_atividades;
    }

    public function atualizaPercentualConclusaoAtividadesSuperiores( $atividade_id, $duracao_etapa_concluida = 0 ){
        if ($atividade_id) {
            $this->contain(array("Etapa"));
            $atividade = $this->findById($atividade_id);

            if ($atividade['Atividade']['parent_id']) {
                if ($duracao_etapa_concluida == 0)
                    $duracao_etapa_concluida = $atividade['Etapa']['duracao'];
                $this->contain(array("Etapa"));
                $atividade_pai = $this->findById($atividade['Atividade']['parent_id']);

                $novo_percentual_conclusao = $atividade_pai['Atividade']['percentual_conclusao'] + 100 * $duracao_etapa_concluida / $atividade_pai['Etapa']['duracao'];
                $this->id = $atividade['Atividade']['parent_id'];
                $this->saveField('percentual_conclusao', round($novo_percentual_conclusao, 2));
                if ($novo_percentual_conclusao > 99)
                    $this->saveField('data_conclusao', date('Y-m-d H:i:s'));
                if ($atividade_pai['Atividade']['parent_id'])
                    $this->atualizaPercentualConclusaoAtividadesSuperiores($atividade_pai['Atividade']['parent_id'], $duracao_etapa_concluida);
            }
        }
    }    
    //-----------Edit by furious------------//

    private function dataPascoa($ano = false, $form = "d/m/Y"){

        $ano = $ano ? $ano : date("Y");
        
        if ($ano < 1583) {
            
            $A = ($ano % 4);
            $B = ($ano % 7);
            $C = ($ano % 19);
            $D = ((19 * $C + 15) % 30);
            $E = ((2 * $A + 4 * $B - $D + 34) % 7);
            $F = (int) (($D + $E + 114) / 31);
            $G = (($D + $E + 114) % 31) + 1;
            
            return date($form, mktime(0, 0, 0, $F, $G, $ano));
            
        } else {
            
            $A = ($ano % 19);
            $B = (int) ($ano / 100);
            $C = ($ano % 100);
            $D = (int) ($B / 4);
            $E = ($B % 4);
            $F = (int) (($B + 8) / 25);
            $G = (int) (($B - $F + 1) / 3);
            $H = ((19 * $A + $B - $D - $G + 15) % 30);
            $I = (int) ($C / 4);
            $K = ($C % 4);
            $L = ((32 + 2 * $E + 2 * $I - $H - $K) % 7);
            $M = (int) (($A + 11 * $H + 22 * $L) / 451);
            $P = (int) (($H + $L - 7 * $M + 114) / 31);
            $Q = (($H + $L - 7 * $M + 114) % 31) + 1;
            
            return date($form, mktime(0, 0, 0, $P, $Q, $ano));
        }
    }

    private function dataCarnaval($ano = false, $form = "d/m/Y") {

        $ano    = $ano ? $ano : date("Y");
        $a      = explode("/", $this->dataPascoa($ano));
        
        return date($form, mktime(0, 0, 0, $a[1], $a[0] - 47, $a[2]));
    }

    private function dataCorpusChristi($ano = false, $form = "d/m/Y") {

        $ano    = $ano ? $ano : date("Y");
        $a      = explode("/", $this->dataPascoa($ano));
        
        return date($form, mktime(0, 0, 0, $a[1], $a[0] + 60, $a[2]));
    }

    private function datasextaSanta($ano = false, $form = "d/m/Y") {

        $ano    = $ano ? $ano : date("Y");
        $a      = explode("/", $this->dataPascoa($ano));
        
        return date($form, mktime(0, 0, 0, $a[1], $a[0] - 2, $a[2]));
    }
    
    private function somar_dias_uteis($str_data, $int_qtd_dias_somar, $feriados) {

// Caso seja informado uma data do MySQL do tipo DATETIME - aaaa-mm-dd 00:00:00
// Transforma para DATE - aaaa-mm-dd

        $str_data = substr($str_data, 0, 10);

// Se a data estiver no formato brasileiro: dd/mm/aaaa
// Converte-a para o padrão americano: aaaa-mm-dd

        if (preg_match("@/@", $str_data) == 1) {

            $str_data = implode("-", array_reverse(explode("/", $str_data)));
        }


// chama a funcao que calcula a pascoa	
        $pascoa_dt      = $this->dataPascoa(date('Y'));
        $aux_p          = explode("/", $pascoa_dt);
        $aux_dia_pas    = $aux_p[0];
        $aux_mes_pas    = $aux_p[1];
        $pascoa         = "$aux_mes_pas" . "-" . "$aux_dia_pas"; // crio uma data somente como mes e dia
// chama a funcao que calcula o carnaval	
        $carnaval_dt    = $this->dataCarnaval(date('Y'));
        $aux_carna      = explode("/", $carnaval_dt);
        $aux_dia_carna  = $aux_carna[0];
        $aux_mes_carna  = $aux_carna[1];
        $carnaval       = "$aux_mes_carna" . "-" . "$aux_dia_carna";


// chama a funcao que calcula corpus christi	
        $CorpusChristi_dt   = $this->dataCorpusChristi(date('Y'));
        $aux_cc             = explode("/", $CorpusChristi_dt);
        $aux_cc_dia         = $aux_cc[0];
        $aux_cc_mes         = $aux_cc[1];
        $Corpus_Christi     = "$aux_cc_mes" . "-" . "$aux_cc_dia";


// chama a funcao que calcula a sexta feira santa	
        $sexta_santa_dt     = $this->datasextaSanta(date('Y'));
        $aux                = explode("/", $sexta_santa_dt);
        $aux_dia            = $aux[0];
        $aux_mes            = $aux[1];
        $sexta_santa        = "$aux_mes" . "-" . "$aux_dia";

        //$feriados = array("01-01", $carnaval, $sexta_santa, $pascoa, $Corpus_Christi, "04-21", "05-01", "06-12", "07-09", "07-16", "09-07", "10-12", "11-02", "11-15", "12-24", "12-25", "12-31");

        // COLOCAR ESSES ARRAYS PRA VIR DO BANCO DE DADOS
        $feriados = array("01-01"
                   , $carnaval
                   , $sexta_santa
                   , $pascoa
                   , $Corpus_Christi
                   , "04-21", "04-23"
                   , "05-01"
                   , "06-12" 
                   , "09-07"
                   , "10-12"
                   , "11-02"
                   , "11-15"
                   , "12-25"
                   , "12-31");

        $recessos = array("2014-12-22", "2014-12-23", "2014-12-24","2014-12-26","2014-12-29","2014-12-30"
                         ,"2015-01-02","2015-01-20"
                         ,"2015-02-16","2015-02-18"
                         ,"2015-06-05"
                         );
        //debug( $str_data );
        $array_data         = explode('-', $str_data);
        $count_days         = 0;
        $int_qtd_dias_uteis = 0;

        while ($int_qtd_dias_uteis < $int_qtd_dias_somar) {

            $count_days++;
            $day = date('m-d', strtotime('+' . $count_days . 'day', strtotime($str_data)));
            $day2 = date('Y-m-d', strtotime('+' . $count_days . 'day', strtotime($str_data)));

            if (($dias_da_semana = gmdate('w', strtotime('+' . $count_days . ' day', gmmktime(0, 0, 0, $array_data[1], $array_data[2], $array_data[0]))) ) != '0' && $dias_da_semana != '6' && !in_array($day, $feriados) && !in_array($day2, $recessos)) {

                $int_qtd_dias_uteis++;
            }
        }
        //$count_days = ( $count_days - 1 );
        return gmdate('d/m/Y', strtotime('+' . $count_days . ' day', strtotime($str_data)));
    }
    
    public function propagaDatas( &$etapas, &$data_ini, $etapa_id = null, &$termino_modificado = false, &$propaga = false ){
       
        foreach ( $etapas as $i => $v ){

            if( isset( $v['children'] ) ){

                $this->propagaDatas( $etapas[$i]['children'], $data_ini, $etapa_id, $termino_modificado, $propaga );
                
                $etapas[$i]['data_prevista_inicio']  = $this->getDatePI( $etapas[$i]['children'] );
                $etapas[$i]['data_prevista_termino'] = $this->getDatePT( $etapas[$i]['children'] );

            } else {

                if( is_null( $etapa_id ) ){

                    $propaga            = true;
                    $termino_modificado = false;

                } else {

                    $termino_modificado = false;
                    
                    if( $etapa_id == $v['id'] ){

                        if( $data_ini == $v['data_prevista_termino'] ){
                            return false;
                        }

                        $propaga             = true;
                        $termino_modificado  = true;
                    }
                }

                if( $propaga === true ){

                    if( $termino_modificado === true ){
                        
                        $etapas[$i]['data_prevista_termino']    = $this->somar_dias_uteis( $data_ini, 0, '' );
                        $termino_modificado                     = false;
                        
                    } else {
                        
                        $etapas[$i]['data_prevista_inicio']     = $this->somar_dias_uteis($data_ini, 1, '');
                        $etapas[$i]['data_prevista_termino']    = $this->somar_dias_uteis($data_ini, intval($v['duracao']), '');
                        $data_ini                               = $this->somar_dias_uteis($data_ini, intval($v['duracao']), '');                        
                    }
                }
            }
        }
    }

    public function getStatus( &$atividade ){

        if( !empty( $atividade ) ){
        
        //   (case when Atividade.data_cancelamento is not null then \'Cancelado\'
        //    when Atividade.data_real_termino is not null and Atividade.data_cancelamento is null then \'Concluído\'
        //    when Atividade.usuario_id is null then \'Sem responsável\'
        //    when Atividade.data_prevista_termino < coalesce(Atividade.data_real_termino,now()) then \'Atrasado\'
        //    when Atividade.data_real_inicio is null and Atividade.data_prevista_inicio < now() then \'Atrasado\'
        //    when Atividade.data_real_inicio is not null then \'Em andamento\'
        //    else \'Planejado\' end )

            $cancelamento       = $this->dateFormatBeforeFind( $atividade['data_cancelamento'] );
            $inicio_real        = $this->dateFormatBeforeFind( $atividade['data_real_inicio'] );
            $termino_real       = $this->dateFormatBeforeFind( $atividade['data_real_termino'] );
            $inicio_previsto    = $this->dateFormatBeforeFind( $atividade['data_prevista_inicio'] );
            $termino_previsto   = $this->dateFormatBeforeFind( $atividade['data_prevista_termino'] );
            $hoje               = $this->dateFormatBeforeFind( date('d/m/Y') );

            $cancelamento       = (!$cancelamento)      ?null:$cancelamento;
            $inicio_real        = (!$inicio_real)       ?null:$inicio_real;
            $termino_real       = (!$termino_real)      ?null:$termino_real;
            $inicio_previsto    = (!$inicio_previsto)   ?null:$inicio_previsto;
            $termino_previsto   = (!$termino_previsto)  ?null:$termino_previsto;
            
            $responsavelD       = ( isset( $atividade['atividade_usuario_id'] ) ) ? $atividade['atividade_usuario_id'] : null;
            $responsavelA       = ( isset( $atividade['usuario_id'] ) ) ? $atividade['usuario_id'] : null;

            $responsavel        = ( is_null( $responsavelD ) ) ? $responsavelA : $responsavelD;

            if( !is_null( $cancelamento ) ){
                
                $atividade['status_atividade_id'] = 5;
            } else if( !is_null( $termino_real ) && is_null( $cancelamento ) ){
                
                $atividade['status_atividade_id'] = 6;
            } else if( is_null( $responsavel ) ){
                
                $atividade['status_atividade_id'] = 1;
            }else if( $termino_previsto < ( (is_null( $termino_real )) ? $hoje : $termino_real ) ){
                
                $atividade['status_atividade_id'] = 4;
            }else if( is_null( $inicio_real ) && $inicio_previsto < $hoje ){
                
                $atividade['status_atividade_id'] = 4;
            }else if( !is_null( $inicio_real ) ){
                
                $atividade['status_atividade_id'] = 3;
            }else{
                
                $atividade['status_atividade_id'] = 2;
            }
        }
    }
    
    public function getDuracao( Array $children ){
        
        if( !empty( $children ) ){
            
            $duracao = 0;
            foreach ( $children as $i => $v ){
                
                if( isset( $v['Atividade'] ) ){ $v = $v['Atividade']; }
                
                if( is_null($v['data_cancelamento']) || empty( $v['data_cancelamento'] ) ){
                
                    $duracao += intval( $v['duracao'] );
                }
            }
            return $duracao;
        }
    }
    
    public function getUser( Array $children ){
        
        if( !empty( $children ) ){
            
            $user = null;
            foreach ( $children as $i => $v ){
                
                if( isset( $v['Atividade'] ) ){ $v = $v['Atividade']; }
                
                if( is_null($v['data_cancelamento']) || empty( $v['data_cancelamento'] ) ){
                    
                    if( !is_null( $v['usuario_id'] ) && !empty( $v['usuario_id'] ) ){
                        
                        $user = $v['usuario_id'];
                    }
                }
            }
            return $user;
        }
    }
    
    public function getDateCancel( Array $children ){
        
        if( !empty( $children ) ){
            
            $data_cancelamento = null;
            
            foreach ( $children as $i => $v ){
                
                if( isset( $v['Atividade'] ) ){ $v = $v['Atividade']; }

                if( is_null( $v['data_cancelamento'] ) || empty( $v['data_cancelamento'] ) ){
                    
                    return null;
                    
                }  else {
                    
                    $r = str_replace('/', '-', $v['data_cancelamento']);

                    if( is_null( $data_cancelamento ) ){
                        
                        $data_cancelamento = $r;
                        
                    } else if( strtotime( $data_cancelamento ) < strtotime( $r ) ) {
                        
                        $data_cancelamento = $r;
                    }
                }
            }
            return str_replace('-', '/', $data_cancelamento);
        }
    }    

    public function getDateI( Array $children ){
        
        if( !empty( $children ) ){

            $inicio_real = null;

            foreach ( $children as $i => $v ){
                
                if( isset( $v['Atividade'] ) ){ $v = $v['Atividade']; }

                if( is_null( $v['data_cancelamento'] ) || empty( $v['data_cancelamento'] ) ){
                    
                    if( !is_null($v['data_real_inicio']) && !empty( $v['data_real_inicio'] ) ){
                        
                        $r = str_replace('/', '-', $v['data_real_inicio']);

                        if( is_null( $inicio_real ) ){
                            
                            $inicio_real = $r;
                            
                        }else if( strtotime( $inicio_real ) > strtotime( $r ) ){
                            
                            $inicio_real = $r;
                        }
                    }
                }
            }
            return str_replace('-', '/', $inicio_real);
        }
    }

    public function getDateT( Array $children ){
        
        if( !empty( $children ) ){

            $termino_real = null;
            
            foreach ( $children as $i => $v ){
                
                if( isset( $v['Atividade'] ) ){ $v = $v['Atividade']; }

                if( is_null( $v['data_cancelamento'] ) || empty( $v['data_cancelamento'] ) ){
                    
                    if( is_null($v['data_real_termino']) || empty( $v['data_real_termino'] ) ){

                        return null;
                        
                    }else{
                        
                        $r = str_replace('/', '-', $v['data_real_termino']);
                        if( is_null( $termino_real ) ){

                            $termino_real = $r;

                        } else if( strtotime( $termino_real ) < strtotime( $r ) ) {

                            $termino_real = $r;
                        }
                    }
                }
            }
            return str_replace('-', '/', $termino_real);
        }
    }

    public function getDatePI( Array $children ){
        
        if( !empty( $children ) ){

            $inicio_prevista = null;

            foreach ( $children as $i => $v ){
                
                if( isset( $v['Atividade'] ) ){ $v = $v['Atividade']; }

                if( is_null( $v['data_cancelamento'] ) || empty( $v['data_cancelamento'] ) ){
                    
                    if( !is_null($v['data_prevista_inicio']) && !empty( $v['data_prevista_inicio'] ) ){
                        
                        $r = str_replace('/', '-', $v['data_prevista_inicio']);

                        if( is_null( $inicio_prevista ) ){
                            
                            $inicio_prevista = $r;
                            
                        }else if( strtotime( $inicio_prevista ) > strtotime( $r ) ){
                            
                            $inicio_prevista = $r;
                        }
                    }
                }
            }
            return str_replace('-', '/', $inicio_prevista);
        }
    }
    
    public function getDatePT( Array $children ){
        
        if( !empty( $children ) ){

            $termino_prevista = null;
            
            foreach ( $children as $i => $v ){
                
                if( isset( $v['Atividade'] ) ){ $v = $v['Atividade']; }

                if( is_null( $v['data_cancelamento'] ) || empty( $v['data_cancelamento'] ) ){
                    
                    if( is_null($v['data_prevista_termino']) || empty( $v['data_prevista_termino'] ) ){

                        return null;
                        
                    }else{
                        
                        $r = str_replace('/', '-', $v['data_prevista_termino']);
                        if( is_null( $termino_prevista ) ){

                            $termino_prevista = $r;

                        } else if( strtotime( $termino_prevista ) < strtotime( $r ) ) {

                            $termino_prevista = $r;
                        }
                    }
                }
            }
            return str_replace('-', '/', $termino_prevista);
        }
    }
    
    public function getPercentualParent( Array $atividades_children, $duracao_parent ){
        
        if( !empty( $atividades_children ) ){

            $perc = 0;
            $sla  = intval( $duracao_parent );
            
            if( $sla === 0 ){return 0;}
            
            foreach( $atividades_children as $i => $v ){
                
                if( isset($v['Atividade']) ){ $v = $v['Atividade']; }
                
                $perc += (floatval( $v['percentual_conclusao'] ) * intval( $v['duracao'] ) / $sla );
            }
            
            $total = round( $perc, 2 );   
            return $total;
        }        
    }    
    
//-----------Edit by furious------------//    
}
