<?php

App::uses('AppController', 'Controller');

class DemandasController extends AppController {

    public $paginate = array();

    
    private function checaSeUsuarioLogadoTemAcesso( $demanda ) {
   
        $groupId = $this->UserAuth['Grupo']['id'];

        
        if ( !$this->UserAuth->isAdmin() && !$this->Demanda->usuarioTemAcesso( $groupId, $demanda['Demanda']['id'] ) ) {
            
            $this->alert('Você não tem acesso a este demanda', 'error');
            $this->redirect('index');
        }
    }

    private function getNomesDeUsuario(&$demandas) {
        foreach ($demandas as $key => $demanda) {
            $this->Demanda->Usuario->id = $demanda['usuario_id'];
            $this->Demanda->Processo->id = $demanda['processo_id'];
            $demandas[$key]['Usuario']['first_name'] = $this->Demanda->Usuario->field("first_name");
            $demandas[$key]['Processo']['duracao'] = $this->Demanda->Processo->field("duracao");
            $demandas[$key]['Processo']['nome'] = $this->Demanda->Processo->field("nome");
        }
    }

    private function somenteEstruturasDaDemanda($estruturaCompleta) {
        $outrasDemandas = $estruturaCompleta['DemandasEnvolvidas'];
        $this->Demanda->getSubArraysWithThisKey($estruturaCompleta, "Demanda", $outrasDemandas);
        $this->getNomesDeUsuario($outrasDemandas);
        $this->Demanda->array_multisort_fields($outrasDemandas, array("data_prevista_termino", "percentual_conclusao"), array(SORT_ASC, SORT_DESC));
        $outrasDemandas = array_map("unserialize", array_unique(array_map("serialize", $outrasDemandas)));
        $this->atividadesEmAndamento($outrasDemandas);
        $this->datasMilestones($outrasDemandas);
        return $outrasDemandas;
    }

    private function atividadesEmAndamento( &$demandas ) {
        foreach ($demandas as &$demanda) {
            $demanda_id = (isset($demanda['Demanda'])) ? $demanda['Demanda']['id'] : $demanda['id'];
            $atividades = $this->Demanda->Atividade->findAllByDemandaIdAndDataCancelamentoAndDataConclusao($demanda_id, null, null);
            $demanda['Demanda']['atividades_andamento'] = '';
            foreach ($atividades as $atividade) {
                if ($atividade['Atividade']['data_usuario_assumiu']) {
                    $atividade_andamento = $atividade['Atividade']['nome'];
                    if (isset($atividade['ParentAtividade']['nome']))
                        $atividade_andamento = $atividade['ParentAtividade']['nome'] . " >> " . $atividade_andamento;
                    $demanda['Demanda']['atividades_andamento'] .= $atividade_andamento;
                }
            }
            if (empty($demanda['Demanda']['atividades_andamento'])) {
                $demanda['Demanda']['atividades_andamento'] = $atividades[0]['Atividade']['nome'];
            }
        }
    }

    private function datasMilestones(&$demandas) {
        foreach ($demandas as &$demanda) {
            $demanda_id = (isset($demanda['Demanda']['id'])) ? $demanda['Demanda']['id'] : $demanda['id'];
            $processo_id = (isset($demanda['Demanda']['processo_id'])) ? $demanda['Demanda']['processo_id'] : $demanda['processo_id'];
            $milestones = $this->Demanda->Atividade->Etapa->find('all', array('conditions' => array(
                    'Etapa.processo_id' => $processo_id,
                    'Etapa.milestone' => 1
                ), 'order' => array('Etapa.ordem' => 'ASC')));
            foreach ($milestones as $milestone) {
                $atividade = $this->Demanda->Atividade->findByEtapaIdAndDemandaId($milestone['Etapa']['id'], $demanda_id);
                $demanda['Milestone'][$atividade['Atividade']['nome']] = $atividade['Atividade']['data_prevista_termino'];
            }
        }
    }

    public function por_processo() {
        
        if (!$this->UserAuth->isAdmin()) {
            $this->alert('Você não tem permissão para acessar esta página.', 'error');
            $this->redirect(array('action' => 'index'));
        }
        
        $demandas = $this->Demanda->findAllByDataCancelamentoAndDataConclusao(null, null);
        $this->atividadesEmAndamento($demandas);
        $this->datasMilestones($demandas);
        
        $demandas_por_processo = "";
        
        if ( is_array( $demandas ) ){

            foreach ($demandas as $demanda) {
                
                $demandas_por_processo[$demanda['Processo']['nome']][] = $demanda;
            }
        }
        $this->set('demandas_por_processo', $demandas_por_processo);
    }

    public function index( $processo_id = null ) {

        $val = $this->createJson( (isset($this->params['url']['k']))?$this->params['url']['k']:"" );
        $rs  = $this->getParamsUrl( $val );

        $opt = array(
            
            'conditions' => ( !$rs ) ? array( 'Demanda.id > ' => 0 ) : $rs,
            'limit'      => 15
        );
        
        if (isset($processo_id)){
            
            $opt['conditions']['Demanda.processo_id'] = $processo_id;
        }
        
        $this->paginate = $opt;
        
        $fields = json_encode( $val );
        
        $this->Demanda->recursive = 0;

        $obj_demanda = $this->paginate( 'Demanda' );

        $demanda = $this->Demanda->makeColl( $obj_demanda );
        
        $this->set( 'demandas', $demanda );
        $this->set( 'fields', $fields );

        if (isset($processo_id)){
            $this->set('processo_id', $processo_id);
        }

    }

    public function view( $id = null ){
        
        $this->Demanda->id = $id;
        if (!$this->Demanda->exists()) {
            throw new NotFoundException(__('Invalid %s', __('demanda')));
        }
        
        $this->request->data = $this->Demanda->findById( $id );      
        
        if( $this->request->is( "post" ) || $this->request->is( "put" ) ){
            
            debug( $this->request->data );
        }
        
        $this->add_edit_display();
        
        //debug( $this->request->data );
        $this->Demanda->formataMultiplosUsuariosEnvolvidos( $demanda['Atividade'] );
        
        $this->set( 'demanda', $this->request->data );
        $this->set( 'demanda_id', $id );
        $this->set( 'type', 'Edit' );
        $this->render( "add" );
    }

    private function encontraFolhas($atividades, &$folhas) {
        if (is_array($atividades)) {
            foreach ($atividades as $key => $atividade) {
                if (isset($atividade['children']) && count($atividade['children'])) {
                    $this->encontraFolhas($atividade['children'], $folhas);
                } else {
                    $folhas[] = $atividade;
                }
            }
        }
    }

    private function dataFolhas(&$folhas, $data_inicio_demanda){
        
        $data_inicio = $data_inicio_demanda;
        $duracao_etapas_anteriores = 0;
        
        foreach ($folhas as $key => $folha) {
            
            if (!$folha['data_inicio']) {
                
                if (!isset($folha['tbd']) || !$folha['tbd']){
                    
                    $folhas[$key]['data_inicio'] = $data_inicio;
                    
                    if ($this->Demanda->Atividade->Etapa->considerar_apenas_dias_uteis($folha['etapa_id']))
                        $folhas[$key]['data_prevista_termino'] = ClassRegistry::init('DiaUtil')->somar_dias_uteis($data_inicio, $folha['duracao']);
                    else
                        $folhas[$key]['data_prevista_termino'] = ($data_inicio) ? date('Y-m-d', strtotime('+' . $folha['duracao'] . ' days', strtotime($data_inicio))) : null;
                } else {
                    $folhas[$key]['data_inicio'] = $folhas[$key]['data_prevista_termino'] = null;
                }
            }
            
            $folhas[$key]['duracao_etapas_anteriores'] = $duracao_etapas_anteriores;
            $data_inicio = $folhas[$key]['data_prevista_termino'];
            $duracao_etapas_anteriores += $folha['duracao'];
        }
    }

    private function duracaoTotal($atividades) {
        $duracaoTotal = 0;
        foreach ($atividades as $atividade) {
            $duracaoTotal += $atividade['duracao'];
        }
        return $duracaoTotal;
    }

    public $num_folha = 0;

    private function dataSuperiores(&$atividades, $folhas, $processo_id, $ordem) {
        if( empty( $atividades ) ){return false;}
        foreach ($atividades as &$atividade) {
            if (isset($atividade['children']) && count($atividade['children'])) {
                $this->dataSuperiores($atividade['children'], $folhas, $processo_id, $ordem);

                $num_filhos = count($atividade['children']);
                $atividade['data_inicio'] = $atividade['children'][0]['data_inicio'];
                $atividade['data_prevista_termino'] = $atividade['children'][$num_filhos - 1]['data_prevista_termino'];
                $atividade['duracao'] = $this->duracaoTotal($atividade['children']);
                $atividade['duracao_etapas_anteriores'] = $atividade['children'][0]['duracao_etapas_anteriores'];
            } else {
                $atividade = $folhas[$this->num_folha];
                $this->num_folha++;
            }

            $atividade['ordem'] = $ordem[$atividade['id']];

            unset($atividade['_parentId']);
            if ($atividade['id'] > 5000)
                unset($atividade['id']);
        }
    }

    private function criaNovoProcesso($demanda) {
        $this->Demanda->Processo->save(array(
            'nome' => $demanda['nome'],
            'descricao' => $demanda['descricao'],
            'grupo_id' => $this->Demanda->Usuario->getPrimeiroGrupo($demanda['usuario_id']),
            'ativo' => 0
        ));
        return $this->Demanda->Processo->id;
    }

    private function salvaAtividades($atividades, $demanda_id, $parent_id = null) {
        
        if( empty( $atividades ) ){return false;}
        foreach ($atividades as &$atividade) {

            $atividade['demanda_id'] = $demanda_id;
            $atividade['parent_id']  = $parent_id;
            $this->Demanda->Atividade->create();
            
            if (!$this->Demanda->Atividade->saveAssociated($atividade))
                $this->alert('A atividade ' . $atividade['nome'] . ' não pode ser salva', 'error');
            if (isset($atividade['children']))
                $this->salvaAtividades($atividade['children'], $demanda_id, $this->Demanda->Atividade->id);
        }
    }

    private function unsetDatas(&$atividades) {
        foreach ($atividades as &$atividade) {
            if (!isset($atividade['data_usuario_assumiu'])) {
                unset($atividade['data_inicio']);
                unset($atividade['data_prevista_termino']);
                if (isset($atividade['children']))
                    $this->unsetDatas($atividade['children']);
            }
        }
    }

    private function add_edit_post( &$data, $action, $mensagens ) {
        
        if( empty( $data ) ){ return false; }

        $data['Atividade'] = json_decode( $data['Demanda']['atividades_json'], true );
        $ordem = array_flip( json_decode( $data['Demanda']['atividades_ordem'], true ) );
        unset($data['Demanda']['atividades_json']);
        unset($data['Demanda']['atividades_ordem']);
        if ($data['Demanda']['propaga_datas']){ $this->unsetDatas($data['Atividade']); }
        //if (!isset($data['Demanda']['processo_id'])) $data['Demanda']['processo_id'] = $this->criaNovoProcesso($data['Demanda']);
        $folhas = array();
        $this->encontraFolhas($data['Atividade'], $folhas);
        $this->dataFolhas($folhas, $data['Demanda']['data_inicio']);
        $this->num_folha = 0;
        $this->dataSuperiores($data['Atividade'], $folhas, $data['Demanda']['processo_id'], $ordem);

        $atividades = $data['Atividade'];
        unset($data['Atividade']);

        $duracaoTotal = $this->duracaoTotal($folhas);
        //$this->Demanda->Processo->id = $data['Demanda']['processo_id'];
        //$this->Demanda->Processo->saveField('duracao',$duracaoTotal);
        $data['Demanda']['data_prevista_termino'] = $atividades[count($atividades) - 1]['data_prevista_termino'];

        if ($this->Demanda->saveAll($data, array('deep' => true))) {
            
            $this->salvaAtividades($atividades, $this->Demanda->id);
            //ClassRegistry::init("Aviso")->enviaAvisosDemanda($this->Demanda->id,$action);
//---------------Chamada do metodo de adição de log-------------------

            $this->getLogevent()->createLog(
                    
                    $this->UserAuth->getUsuarioId(),
                    'Demanda', 
                    $action, 
                    $data['Demanda']['incident'] . $this->Demanda->getLastInsertId()
            );

//---------------Chamada do metodo de adição de log-------------------            

            $this->alert($mensagens['success'], 'success');
            $this->redirect(array('action' => 'edit', $this->Demanda->id));
        }
        //$this->Demanda->Processo->delete();
        $this->alert($mensagens['error'], 'error');
        $this->redirect(array('action' => 'index'));
    }

    private function add_edit_display() {

        
        $processos          = $this->Demanda->Processo->find('list', array('conditions' => array('Processo.ativo' => 1)));
        $grupos             = $this->Demanda->Grupo->find('list', array( 'order' => array( 'Grupo.nome' => 'ASC' ) ));
        $etapas             = $this->Demanda->Atividade->Etapa->find('list');
        $usuariosEnvolvidos = $this->Demanda->UsuariosEnvolvidos->find('list', array('order' => array('UsuariosEnvolvidos.first_name' => 'ASC')));

        $this->set( compact( 'processos', 'usuariosEnvolvidos', 'grupos', 'etapas' ) );
    }

    public function add( $processo_id = null ){

        if ($this->request->is('post') || $this->request->is('put')){
            
            $this->Demanda->create();
            $this->request->data['Demanda']['incident'] = "Demanda do processo gravada com ID: ";
            $this->add_edit_post($this->request->data, "add", array(
                'success' => "O demanda foi criado com sucesso.",
                'error' => "O demanda não pôde ser criado."
            ));
        }
        $this->request->data['Demanda']['processo_id'] = $processo_id;
        $this->set('type', 'Add');
        $this->set('demanda_id', '');
        $this->add_edit_display();
    }

    public function edit( $id = null ) {
        
        $this->Demanda->id = $id;
        
        
        
        if (!$this->Demanda->exists()) {
            throw new NotFoundException(__('Invalid %s', __('demanda')));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
                        
            $this->request->data['Demanda']['incident'] = "Demanda do processo editado com ID: " . $id;

            $this->add_edit_post( $this->request->data, "edit", array(
                'success' => "O demanda foi atualizado com sucesso.",
                'error' => "O demanda não pôde ser atualizado."
            ));
        }
        
        $this->Demanda->contain(array("Processo", "Grupo", "UsuariosEnvolvidos", "Arquivo" => array("Usuario", "CategoriaArquivo"), "Atividade" => array("Etapa", "Usuario", "UsuariosEnvolvidos" => array('fields' => array('id')))));
        $this->request->data = $this->Demanda->findById( $id );
        $this->Demanda->formataMultiplosUsuariosEnvolvidos( $this->request->data['Atividade'] );
        
        $date_ini = implode("/", array_reverse(explode("-", $this->request->data['Demanda']['data_inicio'])));
        $date_ter = implode("/", array_reverse(explode("-", $this->request->data['Demanda']['data_prevista_termino'])));

        $this->request->data['Demanda']['data_inicio'] = $date_ini;
        $this->request->data['Demanda']['data_prevista_termino'] = $date_ter;

        $this->set( 'demanda', $this->request->data );
        $this->set( 'demanda_id', $id );
        $this->set( 'type', 'Edit' );

        $this->add_edit_display();
        $this->render("add");
    }

    public function cancelar(){
 
        if ( $this->request->is('post') || $this->request->is('put') ){

            $this->Demanda->id = $this->request->data['Demanda']['id'];

            if ( !$this->Demanda->exists() ) {
                throw new NotFoundException(__('Invalid %s', __('demanda')));
            }

            $this->request->data['Demanda']['data_cancelamento'] = date('Y-m-d H:i:s');
            $this->request->data['Demanda']['incident'] = "Demanda do processo cancelado com ID: " . $this->request->data['Demanda']['id'];
            
            if( $this->Demanda->save( $this->request->data ) ){
                
                $this->Demanda->cancelaAtividades( $this->request->data['Demanda']['id'] );

//---------------Chamada do metodo de adição de log-------------------

                $this->getLogevent()->createLog(

                        $this->UserAuth->getUsuarioId(), 
                        'Demanda', 
                        'cancelar', 
                        $this->request->data['Demanda']['incident']
                );

//---------------Chamada do metodo de adição de log-------------------                
                
                $this->set( 'demanda', $this->request->data );
                $this->redirect( array('action' => 'index') );
                
            } else {
                
                $this->redirect( array('action' => 'index') );
            }
            
        } else {
            
            $this->redirect( array('action' => 'index') );
        }
        
    }

    public function concluir() {
        if ($this->request->is('post') || $this->request->is('put')) {
            
            $this->request->data['Demanda']['data_conclusao'] = date("Y-m-d H:i:s");
            $this->request->data['Demanda']['incident'] = "Demanda do processo concluido com ID: " . $this->request->data['Demanda']['id'];
            
            $demanda_com_atividades_sendo_propagadas = $this->Demanda->Atividade->propagaAcaoAtividadesDeDemanda($this->request->data);
            $this->add_edit_post($demanda_com_atividades_sendo_propagadas, "concluir", array(
                'success' => "O demanda foi concluido com sucesso.",
                'error' => "O demanda não pôde ser concluido."
            ));
        }
    }

    public function prorrogar() {
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $demanda_com_atividades_sendo_propagadas = $this->Demanda->Atividade->propagaAcaoAtividadesDeDemanda($this->request->data, true);
            
            $this->request->data['Demanda']['incident'] = "Demanda do processo prorrogado com ID: " . $this->request->data['Demanda']['id'];
            
            $this->add_edit_post($demanda_com_atividades_sendo_propagadas, "prorrogar", array(
                'success' => "O demanda foi prorrogado com sucesso.",
                'error' => "O demanda não pôde ser prorrogado."
            ));
        }
    }
}
