<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('Logevento', 'Model');
App::uses('Parametro', 'Model');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $helpers = array(
			'Session',
			'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
			'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
			'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
                        'UserAuth',
                        'Permissions'
		);
    
       
    public $viewClass = 'App';
    public $components = array(
        'DebugKit.Toolbar',
        'Session',
        'RequestHandler',
        'UserAuth',
        'Paginator',
        'Session');
    
    private $logevent   = null;
    protected $parametros = null;
    
  
      
    public function getLogevent(){
        
        if( $this->logevent == null ){
            
            $this->logevent = new Logevento();
        }
        return $this->logevent;
    }
    
    public function getParametros(){
        
        if( $this->parametros == null ){
            $this->parametros = new Parametro();
        } else {
            $this->parametros = null;
            $this->parametros = new Parametro();
        }
        return $this->parametros;
    }
    
    public function origReferer(){
        
        return $this->Session->read('referering');
    }

    public function setReferer(){
        
        if( $this->getUrlParameter() === "add" 
                || $this->getUrlParameter() === "edit" 
                || $this->getUrlParameter() === "edit#" 
                || $this->getUrlParameter() === "add#" ){}else{
            
            $this->Session->write('referering', $this->referer());
        }
    }
    
    public function afterSave( $created, $options = array() ){
/*
        $entity = $this->alias;
    
        $data_criada     = strtotime( (isset($this->data[$entity]['created']))?$this->data[$entity]['created']:null );
        $data_modificada = strtotime( (isset($this->data[$entity]['modified']))?$this->data[$entity]['modified']:null );
        
        $exceptions = array( "Logevento", "Session" );
        
        if( in_array( $entity, $exceptions ) ){ return false; }
        
        $userId = $_SESSION['UserAuth']['Usuario']['id'];
        
        $action   = ( $data_criada == $data_modificada ) ? "Add":"Edit";
        
        $entity_id = ( isset( $this->data[$entity]['id'] ) )? $this->data[$entity]['id'] : "Erro ao capturar ID ou ID não existente";
       
        $incident = ( $data_criada == $data_modificada || $data_modificada == null ) ? "Adicionado com ID: " . $entity_id :"Editado com ID: " . $entity_id;

        $log = ClassRegistry::init( 'Logevento' );
        
        $log->createLog(
                
            $userId, 
            $entity, 
            $action, 
            $incident

        );
 * 
 */
    }    

    
   
    public function beforeFilter(){
        
        
        $this->userAuth();
        $this->setReferer();
        $this->setSessionCrumb( $this->Session->read('crumb') );
        $this->{$this->modelClass}->request = $this->request;
   
    }

    public function beforeRender(){
        $this->Paginator->settings = array(
            //'conditions' => array('Recipe.title LIKE' => 'a%'),
        'limit' => 10 );
    }

    
    
    private function getUrlParameter(){
     
        $url_array = array_reverse( explode( "/", $this->referer() ) );
        
        $index = $url_array[0];

        if( !ereg( '[^0-9]', $index ) ){

            return $url_array[1];
        }else{
            return $url_array[0];
        }
    }    

    public function setSessionCrumb( $link ){
        
        if( !$this->controllerActions() ){}else{

            $entitys = array('buscas','onvalites','css','atalhos','js','BreadCrumbSistema','GenericFilters','AppCombos','etapas','arquivos','avisos_etapas','updateProcess','debug_kit','perfil','acesso_negado','index');
            $actions = array('cancelar_ajax','anexarArquivo','avancarAtividade','assumir_edit','delegaAtividade','editAtividade','getAtividadesDemanda','checkchildren','reject','getSugestaoDemandaNome','checkacesso','checkprocessochildren','save','getGrupo','download','login','add','edit','getProcess','elementos_menu','menu','ajax_treegrid','escolher_fundo_pagina_inicial','getDemanda','alterar_senha_usuario','changeUsuarioPassword','return_json_request_data','checkOrign','assumir','avancar','assumir_edit','delegar_usuario','delegar','cancelar','cancelar_usuario','concluir','prorrogar','setSLAinDate','updateProcess','avancar_atividade');

            $controllers = $this->controllerActions();

            if (in_array(key($controllers), $entitys)) {} else {
                
                if( $this->findInArray($actions, $controllers) ){} else {
                    
                    $link[key($controllers)] = $controllers[key($controllers)];
                    
                    $link = $this->verifyCrumb( $link );
                    
                    $this->Session->write('crumb', $link);                    
                }
            }
            //$this->Session->delete('crumb');
            //$this->Session->delete('filters_grid');
            //debug( $this->Session->read('crumb') );
        }
    }
    
    private function verifyCrumb( &$session ){

        if( count( $session ) > $this->getParametros()->getParametro('crumb') ){
            
            array_shift ( $session );
        }
        return $session;
    }
    
    private function findInArray( $needle_array, $array ){
        
        if( !isset( $needle_array ) ){return false;}
        
        $retorno = false;
        foreach ( $needle_array as $i => $v ){
            
            foreach ( $array as $j => $r ){
                
                if( !is_array( $r ) ){} else {

                    if( in_array( $v, $r ) ){

                        $retorno = true;
                    }                    
                }
            }
        }
        return $retorno;
    }
    
    private function controllerActions(){

        $action_array = explode( "/", $this->here );
        $action       = '';

        if( $action_array[0] == '' ){
            
            unset( $action_array[0] );
        }
        if( $action_array[1] == Configure::read("NOME_PROJETO") ){
            
            unset( $action_array[1] );
        }
        if( isset( $action_array[2] ) ){
            
            $action = $action_array[2];
            unset( $action_array[2] );
        }
        
        if( !empty( $action ) ){
            
            $options[$action] = ( isset( $action_array ) && !empty( $action_array ) ) ? $action_array : '';
            return $options;
        } else {
            return false;
        }
    }
    
    private function userAuth() {
        $this->UserAuth->beforeFilter($this);
    }

    public function alert( $message, $type = 'info'){
        
        //Types -> alert-info    ( $type = 'info' )
        //Types -> alert-warning ( $type = 'warning' )
        //Types -> alert-danger  ( $type = 'danger' )
        //Types -> alert-success ( $type = 'success' )
        //Types -> alert-error   ( $type = 'error' )
        
        $this->Session->setFlash(__( $message ), 'alert', array(      
                'plugin' => 'TwitterBootstrap',
                'class' => 'alert-' . $type
        ));
    }

    
    
    private function fillTemplateWithData($template, $dados) {
        
        foreach ($dados as $i => $dado) {
            $template = str_replace("%$i", $dado, $template);
        }
        return $template;
    }

    // EXEMPLO
    //'%0 %1 (%2), ',
    // array('first_name','last_name','Grupo.name')
    // $demanda['UsuariosEnvolvidos']
    // Resultado: "Nome Sobrenome (Grupo), Nome2 Sobrenome2 (Grupo2), Nome3 Sobrenome3 (Grupo3), "
    protected function joinTemplateWithData($template, $chaves, $dados) {
        $texto = "";
        foreach ($dados as $dado) {
            $dados_elemento = array();
            foreach ($chaves as $chave) {
                $chaves_elemento = explode('.', $chave);
                $conteudo = $dado;
                foreach ($chaves_elemento as $chave_elemento)
                    if (isset($conteudo[$chave_elemento]))
                        $conteudo = $conteudo[$chave_elemento];
                $dados_elemento[] = $conteudo;
            }

            $texto .= $this->fillTemplateWithData($template, $dados_elemento);
        }
        return $texto;
    }

    private function ajax_form_tabela_add_linha($num_linha = 0) {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->set('colunas', unserialize($this->request->data['Add']['colunas']));
            unset($this->request->data['colunas']['Add']);
            $this->set('linha', $this->request->data['Add']);
            $this->set('num_linha', $num_linha + 1);
            $this->render('/Elements/form-tabela-linha');
        }
    }

    private function createTree(&$list, $parent) {
        $tree = array();
        foreach ($parent as $k => $l) {
            if (isset($list[$l['id']])) {
                $l['children'] = $this->createTree($list, $list[$l['id']]);
            }
            $l['usuario_nome'] = 'eu';
            $tree[] = $l;
        }
        return $tree;
    }

    private function create_tree($atividades) {
        $new = array();
        foreach ($atividades as $a) {
            $new[$a['parent_id']][] = $a;
        }
        return $this->createTree($new, $atividades);
    }
    
    public function createJson( $data ){
        
        if( empty( $data ) ){return false;}
        
        return json_decode( $data, true );
    }

    private function makeMilestone( $status ){
        
        $result = "";
        switch( $status ){
            
            case "1":
                $result["Etapa.milestone = "] = 1;
                break;
            case "0":
                $result["Etapa.milestone = "] = 0;
                break;
        }
        return $result;
    }

    public function getParamsUrl( &$data ) {
        if(@$this->params['url']['exportar'] == ("Xls" || "Pdf")){
          
            $this->Session->write('exportar',$data[0]['exportar']);
    
                }else{
                    $this->Session->delete('exportar');
                }
        if ( !$data ) { return false; }$dados = array();
            foreach ($data as $dado) {
                if ( empty($dado['val'] ) && $dado['val'] != "0") {} else {
                    $tipo = $dado['type'];

                switch ( $tipo ) {

                    case "num":

                        $dados[$dado['id'] . " = "] = $dado['val'];
                        break;

                    case "select":

                        $dados[$dado['id'] . " = "] = $dado['val'];
                        break;

                    case "date-interval":

                        $date = explode(" ", $dado['val']);
                        $data_banco1 = implode("-", array_reverse(explode("/", $date[0])));
                        $data_banco2 = implode("-", array_reverse(explode("/", $date[1])));

                        $dados["and"] = array(
                            array(
                                $dado['id'] . ' >= ' => $data_banco1,
                                $dado['id'] . ' <= ' => $data_banco2
                            )
                        );
                        break;

                    case "boolean":
                        
                        if( $dado['id'] == "milestone" ){
                            
                            $filter      = $this->makeMilestone( $dado['val'] );
                            $key         = key( $filter );
                            $dados[$key] = $filter;
                            
                        } else {
                            
                            $dados[$dado['id'] . " = "] = $dado['val'];
                        }
                        break;

                    case "combo":

                        $dados[$dado['id'] . " = "] = $dado['val'];
                        break;

                    default :
                        
                        $dados[$dado['id'] . " LIKE "] = "%" . $dado['val'] . "%";
                }
            }
        }

        
        
        if( empty( $dados )  ){
            
            return false;
            
        }else{
      
            return $dados;
           
        }
    }

    private function checkUrlEncode( $url ){
        
        if( strpos( $url, "%") ){
            
            return urldecode( $url );
        }else{
            return $url;
        }
    }
    
    function checkAccess($path){
        if($this->Session->read('UserAuth.Grupo.0.alias_name') === 'Admin'){
            return true;
        }
        if($this->Session->check('Permissions.'.$path)
        && $this->Session->read('Permissions.'.$path) === true){
            return true;
        }
        return false;
    }
}
