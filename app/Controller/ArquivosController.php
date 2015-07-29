<?php
App::uses('AppController', 'Controller');
App::uses('File', 'Utility'); 
App::uses('Folder', 'Utility'); 
class ArquivosController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        Configure::write('diretorio_arquivos', WWW_ROOT . 'files' . DS);
        Configure::write('diretorio_temp', WWW_ROOT . '_temp' . DS);
    }

    private function checaSeUsuarioLogadoTemAcesso($arquivo_id) {
        if (!$this->UserAuth->isAdmin() && !$this->Arquivo->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $arquivo_id)) {
            $this->alert('Você não tem acesso a este arquivo', 'error');
            $this->redirect('index');
        }
    }

    private function checaSeUsuarioLogadoTemAcessoAoDemanda($demanda_id) {
        if (!$this->UserAuth->isAdmin() && !$this->Arquivo->Demanda->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $demanda_id)) {
            $this->alert('Você não tem acesso a este processo', 'error');
            $this->redirect('index');
        }
    }

    private function checaSeUsuarioLogadoTemAcessoAAtividade($atividade_id) {
        
        if (!$this->UserAuth->isAdmin() && !$this->Arquivo->Atividade->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $atividade_id)) {
            $this->alert('Você não tem acesso a esta atividade', 'error');
            $this->redirect('index');
        }
    }

    public function index(){
        
        $this->Arquivo->recursive = 1;
        $this->set('arquivos', $this->paginate());
        
    }

    public function view( $id = null ){
        
        $this->Arquivo->id = $id;
        if (!$this->Arquivo->exists()) {
            throw new NotFoundException(__('Invalid %s', __('arquivo')));
        }
        $this->checaSeUsuarioLogadoTemAcesso($id);
        $this->recursive = 2;
        $this->set('arquivo', $this->Arquivo->read(null, $id));
    }

    public function download($id = null) {

        if(!$id){
            throw new NotFoundException(__('Invalid %s', __('arquivo')));
        }
        
        $arquivo = $this->Arquivo->findById( $id );
        
        $ext     = ( empty( $arquivo['Arquivo']['tx_extensao'] ) || $arquivo['Arquivo']['tx_extensao'] == "---" ) ? "" : ".".$arquivo['Arquivo']['tx_extensao'];
        
        $file_name = $id . "_" . $arquivo['Arquivo']['versao'] . $ext;
        $new_name  = $arquivo['Arquivo']['nome'] . $ext;
        $full_path = WWW_ROOT . 'files' . DS . $file_name;        
        
        $this->response->file(
            $full_path, array( 'download' => true, 'name' => $new_name )
        );
        return $this->response;
    }

    private function versiona_arquivo( &$data ){
        
        if (!$data['Arquivo']['id']){
            
            $data['Arquivo']['versao'] = 1;
        }else{
            $data['Arquivo']['versao'] ++;
        }
    }

    private function move_arquivo_temp( $conteudo_arquivo ) {

        if ($conteudo_arquivo) {

            $arquivo = new File( $conteudo_arquivo['file']['tmp_name'] );
            $arquivo->copy( Configure::read('diretorio_temp') . basename( $conteudo_arquivo['file']['name'] ) );
            $arquivo->close();
        }
    }
    
    private function move_arquivo( $conteudo_arquivo, $id, $versao, $ajax=true ){

        if ($conteudo_arquivo) {
            
            if( $ajax ){
                
                $arquivo = new File( Configure::read('diretorio_temp') . basename( $conteudo_arquivo['name'] ) );
            } else {
                $arquivo = new File( $conteudo_arquivo['tmp_name'] );
            }
            $copiado = $arquivo->copy( Configure::read('diretorio_arquivos') . $id ."_". $versao .".". $conteudo_arquivo['tx_extensao'] );
            $arquivo->close();
            return $copiado;
            
        }
    }

    private function prepara_arquivo( &$data, $demanda_id ){
        
        if( !isset( $demanda_id ) ){return false;}
        
        if (isset($data['Arquivo']['file'])) {
            
            $info_arquivo = $data['Arquivo']['file'];

            unset($data['Arquivo']['file']);

            if ($info_arquivo['type']){

                $extensao_array = "";
                if( strripos( $info_arquivo['name'], "." ) ){
                    
                    $extensao_array = explode( ".", $info_arquivo['name'] );
                    $extensao_array = $extensao_array[1];
                }
                
                $data['Arquivo']['tx_contenttype'] = $info_arquivo['type'];
                $data['Arquivo']['tx_extensao']    = $extensao_array;
                $info_arquivo['tx_extensao']       = $extensao_array;
                $data['Arquivo']['demanda_id']     = $demanda_id;
                
                return $info_arquivo;
            }
        }
        return false;
    }    
    
    public function setFile(){
        
        $this->autoRender = false;
        
        if ( $this->request->is('post') && isset( $this->request->data ) ){
            
            $this->versiona_arquivo( $this->request->data );
            $arquivo = $this->request->data;

            $usuario = "";
            if( count( $this->Arquivo->Usuario->findById( $this->request->data['Arquivo']['usuario_id'] ) ) > 0 ){
                
                $usuario   = $this->Arquivo->Usuario->findById( $this->request->data['Arquivo']['usuario_id'] )['Usuario']['nome'];
            }
            
            $categoria = "";
            if( count( $this->Arquivo->CategoriaArquivo->findById( $this->request->data['Arquivo']['categoria_arquivo_id'] ) ) > 0 ){
                
                $categoria = $this->Arquivo->CategoriaArquivo->findById( $this->request->data['Arquivo']['categoria_arquivo_id'] )['CategoriaArquivo']['nome'];
            }
            
            $atividade = "";
            if( count( $this->Arquivo->Atividade->findById( $this->request->data['Arquivo']['atividade_id'] ) ) ){
                
                $atividade = $this->Arquivo->Atividade->findById( $this->request->data['Arquivo']['atividade_id'] )['Atividade']['nome'];
            }

            $name = substr( $arquivo['Arquivo']['file']['name'] , 0, strpos( $arquivo['Arquivo']['file']['name'] , '.' ) );
            $name = ( empty( $name ) ) ? $arquivo['Arquivo']['file']['name'] : $name;

            $arquivo['Arquivo']['nome']           = $name;
            $arquivo['Arquivo']['usuario_nome']   = $usuario;
            $arquivo['Arquivo']['categoria_nome'] = $categoria;
            $arquivo['Arquivo']['atividade_nome'] = $atividade;
            
            $this->move_arquivo_temp( $arquivo['Arquivo'] );
                    
            echo json_encode( $arquivo );
        }
    }

    public function save( $files, $demanda_id, $ajax=true ){

        $info_arquivo    = $this->prepara_arquivo( $files, $demanda_id );
        $arquivo_demanda = array();
        
        if( $this->Arquivo->save( $files['Arquivo'] ) ){

            $arquivo_demanda['arquivo_id']      = $this->Arquivo->id;
            $arquivo_demanda['demanda_id']      = $demanda_id;
            $arquivo_demanda['atividade_id']    = $files['Arquivo']['atividade_id'];
	    $arquivo_demanda['id'] = $this->Arquivo->id;

            $this->Arquivo->ArquivoDemanda->save( $arquivo_demanda );
            
            return $this->move_arquivo( $info_arquivo, $this->Arquivo->id, $files['Arquivo']['versao'], $ajax );
        }
        return false;
    }

    private function add_edit_display($demanda_id = null){

        $this->set('categorias', $this->Arquivo->CategoriaArquivo->find('list'));
        $this->set('atividades', $this->Arquivo->Atividade->find('list', array('conditions' => array('Atividade.demanda_id' => $demanda_id))));
    }

    public function add( $atividade_id = null ){

        if ($this->request->is('post')){

            $this->Arquivo->Atividade->id = $this->request->data['Arquivo']['atividade_id'];
            if (!$this->Arquivo->Atividade->exists()){

                throw new NotFoundException(__('Invalid %s', __('atividade')));
            }
            
            $this->request->data['Arquivo']['nome'] = substr( $this->request->data['Arquivo']['file']['name'] , 0, strpos( $this->request->data['Arquivo']['file']['name'] , '.' ) );
            $this->request->data['Arquivo']['nome'] = ( empty( $this->request->data['Arquivo']['nome'] ) ) ? $this->request->data['Arquivo']['file']['name'] : $this->request->data['Arquivo']['nome'];

            $this->versiona_arquivo( $this->request->data );
            
            if($this->save( $this->request->data, $this->request->data['Arquivo']['demanda_id'], false )){
                
                $this->alert('Arquivo salvo com sucesso!','sucess');
                $this->redirect(array(

                    'controller' => 'atividades',
                    'action' => 'index'
                ));
                
            } else {
                
                $this->alert('Erro ao salvar o arquivo!','error');
                $this->redirect(array(

                    'controller' => 'atividades',
                    'action' => 'index'
                ));                
            }
        }
        
        $this->Arquivo->Atividade->id = $atividade_id;
        if (!$this->Arquivo->Atividade->exists()){
            
            throw new NotFoundException(__('Invalid %s', __('atividade')));
        }        
        
        $atividade = $this->Arquivo->Atividade->findById( $atividade_id );

        $this->request->data['Arquivo']['atividade_id'] = $atividade['Atividade']['id'];
        $this->request->data['Arquivo']['usuario_id']   = $this->UserAuth->getUsuarioId();
        $this->request->data['Arquivo']['versao']       = 1;
        
        $this->set('demanda_id', $atividade['Atividade']['demanda_id']);
        $this->set('atividades', $this->Arquivo->Atividade->find('list', array('conditions' => array('demanda_id' => $atividade['Atividade']['demanda_id']))));
        $this->set('categorias', $this->Arquivo->CategoriaArquivo->find('list'));  
        $this->set('type_arquivo', "add");
    }
    
    public function edit( $id = null ){
        
        $this->Arquivo->id = $id;
        if (!$this->Arquivo->exists()){
            
            throw new NotFoundException(__('Invalid %s', __('arquivo')));
        }
        
        $this->checaSeUsuarioLogadoTemAcesso($id);
        $this->Arquivo->contain(array("Demanda", "Atividade"));
        $this->request->data = $this->Arquivo->findById($id);
        $this->request->data['Demanda']['id'] = $this->request->data['Demanda'][0]['id'];
        if (isset($this->request->data['Atividade'][0]['id'])){
            $this->request->data['Atividade']['id'] = $this->request->data['Atividade'][0]['id'];
        }
        $this->add_edit_display();
        $this->set('type_arquivo', "edit");
        //$this->render('add');
    }

    public function delete(){
        
        $this->autoRender = false;
        
        if ( !$this->request->is('post') ){
            
            throw new MethodNotAllowedException();
        }
        if ( !empty( $this->request->data['id'] ) ){
            
            $this->Arquivo->id = $this->request->data['id'];
            
            if (!$this->Arquivo->exists()){
                
                throw new NotFoundException(__('Invalid %s', __('arquivo')));
            }
		$valor = $this->Arquivo->findById($this->request->data['id']);
	
		///echo  Configure::read('diretorio_arquivos') . $valor['Arquivo']['id'] .'_1.'. $valor['Arquivo']['tx_extensao'];

		unlink(Configure::read('diretorio_arquivos') . $valor['Arquivo']['id'] .'_1.'. $valor['Arquivo']['tx_extensao']);


            if ($this->Arquivo->delete($this->request->data['id'])){
                
                echo json_encode('1');
            }else{
                echo json_encode('0');
            }
        }
    }

}
