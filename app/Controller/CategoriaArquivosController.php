<?php

App::uses('AppController', 'Controller');

/**
 * CategoriaArquivos Controller
 *
 * @property CategoriaArquivo $CategoriaArquivo
 * @property PaginatorComponent $Paginator
 */
class CategoriaArquivosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    
           private function checaSeUsuarioLogadoTemAcesso($action, $id = "") {
            $path = "CategoriaArquivos/" . $action . ($id != "" ? "/" . $id : "");
                if (!$this->checkAccess($path)) {
                // if (!$this->UserAuth->isAdmin() && !$this->Pivot->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $pivot_id, $action)) {
                $this->alert("Sorry, You don't have permission to view that page.", 'error');
                $this->redirect('index');
        }
    }

    
    public function index() {
   $this->checaSeUsuarioLogadoTemAcesso('index');
           
        $this->CategoriaArquivo->recursive = 0;
        $this->set('categoriaArquivos', $this->Paginator->paginate());


        $parametros = (isset($this->Session->read('filters_grid')['categoria_arquivos'])) ? $this->Session->read('filters_grid')['categoria_arquivos'] : "";
        $rs = $this->getParamsUrl($parametros);

        $opt = array(
            'conditions' => (!$rs ) ? array('CategoriaArquivo.id > ' => 0) : $rs,
            'limit' => $this->getParametros()->getParametro('paginator')
        );

        $this->paginate = $opt;

        $fields = json_encode($parametros);

        $this->CategoriaArquivo->recursive = 0;
        $categ = $this->paginate('CategoriaArquivo');

        $this->set('categoriaArquivos', $categ);
        $this->set('fields', $fields);
    }

    private function add_edit($id = null) {

           $this->checaSeUsuarioLogadoTemAcesso('add_edit',$id);
        
        $type = "add";
        if (isset($id) and ! empty($id)) {
           $type = "edit";
        }
        
         if ($this->request->is(array('post', 'put'))) {
             
          if($type == "edit"){
              
              if (!$this->CategoriaArquivo->exists($id)) {
               
                 $this->alert(__('Categoria Arquivo Inválida'));
                 return $this->redirect(array('action' => 'index'));
                
            }
              
          }else{
               $this->CategoriaArquivo->create();
         }
         
         
             if ($this->CategoriaArquivo->save($this->request->data)) {
                     $this->alert(__('Categoria Arquivo foi salva.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->alert(__('Categoria arquivo não pode ser salva. Tente novamente .'));
                }
            } else {
                $options = array('conditions' => array('CategoriaArquivo.' . $this->CategoriaArquivo->primaryKey => $id));
                $this->request->data = $this->CategoriaArquivo->find('first', $options);
            }

        /* Render CTP */
        $this->set('type', $type);
        $this->render("add");
    }

    public function edit($id = null) {
        $this->add_edit($id);
    }


    public function add() {
        $this->add_edit();
    }


    public function delete($id = null) {

        $this->checaSeUsuarioLogadoTemAcesso('delete', $id);

        $this->CategoriaArquivo->id = $id;
        if (!$this->CategoriaArquivo->exists()) {
            throw new NotFoundException(__('Invalid categoria arquivo'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->CategoriaArquivo->delete()) {
            $this->alert(__('A Categoria foi deletada.'));
        } else {
            $this->alert(__('Categoria Arquivo não pode ser deletada . Por Favor, tente novamente .'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}