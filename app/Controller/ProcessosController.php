<?php

App::uses('AppController', 'Controller');
App::uses('Demanda', 'Model');
App::uses('Parametro', 'Model');


class ProcessosController extends AppController {

    /** 
     * Variável Que define uma parametrização inicial. * 
     * @access protected 
     * @name $default_filter 
     **/ 
    
    protected $model;
   
    public function index(){
        
        $this->checaSeUsuarioLogadoTemAcesso('index');
        
        $this->model = new Parametro();
   
        $parametros = (isset( $this->Session->read('filters_grid')['processos'] )) ? $this->Session->read('filters_grid')['processos'] : "";
        
        if(empty($parametros))
        {
            $parametros = json_decode( $this->Processo->padraoJsonFiltro() , true );
        }        

        $condition = ( !$this->getParamsUrl($parametros) ) ? array( 'Processo.id > ' => 0 ) : $this->getParamsUrl($parametros);
        
        
        $opt = $this->Processo->OptionsArrayPaginateIndex($condition);
        $this->paginate = $opt;

        $processos = $this->paginate( 'Processo' );
        
        $this->set( 'processos', $processos );
        $this->set( 'fields', json_encode( $parametros ) );
    }
    
    
    public function add_edit($id = null){
    
        $this->checaSeUsuarioLogadoTemAcesso('add_edit',$id);   
        
     if ($this->request->is(array('post', 'put') )){
         
           $this->Processo->create();
            
         if(empty($id)){
   
            $this->request->data['Processo']['versao']   = 1;

            $etapas = json_decode( $this->request->data['Processo']['etapas_json'], true );

            $folhas = array();
            $this->Processo->encontraFolhas( $etapas, $folhas );

            $duracaoTotal = $this->Processo->duracaoTotal( $folhas );
            
            $duracao = ( empty( $duracaoTotal )) || is_null( $duracaoTotal ) ? '0' : $duracaoTotal;
            
            $this->request->data['Processo']['duracao'] = $duracao;
            $this->request->data['Processo']['_parent'] = null;

            if( $this->Processo->saveAll(  $this->request->data, array( 'deep' => true ) ) ){

                $this->salvaEtapas( $etapas, $this->Processo->id, null, $this->request->data['Processo']['grupo_id'] );
                $this->alert('Processo Cadastrado com sucesso');
                $this->redirect( 'index' );
            }else{
                $this->alert('Processo não pode ser cadastrado com sucesso');
                $this->redirect( 'index' );
            }
            
            
        }else{  // edit
            
           $this->Processo->id = $id;
        if (!$this->Processo->exists()){

            $this->alert('Processo '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }
 
        $demandas = $this->Processo->DadosDemandaProcesso($id);

        debug($demandas);
        
            if( empty( $demandas ) || count( $demandas ) == 0 ){

                $etapas = json_decode( $this->request->data['Processo']['etapas_json'], true );

                $folhas = array();
                $this->Processo->encontraFolhas( $etapas, $folhas );

                $duracao = ( empty($this->duracaoTotal( $folhas )) || is_null( $this->duracaoTotal( $folhas )) ) ? '0' : $this->duracaoTotal( $folhas );
                $this->request->data['Processo']['duracao'] = $duracao;

                if( $this->Processo->saveAll(  $this->request->data, array( 'deep' => true ) ) ){

                    $this->salvaEtapas( $etapas, $this->Processo->id, null, $this->request->data['Processo']['grupo_id'], 'Edit' );
                    $this->redirect( 'index' );
                }

		}else{

                $parentProcess = $this->Processo->findById( $id );

                $versoes = ( count( $parentProcess ) > 0 ) ? intval($parentProcess['Processo']['versao']) + 1 : 2;

                $this->request->data['Processo']['versao']  = $versoes;
                $this->request->data['Processo']['id']      = null;
                $this->request->data['Processo']['_parent'] = $id;

                $etapas = json_decode( $this->request->data['Processo']['etapas_json'], true );

                $folhas = array();
                $this->Processo->encontraFolhas( $etapas, $folhas );

                $this->Processo->cleanID( $etapas );

				
				               $duracao = ( empty($this->Processo->duracaoTotal( $folhas )) || is_null( $this->Processo->duracaoTotal( $folhas )) ) ? '0' : $this->duracaoTotal( $folhas );
                $this->request->data['Processo']['duracao'] = $duracao;

                $this->Processo->create();

                if( $this->Processo->saveAll(  $this->request->data, array( 'deep' => true ) ) ){

                    $this->salvaEtapas( $etapas, $this->Processo->id, null, $this->request->data['Processo']['grupo_id'] );

                    $parentProcess['Processo']['ativo'] = 0;
                    $this->Processo->save( $parentProcess['Processo'] );

                    $this->redirect( 'index' );
                }
            }
  
        }
        
        
     }else{
            //View
            
            if(empty($id)){
                $this->set( 'children', '0' );
                $this->set('type', 'Add');
                $this->set('processo_id', '');
                $this->add_edit_display();
            }else{
                $child = ($this->checkprocessochildren( $id ))?'1':'0';
                $this->request->data = $this->Processo->findById( $id );
                $this->set( 'children', $child );
                $this->set( 'processo', $this->request->data );
                $this->set( 'processo_id', $id );
                $this->set( 'type', 'Edit' );
                $this->add_edit_display();
                $this->render("add");
            }
 
        
        }
        
    }
     
    public function edit($id = null)
    {
        $this->add_edit($id);
    }

    public function add()
    {
        $this->add_edit();
    }

    
    private function checaSeUsuarioLogadoTemAcesso( $processo_id ){
        
        if (!$this->UserAuth->isAdmin() && !$this->Processo->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $processo_id)) {
            $this->alert('Você não tem acesso a este processo.', 'error');
            $this->redirect('index');
        }
    }

    public function ajax_usuarios_do_grupo_do_processo($processo_id = null) {
        
        if ( $processo_id ){
            $this->Processo->id = $processo_id;
            $this->Processo->Grupo->contain(array("Usuario"));
            $grupo = $this->Processo->Grupo->findById($this->Processo->field('grupo_id'));

            foreach ($grupo['Usuario'] as $key => $usuario) {
                $options[$usuario['id']] = $usuario['first_name'] . " " . $usuario['last_name'];
            }
        } else
            $options = ClassRegistry::init("Usuario")->find('list', array('order' => array('Usuario.first_name' => 'ASC')));
        $this->set('options', $options);
        $this->render('/Elements/ajax_dropdown');
    }

    
    private function add_edit_display(){
        
        $grupos = $this->Processo->Grupo->getListGruposTemAcesso($this->UserAuth->getUsuarioId());
        $processos = $this->Processo->getActiveProcesses();
        $this->set(compact('grupos','processos'));
    }
    
    private function salvaEtapas( &$etapas, $processo_id, $parent_id = NULL, $grupo_id = null, $action="Add" ){//08
        
        $ordem = 0;
        foreach ( $etapas as $i => $etapa ){
            
            $etapa['processo_id'] = $processo_id;
            $etapa['parent_id']   = $parent_id;
            $etapa['grupo_id']   = ( !empty( $etapa['grupo_id'] ) ) ? $etapa['grupo_id'] :  $grupo_id;
            $etapa['ordem']       = $ordem++;

            if( $action === "Add" ){
                
                $this->Processo->Etapa->create();
            }
            
            $this->Processo->Etapa->saveAssociated( $etapa );           
            if ( isset( $etapa['children'] ) ){

                $this->salvaEtapas( $etapa['children'], $processo_id, $this->Processo->Etapa->id, $etapa['grupo_id'], $action );
            }
        }
    } 

    public function desativar($id = null) {
        $this->Processo->id = $id;
        if (!$this->Processo->exists()) {
            
            $this->alert('Processo '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }
        $this->checaSeUsuarioLogadoTemAcesso($id);
        if ($this->Processo->saveField('ativo', 0)){
                
            $this->alert("O processo foi desativado.", 'success');
        }
        $this->redirect( 'index' );
    }

    public function ativar( $id = null ) {
        
        $this->Processo->id = $id;
        if (!$this->Processo->exists()) {
            
            $this->alert('Processo '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }
        $this->checaSeUsuarioLogadoTemAcesso($id);
        if ($this->Processo->saveField('ativo', 1)){
                
            $this->alert("O processo foi ativado.", 'success');
        }
        $this->redirect( 'index' );
    }

    public function delete($id = null) {
        
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        
        $this->Processo->id = $id;
        if (!$this->Processo->exists()){
            
            $this->alert('Processo '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }

        if ( $this->Processo->delete() ){
                
            $this->alert("O processo foi excluído com sucesso!", 'success');
        } else {
            $this->alert("O processo não pode ser excluído!", 'error');

        }
        $this->redirect( 'index' );
    }


    public function getSugestaoDemandaNome(){
        
        $this->autoRender = false;
        
        if( $this->request->data['processo_id'] ){
            
            $sugestao_demanda   = $this->Processo->find('all',array(
                'fields'        => 'sugestao_demanda',
                'conditions'    => array( 'Processo.id' => $this->request->data['processo_id'] ),
                'recursive'     => -1,
            ));
            
            if(count($sugestao_demanda) > 0){
                
                echo json_encode($sugestao_demanda[0]['Processo']['sugestao_demanda']);
            }else{
                echo json_encode('');
            }
        }
    }

    public function createChild( &$etapas, $processo_id ){
        
        if ( !$etapas ){ return false; }
        
        foreach ($etapas as $key => $etapa){
            
            if ( $etapa['Etapa']['processo_id'] != $processo_id ){
                
                unset( $etapas[$key] );
                
            } else {
                
                if ( count( $etapas[$key]['children'] ) > 0 ) {
                    
                    $this->createChild( $etapas[$key]['children'], $processo_id ); 
                    $etapas[$key]['Etapa']['children'] = $etapas[$key]['children'];
                    
                } else {
                    
                    unset($etapas[$key]['children']);
                }
                $etapas[$key] = $etapas[$key]['Etapa'];
            }
        }
    }
    
    public function setSLAinDate(){
        
        $this->autoRender = false;
        
        $date  = $this->request->data['date'];
        $sla   = intval( $this->request->data['sla'] );
        
        $data = $this->Processo->somar_dias_uteis($date, $sla, '');
        return json_encode($data);
    }
    
    public function getGrupo(){//22
        
        $this->autoRender = false;
        if( empty($this->request->data['processo_id']) ){return false;}
        
        $processo = $this->Processo->find( 'all', array(
            'conditions' => array( 'Processo.id' => $this->request->data['processo_id'] )
            )
        );
        echo json_encode($processo[0]['Grupo']);
    }
    
    public function checkchildren(){//23
        
        $this->autoRender = false;
        
        if( !isset( $this->request->data['processo_id'] ) ){return false;}

        $processo_children = $this->Processo->find( 'all', array(
            
                'recursive'  => -1,
                'conditions' => array(
                    
                    'Processo._parent' => $this->request->data['processo_id'] 
                ) 
            )
        );
        
        if( count( $processo_children ) > 0 ){
            
            echo json_encode( 'true' );
        } else {
            echo json_encode( 'false' );
        }
    }
    
    private function checkprocessochildren( $processo_id ){//23
        
        $this->autoRender = false;

        $processo_children = $this->Processo->find( 'all', array(
            
                'recursive'  => -1,
                'conditions' => array(
                    
                    'Processo._parent' => $processo_id 
                ) 
            )
        );
        
        if( count( $processo_children ) > 0 ){
            
            return true;
        } else {
            return false;
        }
    } 
}
