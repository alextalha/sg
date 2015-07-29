<?php

App::uses('AppController', 'Controller');

class MenusController extends AppController {

    public function index() {      
    }

    public function controller_list_menu() {
        $this->ControllerList = $this->Components->load('ControllerList');
        $allControllers = $this->ControllerList->getSemPlugin();
        foreach ($allControllers as $controller => $actions)
            if (in_array("add", $actions) && in_array("index", $actions))
                $controllers[] = $controller;

        return $controllers;
    }

    public function menu() {
        
        $this->Menu->recursive = 0;
        return $this->Menu->find('threaded', array( 'order' => array( 'Menu.ordem' => 'ASC' ) ));
    }

    public function elementos_menu($elemento = "Relatorio") {
        $method = "get" . $elemento . "sDeUsuario";
        return ClassRegistry::init($elemento)->$method($this->UserAuth->getUsuarioId());
    }

    public function bpm_menu() {
        
        $diretorio = WWW_ROOT . DS . 'bpm';
        $subdiretorios = array();
        
        if (is_dir($diretorio)) {
            
            foreach (glob($diretorio . '/*', GLOB_ONLYDIR) as $dir) {
                
                $subdiretorios[] = basename( $dir );
            }
        }
        
        if ( !is_dir( $diretorio ) || !$subdiretorios ) {
            
            $this->alert("Não há diagramas BPM disponíveis.", 'error');
        }
        return $subdiretorios;
    }

    public function perfil() {
        return array(
            "Meu Perfil" => "/perfil", "Alterar Senha" => "/usuarios/alterar_senha"
        );
    }

    private function subMenus(&$menus) {
        
        if ( $menus ){
            
            foreach ( $menus as &$menu ) {
                
                if (count($menu['children']) > 0) {
                    
                    $this->subMenus( $menu['children'] );
                    $menu['Menu']['children'] = $menu['children'];
                    
                } else {
                    
                    unset($menu['children']);
                }
                $menu = $menu['Menu'];
            }
        }
    }
    
    private function criaMenus( &$menus ){

        if( empty( $menus ) ){ return false; }
        
        $meni = array();

            foreach ($menus as $menu){
                
                $meni = array(
                    
                    'id'          => $menu['id'],
                    'nome'        => $menu['nome'],
                    'descricao'   => $menu['descricao'],
                    'url'         => $menu['url'],
                    'ordem'       => $menu['ordem'],
                    
                );
                
                if (isset( $menu['children'] ) ) {
                    
                    $meni['children'] = $this->criaMenus( $menu['children'] );
                }
                $menis[] = $meni;
            }
        return $menis;
    }    

    public function ajax_treegrid() {
        
        $this->autoRender = false;       
        $menus = $this->Menu->find('threaded', array('order' => array('Menu.ordem' => 'ASC')));
    
        if ( count( $menus ) ) {
            $this->subMenus( $menus );
            $menis = $this->criaMenus( $menus );
            echo json_encode( array_values( $menis ) );
        }
    }
    
    public function open(){

        if ($this->request->is('post')) {
            
            $parent = json_decode( $this->request->data['parent'], true );
            if( count( $parent ) ){
                
                $this->set( "parent", $parent['id'] );
            } else {
                $this->set( "parent", null );
            }

            $this->set("type", "add");            
            $this->render('add');
        }
    }

    public function add(){
        
        if ($this->request->is('post')) {
            
            $this->Menu->create();
            if ( $this->Menu->save( $this->request->data ) ) {
                
//---------------Chamada do metodo de adição de log-------------------

                $this->getLogevent()->createLog(

                        $this->UserAuth->getUsuarioId(),
                        'Menu',
                        'add',
                        'Menu gravado com ID: ' . $this->Menu->getLastInsertId() 
                );

//---------------Chamada do metodo de adição de log-------------------
                
                $this->ajax_treegrid();
            }
        }
    }
    
    public function editMenu(){
        
        $this->autoRender = false;
        
        if ( $this->request->is('put') ){
            
            unset( $this->request->data['Menu']['parent_id'] );
            
            $this->Menu->create();
            
            if ( $this->Menu->save( $this->request->data ) ) {
                
//---------------Chamada do metodo de adição de log-------------------

                $this->getLogevent()->createLog(

                        $this->UserAuth->getUsuarioId(),
                        'Menu',
                        'edit',
                        'Menu editado com ID: ' . $this->Menu->getLastInsertId() 
                );

//---------------Chamada do metodo de adição de log-------------------
                
                $this->ajax_treegrid();
            }
        }
    }    

    public function edit(){
        
        if (!$this->request->is('post')) {
            
            throw new MethodNotAllowedException();
        }

        $this->request->data['Menu'] = $this->request->data;
        
        
        $this->set('type', 'edit');
        $this->render("add");
    }

    private function retiraChildren($menus, &$dados) {
        
        foreach ($menus as $ordem => $menu) {
            
            $dados[] = array(
                
                'id' => $menu['id'],
                'parent_id' => (isset($menu['_parentId'])) ? $menu['_parentId'] : null,
                'ordem' => $ordem
            );
            
            if (isset($menu['children'])){
                
                $this->retiraChildren($menu['children'], $dados);
            }
        }
    }

    public function reordena() {
        
        if (!$this->request->is('post')) {
            
            throw new MethodNotAllowedException();
        }
        $menus = json_decode($this->request->data['Menu']['json'], true);
        $dados = array();
        $this->retiraChildren($menus, $dados);

        if ($this->Menu->saveAll($dados)){
            
//---------------Chamada do metodo de adição de log-------------------

            $this->getLogevent()->createLog(

                    $this->UserAuth->getUsuarioId(), 
                    'Menu', 
                    'reorder', 
                    'Menu Reordenado com ID: ' . $this->Menu->id
            );
        
//---------------Chamada do metodo de adição de log-------------------               
            
            $this->alert("A ordem do menu foi alterada com sucesso.", 'success');
            
        }else{
            
            $this->alert("A ordem do menu não pode ser alterada.", 'error');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function delete( $id ){
        
        $this->autoRender = false;
        
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Menu->id = $id;
        if (!$this->Menu->exists()) {
             $this->alert(__('Menu Inválido'));
                    return $this->redirect(array('action' => 'index'));
            
            
        }
        $this->Menu->delete();
        
//---------------Chamada do metodo de adição de log-------------------

        $this->getLogevent()->createLog(
                
                $this->UserAuth->getUsuarioId(), 
                'Menu', 
                'delete', 
                'Menu deletado com ID: ' . $id
        );
        
        $this->ajax_treegrid();
//---------------Chamada do metodo de adição de log-------------------             
    }
}
