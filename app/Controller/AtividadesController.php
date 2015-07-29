<?php

App::uses('AppController', 'Controller');

class AtividadesController extends AppController {

    public function index(){
/*
        $usuariologado_id    = $this->Session->read('UserAuth.Usuario.id');
        $grupologado_id      = $this->Session->read('UserAuth.Grupo');
        $grupo_in            = array();
        
        if( count( $grupologado_id ) > 0 ){
            
            foreach ( $grupologado_id as $grupo ){
                
                $grupo_in[] = $grupo['id'];
            }
        }
*/       
        $default_filter = '[{"id":"Atividade.usuario_id","type":"select","val":"'.
                $this->UserAuth->getUsuarioId().'","entity":"Usuario"},{"id":"Demanda.grupo_id","type":"select","val":'.
                $this->UserAuth->getGroupsIds().',"entity":"Grupo"},{"id":"StatusAtividade.id","type":"select","val":["1","2","3","4"],"entity":"StatusAtividade"}]';
        
        $not_in  = $this->Atividade->find('list',array(

                        'fields'    => 'parent_id',
                        'conditions'=> array('Atividade.parent_id <>' => null),
                        'group'     => 'parent_id',
                        'recursive' => -1
                  ));

        $parametros = (isset( $this->Session->read('filters_grid')['atividades'] ))?$this->Session->read('filters_grid')['atividades']:"";
        
        if( empty( $parametros ) ){
            
            $parametros = json_decode( $default_filter, true );
        }
        
        $rs  = $this->getParamsUrl( $parametros );
        
        $opt = array(
                       
            "joins" => array(
                
                    array(
                        
                        "table"         => "demandas",
                        "alias"         => "Demanda",
                        "type"          => "INNER",
                        "conditions"    => array( "Demanda.id = Atividade.demanda_id" )
                    ),
                    array(
                        
                        "table"         => "etapas",
                        "alias"         => "Etapa",
                        "type"          => "INNER",
                        "conditions"    => array( "Etapa.id = Atividade.etapa_id" )
                    ),
                    array(
                        
                        "table"         => "usuarios",
                        "alias"         => "AtividadeUsuario",
                        "type"          => "LEFT",
                        "conditions"    => array( "AtividadeUsuario.id = Atividade.usuario_id" )
                    ),
                    array(
                        
                        "table"         => "usuarios",
                        "alias"         => "DemandaUsuario",
                        "type"          => "INNER",
                        "conditions"    => array( "DemandaUsuario.id = Demanda.usuario_id" )
                    ),
                    array(
                        
                        "table"         => "status_atividades",
                        "alias"         => "StatusAtividade",
                        "type"          => "LEFT",
                        "conditions"    => array( "StatusAtividade.id = Atividade.status_atividade_id" )
                    )
             ),
            'fields' => array(
                
                'Atividade.id',
                'Atividade.demanda_id',
                'Demanda.nome',
                'DemandaUsuario.first_name',
                'Atividade.nome',
                'AtividadeUsuario.first_name',
                'Atividade.data_real_inicio',
                'Atividade.data_real_termino',
                'Atividade.data_prevista_inicio',
                'Atividade.data_prevista_termino',
                'Atividade.data_cancelamento',
                'StatusAtividade.nome',
                'StatusAtividade.cor',
                'Etapa.duracao',
                'Etapa.milestone',
                'Atividade.percentual_conclusao'
                
            ),
            'conditions' => array(
                
                //'Atividade.data_real_termino' => null,
                //'Atividade.data_cancelamento' => null,
                'Atividade.id <>' => $not_in,
                $rs
/*                
                'or' => array(
                    
                    'Atividade.usuario_id' => $usuariologado_id,
                    
                    'and' => array(
                        
                        'Demanda.grupo_id'     => $grupo_in,
                        'Atividade.usuario_id' => null,
                    )
                )
 */
            ),
            'order'      => array( 'Atividade.data_prevista_inicio'=>'asc' ),
            'limit'      => $this->getParametros()->getParametro('paginator'),
            'recursive'  => -1
                
        );        
        $this->paginate = $opt;

        $minhas = $this->paginate('Atividade');

        $fields = json_encode( $parametros );

        $this->set('fields', $fields);
        $this->set('minhasAtividades', $minhas );
    }

    private function enviaAvisosAtividade($data, $action){
        if (isset($data['Atividade']))
            $data = $data['Atividade'];
        if (isset($data['id']))
            ClassRegistry::init("Aviso")->enviaAvisosAtividade($data['id'], $action);
        else
            foreach ($data as $atividade) {
                if (isset($atividade['Atividade']))
                    $atividade = $atividade['Atividade'];
                ClassRegistry::init("Aviso")->enviaAvisosAtividade($atividade['id'], $action);
            }
    }

    private function add_edit_display(){

        $usuarios   = $this->Atividade->Usuario->find('list');
        $etapas     = $this->Atividade->Etapa->find('list');
        $usuariosEnvolvidos = $usuarios;

        $this->set(compact('usuarios', 'usuariosEnvolvidos', 'etapas'));
    }    

    public function return_json_request_data(){
        
        $this->autoRender = false;
        if ($this->request->is('post') || $this->request->is('put')){

            if (!$this->request->data['Atividade']['id'])
                $this->request->data['Atividade']['id'] = rand(5000, 9999);
            if (isset($this->request->data['Atividade']['children']))
                $this->request->data['Atividade']['children'] = json_decode($this->request->data['Atividade']['children']);
            if (isset($this->request->data['Atividade']['state']))
              
                $this->request->data['Atividade']['state'] = json_decode($this->request->data['Atividade']['state']);
            if (isset($this->request->data['Atividade']['_parentId']))
                $this->request->data['Atividade']['_parentId'] = json_decode($this->request->data['Atividade']['_parentId']);
            return json_encode($this->request->data['Atividade']);
        }
    }

    public function getAtividades(){
        
        $this->autoRender = false;
        
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if( !empty( $this->request->data['demanda'] ) ){
                
                $atividade = $this->Atividade->find('list', array(
                    
                    'conditions' => array('Atividade.demanda_id' => $this->request->data['demanda'] ),
                    'order'      => array('Atividade.ordem' => 'ASC'),
                    
                ));

                echo json_encode( $atividade );
            }
        }
    }
    
    public function edit( $id = null ){
        
        $this->Atividade->id = $id;

        if ($this->request->is('post')) {
            
            $this->request->data['Atividade'] = $this->request->data;
        }
        
        if( $this->request->is('get')) {
            
            if (!$this->Atividade->exists()) {
                
                $this->alert('Atividade '.$id.' inexistente!','error');
                $this->redirect( 'index' );
            }
            $this->request->data = $this->Atividade->findById( $id );
            
            $this->request->data['Atividade']['data_real_inicio'] = implode('/',array_reverse(explode('-',$this->request->data['Atividade']['data_real_inicio'])));
            $this->request->data['Atividade']['data_real_termino'] = implode('/',array_reverse(explode('-',$this->request->data['Atividade']['data_real_termino'])));
            $this->request->data['Atividade']['data_prevista_inicio'] = implode('/',array_reverse(explode('-',$this->request->data['Atividade']['data_prevista_inicio'])));
            $this->request->data['Atividade']['data_prevista_termino'] = implode('/',array_reverse(explode('-',$this->request->data['Atividade']['data_prevista_termino'])));
        }

        $this->set('type_atividade', 'Edit');
        $this->add_edit_display();
        $this->render("add");
    }

    public function delete( $id = null ){
        
        if (!$this->request->is('post')) {
                
            $this->alert('Tipo de requisição não autorizada!','error');
            $this->redirect( 'index' );
        }
        $this->Atividade->id = $id;
        if (!$this->Atividade->exists()) {
                
            $this->alert('Atividade '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }

        if ($this->Atividade->delete()) {
            $this->alert(__('The %s deleted', __('atividade')), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->alert(__('The %s was not deleted', __('atividade')), 'error');
        $this->redirect(array('action' => 'index'));
    }
    
    
    public function checkAviso( $atividade_id, $action ){
        
        $this->loadModel('AvisoEtapa');
        
        $etapa = $this->Atividade->findById( $atividade_id );
        $aviso = $this->AvisoEtapa->findAllByEtapaId( $etapa['Etapa']['id'] );
        
        if( count( $aviso ) > 0 ){
            
            foreach ( $aviso as $i => $v ){
                
                if( $v['Aviso']['action'] == $action ){
                    
                    return $v['Aviso']['action'];
                }
            }
        }
        return false;
    }      

    public function assumir(){
        
        $this->autoRender = false;
        
        if ($this->request->is('post') || $this->request->is('put')){

            $dados['Atividade']['id']                    = $this->request->data['id'];
            $dados['Atividade']['usuario_id']            = $this->UserAuth->getUsuarioId();
            $username                                    = $this->Session->read('UserAuth.Usuario');
            $dados['Atividade']['usuario_nome']          = $username['nome'];
            
            echo json_encode( $dados['Atividade'] );
        }
    }  

    public function avancar(){
        
        if (!$this->request->is('post')) {
                
            $this->alert('Tipo de requisição não autorizada!','error');
            $this->redirect( 'index' );
        }

        $this->request->data['Atividade'] = $this->request->data;
        $this->set('atividade', $this->request->data['Atividade'] );
        $this->render( "avancar" );
    }

    public function delegar_usuario(){
        
        $this->autoRender = false;
        
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if( !empty( $this->request->data['user'] ) ){
                
                $usuarios   = $this->Atividade->Usuario->find('list');
                
                $dados['Atividade']['id']                    = $this->request->data['id'];
                $dados['Atividade']['usuario_id']            = $this->request->data['user'];
                $dados['Atividade']['usuario_nome']          = $usuarios[$this->request->data['user']];

                echo json_encode( $dados['Atividade'] );
            }
        }
    }
    
    public function cancelar_ajax(){
        
        if (!$this->request->is('post')) {
                
            $this->alert('Tipo de requisição não autorizada!','error');
            $this->redirect( 'index' );
        }

        $this->request->data['Atividade'] = $this->request->data;

        $this->render( "cancelar" );
    }    
    
    public function cancelar( $id = null ){
        
        if ($this->request->is('post')){
            
            $this->Atividade->id = $this->request->data['Atividade']['id'];
            if (!$this->Atividade->exists()){
                
                $this->alert('Atividade '.$id.' inexistente!','error');
                $this->redirect( 'index' );
            }            
            $this->request->data['Atividade']['data_cancelamento'] = date('Y-m-d');

            if( $this->Atividade->save( $this->request->data['Atividade'])){
                
                $atividades = $this->Atividade->findById( $this->request->data['Atividade']['id'] );
                $obj_demanda = new DemandasController();

                if( $obj_demanda->updateDemandaByAtividade( $atividades['Atividade']['demanda_id'], $atividades['Atividade']['parent_id'] ) ){
                    
                    $this->alert('Atividade cancelada com sucesso!','success');
                    $this->redirect( 'index' );
                    
                }else{
                    
                    $this->alert('Erro ao atualizar dados na demanda da atividade cancelada. Por favor informe ao suporte!','error');
                    $this->redirect( 'index' );                                
                }                
                
            } else {
                
                $this->alert('Erro ao cancelar atividade!', 'error');
                $this->redirect('index');                
            }
        }
        
        $this->Atividade->id = $id;
        if (!$this->Atividade->exists()){
                
            $this->alert('Atividade '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }
        $atividade = $this->Atividade->findById( $id );
        
        if( !is_null( $atividade['Atividade']['data_cancelamento'] ) ){
            
            $this->alert('Atividade cancelada!','warning');
        }
        $this->set('data_cancelamento',     $atividade['Atividade']['data_cancelamento']);
        $this->set('atividade_id',          $atividade['Atividade']['id']);
        $this->set('motivo_cancelamento',   $atividade['Atividade']['motivo_cancelamento']);
        
        $this->render("cancelar_atividade");
    }


    public function delegar(){
        
        if (!$this->request->is('post')) {
             
            $this->alert('Tipo de requisição não autorizada!','error');
            $this->redirect( 'index' );
        }

        $this->request->data['Atividade'] = $this->request->data;

        $etapa    = $this->Atividade->Etapa->findById( $this->request->data['Atividade']['etapa_id'] );
        $processo = $this->Atividade->Etapa->Processo->findById( $etapa['Etapa']['processo_id'] );

        
        $options['joins'] = array(
            array('table' => 'grupos_usuarios',
                'alias' => 'GrupoUsuario',
                'type' => 'INNER',
                'conditions' => array(
                    'GrupoUsuario.usuario_id = Usuario.id',
                    'GrupoUsuario.grupo_id = '.$processo['Processo']['grupo_id']
                )
            )
        );   
        $usuarios = $this->Atividade->Usuario->find( "list", $options );

        $this->set( 'usuarios' , $usuarios );
        $this->render( "delegar" );
    }
    
    public function delegaAtividade( $id=null ){
        
        $this->Atividade->id = $id;
        
        if( $this->request->is('post') ){

            $this->Atividade->id = $this->request->data['Atividade']['id'];
            
            if (!$this->Atividade->exists()){
                
                $this->alert('Atividade '.$id.' inexistente!','error');
                $this->redirect( 'index' );
            }
            
            $atividades = $this->Atividade->findById( $this->request->data['Atividade']['id'] );
            $atividades['Atividade']['usuario_id'] = $this->request->data['Atividade']['usuario_id'];
            $atividades['Atividade']['data_usuario_assumiu'] = date("Y-m-d H:i:s");
            
            if ($this->Atividade->save( $atividades['Atividade'] )){
                
                $obj_demanda = new DemandasController();

                if( $obj_demanda->updateDemandaByAtividade( $atividades['Atividade']['demanda_id'], $atividades['Atividade']['parent_id'] ) ){
                    
                    $this->alert('Atividade delegada com sucesso!','success');
                    $this->redirect( 'index' );
                    
                }else{
                    
                    $this->alert('Erro ao atualizar dados na demanda da atividade delegada. Por favor informe ao suporte!','error');
                    $this->redirect( 'index' );                                
                }
                
            }else{
                
                $this->alert('Erro ao delegar!','error');
                $this->redirect( 'index' );            
            }
        }
        
        if (!$this->Atividade->exists()){
                
            $this->alert('Atividade '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }        
        $atividade = $this->Atividade->findById( $id );
        
        $options['joins'] = array(
            array('table' => 'grupos_usuarios',
                'alias' => 'GrupoUsuario',
                'type' => 'INNER',
                'conditions' => array(
                    'GrupoUsuario.usuario_id = Usuario.id',
                    'GrupoUsuario.grupo_id = '.$atividade['Etapa']['grupo_id']
                )
            )
        );   
        $usuarios = $this->Atividade->Usuario->find( "list", $options );
        
        $this->request->data = $atividade;
        $this->set( 'usuarios' , $usuarios );
    }
    
    public function editAtividade( $id=null ){
        
        $this->Atividade->id = $id;
        
        if( $this->request->is('post') ){

            $this->Atividade->id = $this->request->data['Atividade']['id'];
            
            if (!$this->Atividade->exists()){
                
                $this->alert('Atividade '.$id.' inexistente!','error');
                $this->redirect( 'index' );
            }

            if ($this->Atividade->save( $this->request->data['Atividade'] )){

                $atividades = $this->request->data;
                
                $obj_demanda = new DemandasController();

                if( $obj_demanda->updateDemandaByAtividade( $atividades['Atividade']['demanda_id'], $atividades['Atividade']['parent_id'] ) ){
                    
                    $this->alert('Atividade editada com sucesso!','success');
                    $this->redirect( 'index' );
                    
                }else{
                    
                    $this->alert('Erro ao atualizar dados na demanda da atividade editada. Por favor informe ao suporte!','error');
                    $this->redirect( 'index' );                                
                }
                
            }else{
                
                $this->alert('Erro ao editada!','error');
                $this->redirect( 'index' );            
            }
        }
        
        if (!$this->Atividade->exists()){
                
            $this->alert('Atividade '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }        
        $atividade = $this->Atividade->findById( $id );
        
        $this->request->data = $atividade;
        
        $this->set('type_atividade', 'Edit');
        $this->add_edit_display();
    }
    
    public function avancarAtividade( $id=null ){
        
        $this->Atividade->id = $id;
        
        if( $this->request->is('post') ){

            $this->Atividade->id = $this->request->data['Atividade']['id'];
            
            if (!$this->Atividade->exists()){
                
                $this->alert('Atividade '.$id.' inexistente!','error');
                $this->redirect( 'index' );
            }
            
            if($this->request->data['Atividade']['percentual_conclusao']=='100'){
                
                $this->request->data['Atividade']['data_real_termino'] = date('d/m/Y');
            }
            $atividade = $this->Atividade->findById( $this->request->data['Atividade']['id'] );
            
            $this->request->data['Atividade']['ordem'] = intval($atividade['Atividade']['ordem']);

            if ($this->Atividade->save( $this->request->data['Atividade'] )){

                $atividades = $this->request->data;
                
                $obj_demanda = new DemandasController();

                if( $obj_demanda->updateDemandaByAtividade( $atividades['Atividade']['demanda_id'], $atividades['Atividade']['parent_id'] ) ){
                    
                    $this->alert('Atividade avançada com sucesso!','success');
                    $this->redirect( 'index' );
                    
                }else{
                    
                    $this->alert('Erro ao atualizar dados na demanda da atividade avançada. Por favor informe ao suporte!','error');
                    $this->redirect( 'index' );                                
                }
                
            }else{
                
                $this->alert('Erro ao avançar!','error');
                $this->redirect( 'index' );            
            }
        }
        
        if (!$this->Atividade->exists()){
                
            $this->alert('Atividade '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }        
        $atividade = $this->Atividade->findById( $id );
        
        $this->request->data['Atividade'] = $atividade['Atividade'];
    }    

    public function assumir_edit($id = null){
        
        $this->Atividade->id = $id;
        
        if (!$this->Atividade->exists()) {
                
            $this->alert('Atividade '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }

        $atividades['Atividade']['id']                   = $id;
        $atividades['Atividade']['usuario_id']           = $this->UserAuth->getUsuarioId();
        $atividades['Atividade']['data_usuario_assumiu'] = date("Y-m-d H:i:s");

        if ($this->Atividade->save($atividades['Atividade'])) {
            
            $atividades = $this->Atividade->findById( $id );
            
            $obj_demanda = new DemandasController();

            if ($obj_demanda->updateDemandaByAtividade($atividades['Atividade']['demanda_id'], $atividades['Atividade']['parent_id'])) {

                $this->alert('Atividade assumida com sucesso!', 'success');
                 return $this->redirect($this->referer());
            } else {

                $this->alert('Erro ao atualizar dados na demanda da atividade assumida. Por favor informe ao suporte!', 'error');
                return $this->redirect('index');
            }
        } else {

            $this->alert('Erro ao assumir!','error');
            
            return $this->redirect($this->referer());
        }
    }      
/*
    public function cancelar_usuario(){
        
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        $this->request->data['Atividade'] = $this->request->data;

        $this->render( "cancelar" );
    }

    public function cancelar(){
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['Atividade']['data_cancelamento'] = date("Y-m-d H:i:s");

            $atividades_sendo_propagadas = $this->Atividade->propagaAcaoSubatividades($this->request->data);
            
            $this->add_edit_post($atividades_sendo_propagadas, "cancelar", array(
                'success' => "A atividade foi cancelada com sucesso.",
                'error' => "A atividade não pôde ser cancelada."
            ));
        }
    }

    public function concluir(){
        
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['Atividade']['data_prevista_termino'] = date("Y-m-d H:i:s");
            $this->request->data['Atividade']['percentual_conclusao'] = 100.00;
            $atividades_sendo_propagadas = $this->Atividade->propagaAcaoSubatividades($this->request->data);
            $this->Atividade->atualizaPercentualConclusaoAtividadesSuperiores($this->request->data['Atividade']['id']);
            $this->Atividade->Demanda->atualizaPercentualConclusaoDemanda($this->request->data['Atividade']['id']);
            $this->add_edit_post($atividades_sendo_propagadas, "concluir", array(
                'success' => "A atividade foi concluída com sucesso.",
                'error' => "A atividade não pôde ser concluída."
            ));
        }
    }

    public function prorrogar(){
        if ($this->request->is('post') || $this->request->is('put')) {

            $atividades_sendo_propagadas = $this->Atividade->propagaAcaoSubatividades($this->request->data, true);
            $this->add_edit_post($atividades_sendo_propagadas, "prorrogar", array(
                'success' => "A atividade foi prorrogada com sucesso.",
                'error' => "A atividade não pôde ser prorrogada."
            ));
        }
    }

    public function subAtividades(&$atividades, $demanda_id, $usuarios){
        if ($atividades)
            foreach ($atividades as $key => $atividade) {
                if ($atividade['Atividade']['demanda_id'] != $demanda_id)
                    unset($atividades[$key]);
                else {
                    if (count($atividades[$key]['children']) > 0) {
                        $this->subAtividades($atividades[$key]['children'], $demanda_id, $usuarios);
                        $atividades[$key]['Atividade']['children'] = $atividades[$key]['children'];
                    } else
                        unset($atividades[$key]['children']);
                    if (isset($atividades[$key]['UsuariosEnvolvidos']))
                        $atividades[$key]['Atividade']['UsuariosEnvolvidos'] = $atividades[$key]['UsuariosEnvolvidos'];
                    $this->Atividade->formataUsuariosEnvolvidos($atividades[$key]['Atividade']);
                    $atividades[$key] = $atividades[$key]['Atividade'];
                    if (isset($atividades[$key]['usuario_id']))
                        $atividades[$key]['usuario_nome'] = $usuarios[$atividades[$key]['usuario_id']];
                    if (isset($atividades[$key]['etapa_id'])) {
                        $this->Atividade->Etapa->id = $atividades[$key]['etapa_id'];
                        $atividades[$key]['duracao'] = $this->Atividade->Etapa->field('duracao');
                    }
                }
            }
    }
 * 
 */
}