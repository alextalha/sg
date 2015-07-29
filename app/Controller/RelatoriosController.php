<?php

App::uses('AppController', 'Controller');

class RelatoriosController extends AppController {

    private function checaSeUsuarioLogadoTemAcesso($relatorio_id, $action) {
        if (!$this->UserAuth->isAdmin() && !$this->Relatorio->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $relatorio_id, $action)) {
            $this->alert('Você não tem acesso a este relatorio', 'error');
            $this->redirect('../');
            //debug ($relatorio_id);
            //debug ($action);
            //debug ($this->UserAuth->getUsuarioId());
            //debug ( $this->Relatorio->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $relatorio_id, $action) );
        }
    }

    public function index() {
        
        $parametros = (isset( $this->Session->read('filters_grid')['relatorios'] ))?$this->Session->read('filters_grid')['relatorios']:"";
        $rs  = $this->getParamsUrl( $parametros );

        $opt = array(
  
            'conditions' => ( !$rs ) ? array( 'Relatorio.id > ' => 0 ) : $rs,            
            'limit'      => $this->getParametros()->getParametro('paginator')
        );        
        
        $this->paginate = $opt;
        
        $fields = json_encode( $parametros );
        
        $this->Relatorio->recursive = 0;
        $categ  = $this->paginate( 'Relatorio' );

        $this->set( 'relatorios',  $categ );
        $this->set( 'fields', $fields );          
        
    }

    private function formataDadosArquivos($arquivos, $diretorio) {
        $ret = array();
        if ($arquivos)
            foreach ($arquivos as $a => $arquivo) {
                if (($arquivo != ".") && ($arquivo != "..") && ($arquivo != "vweb.txt") && (is_file($diretorio . $arquivo)) && (substr($arquivo, 0, 4) != "rem@")) {
                    $ret[] = array(
                        'nome' => $this->Relatorio->reticencias_apos_limite_caracteres($arquivo, 300),
                        'descricao' => (file_exists($diretorio . "rem@" . $arquivo . ".txt")) ? file_get_contents($diretorio . "rem@" . $arquivo . ".txt") : "",
                        'tamanho' => number_format((filesize($diretorio . $arquivo) / (1024 * 1024)), 2, ',', '.'),
                        'modificacao' => date('d/m/Y H:i:s', filemtime($diretorio . $arquivo))
                    );
                }
            }
        return $ret;
    }

    public function bpm($nome_pasta) {
        $this->set('nome_pasta', $nome_pasta);
    }

    public function download($path = null) {
        if (!$path)
            throw new NotFoundException(__('Invalid %s', __('arquivo')));
        $path = trim(str_replace("slash", "/", $path));
        $file_path = WWW_ROOT . str_ireplace("\'", "'", $path);
        if (strtolower(substr($file_path, -3, 3)) == "xml")
            $contenttype2 = "application/vnd.ms-excel";
        $tx_contenttype = 'application/ms-download' . ($contenttype2 == "" ? "" : ", " . $contenttype2) . '; charset=iso-8859-1';
        $filename = basename(str_ireplace(array("\'", '\\', '/', ' ', '*', '<', '>', '|', '?', ':', '"'), array("'", '_', '_', '_', '_', '_', '_', '_', '_', '_', '_'), $path));
        ClassRegistry::init("Arquivo")->flushfile($filename, $file_path, $tx_contenttype);
    }

    private function getArquivosDiretorio( $diretorio, $decrescente = 0 ) {
        if (is_dir($diretorio)) {
            $arquivos = ($decrescente) ? scandir($diretorio, 1) : scandir($diretorio);
            $arquivos = array_diff($arquivos, array(".", ".."));
            if (!$arquivos) {
                $this->alert("Não há arquivos no diretório.", 'error');
                return array();
            }
        } else {
            $this->alert("O diretório não existe.", 'error');
            return array();
        }
        return $this->formataDadosArquivos($arquivos, $diretorio);
    }

    public function view($id = null, $decrescente = 0) {
        $this->Relatorio->id = $id;
        if (!$this->Relatorio->exists()) {
           $this->alert(__('Relatório inválido'));
           return $this->redirect(array('action' => 'index'));
        }
        $this->checaSeUsuarioLogadoTemAcesso($id, 'view');
        $relatorio = $this->Relatorio->findById($id);
        $arquivos = $this->getArquivosDiretorio($relatorio['Relatorio']['tx_diretorio']);
        $this->set(compact('relatorio', 'arquivos'));
    }

    private function add_edit_post(&$data, $mensagens) {
        
        if ( $this->Relatorio->save( $data['Relatorio'] ) ) {
            
            $relatorio = array("controller" => "Relatorios", "conteudo_id" => $this->Relatorio->id, "descricao" => $data['Relatorio']['nome']);
            ClassRegistry::init("Permission")->addPermissoes($data['Permission'], $relatorio);
            
          
            
            $this->alert($mensagens['success'], 'success');
            
        } else
            $this->alert($mensagens['error'], 'error');
        $this->redirect(array('action' => 'index'));
    }

    private function add_edit_display() {
        $grupos = ClassRegistry::init("Grupo")->getGroupNamesAndIds();
        $this->set(compact('grupos'));
    }

    public function add() {
        
        if ($this->request->is('post')) {
            
            $this->Relatorio->create();
            
            $this->request->data['Relatorio']['action']   = "add";
            $this->request->data['Relatorio']['incident'] = "Relatório gravado com ID: ";
            
            $this->add_edit_post( $this->request->data, array(
                'success' => "O relatório foi salvo com sucesso.",
                'error' => "O relatório não pode ser salvo."
            ));
        }
        $this->set('type', "add");
        $this->add_edit_display();
    }

    public function edit($id = null) {
        
        $this->Relatorio->id = $id;
        if (!$this->Relatorio->exists()) {
            
            throw new NotFoundException(__('Invalid %s', __('relatorio')));
        }
        $this->checaSeUsuarioLogadoTemAcesso($id, 'edit');
        
        if ($this->request->is('post') || $this->request->is('put')) {
            
            $this->request->data['Relatorio']['action']   = "edit";
            $this->request->data['Relatorio']['incident'] = "Relatório editado com ID: " . $id;            
            
            $this->add_edit_post($this->request->data, array(
                
                'success' => "O relatório foi salvo com sucesso.",
                'error' => "O relatório não pode ser salvo."
            ));
        }
        $this->request->data = $this->Relatorio->findById( $id );
        $relatorio = array("controller" => "Relatorios", "conteudo_id" => $id);
        ClassRegistry::init("Permission")->getPermissoesConteudo($this->request->data['Permission'], $relatorio);
        $this->set('type', "edit");
        $this->add_edit_display();
        $this->render("add");
    }

    public function delete($id = null) {
        
        if (!$this->request->is('post')) {
            
            throw new MethodNotAllowedException();
        }
        $this->Relatorio->id = $id;
        if (!$this->Relatorio->exists()) {
            
            $this->alert(__('Relatório Inválido'));
             return $this->redirect(array('action' => 'index'));
             
        }
        $this->checaSeUsuarioLogadoTemAcesso($id, 'delete');
        if ($this->Relatorio->delete()) {
                       
            
            $this->alert('O relatório foi excluído com sucesso', 'success');
        } else {
            $this->alert("O relatório não pode ser excluído.", 'error');
        }
        $this->redirect(array('action' => 'index'));
    }

}
