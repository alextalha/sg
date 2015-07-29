<?php

App::uses('AppController', 'Controller');

App::import('Vendor', 'KoolControls' . DS . 'KoolAjax' . DS . 'koolajax');
App::import('Vendor', 'KoolControls' . DS . 'KoolPivotTable' . DS . 'koolpivottable');


class PivotsController extends AppController {

    private function checaSeUsuarioLogadoTemAcesso($action, $id="") {
        $path = "Pivots/".$action.($id!=""?"/".$id:"");
        if(!$this->checkAccess($path)){
        // if (!$this->UserAuth->isAdmin() && !$this->Pivot->usuarioTemAcesso($this->UserAuth->getUsuarioId(), $pivot_id, $action)) {
            $this->alert("Desculpe, Você não tem permissão para ver esta página .", 'error');
            $this->redirect('index');
        }
    }

    public function index() {
        
        $this->checaSeUsuarioLogadoTemAcesso('index');
        
        $parametros = (isset( $this->Session->read('filters_grid')['pivots'] ))?$this->Session->read('filters_grid')['pivots']:"";
        $rs  = $this->getParamsUrl( $parametros );

        $opt = array(
            
            'conditions' => ( !$rs ) ? array( 'Pivot.id > ' => 0 ) : $rs,
            'limit'      => $this->getParametros()->getParametro('paginator')
        );        
        
        $this->paginate = $opt;
        
        $fields = json_encode($parametros );
        
        $this->Pivot->recursive = 0;
        $pivots = $this->paginate( 'Pivot' );

        $this->set( 'pivots', $pivots );
        $this->set( 'fields', $fields );

    }

    public function view($id = null) {
        
        $this->Pivot->id = $id;
        if (!$this->Pivot->exists()) {
            throw new NotFoundException(__('Invalid %s', __('pivot')));
        }
        $this->checaSeUsuarioLogadoTemAcesso('view',$id);
        $pivot_info = $this->Pivot->findById($id);
        $this->Pivot->createPainel($pivot_info);
 
        
        $this->set('pivot_info', $pivot_info);
        $this->Session->write("pivot_info", $pivot_info);
    }

   
    public function lista_distinct_campo() {
        $this->set('options', $this->Pivot->lista_distinct_campo($this->request->data['pivot_info'], $this->request->data['campo']));
        $this->set('campo', 'Filtro');
        $this->render('/Elements/ajax_checkbox');
    }

    protected function  process($id, $data, &$koolajax, &$pivot) {
        /** 
         * Variável recebe o id da pivot cadastrada . 
         * @name $id 
         * 
         * Varíavel que não sei  
         * @name $data
         *          
         * Variavel que não sei tambem 
         * @name $koolajax
         * 
         * Variavel que não sei tambem
         * 
         * #name $pivot
         * 
         */ 
        
 
        $pivot_info = $this->Pivot->findById($id);
     
        $this->Pivot->init($pivot_info, $koolajax, $pivot);

  
        
        $properties = (isset($data['properties'])) ? json_decode(str_replace("slash", "/", $data['properties']), true) : array();
    
        
        if ($data['linhas']) {
            $this->Pivot->createFields(str_replace("slash", "/", $data['linhas']), 'Row', $pivot, $properties);
 
            
            
        }
        if ($data['colunas']){
           $this->Pivot->createFields(str_replace("slash", "/", $data['colunas']), 'Column', $pivot, $properties);
        
        }
        
        if ($data['valores']){
            $this->Pivot->createFields(str_replace("slash", "/", $data['valores']), 'Data', $pivot, $properties);
          
            
        }
        
        if ($data['filtros']){
    
            $this->Pivot->createFields(str_replace("slash", "/", $data['filtros']), 'Filter', $pivot, $properties);
           
        }
   
        $pivot->Process();

       
    }
    
    public function ajax_process($id, $paging = 0) {
      
         //(!(isset($this->request->data['linhas'])) || !(isset($this->request->data['colunas'])) || !(isset($this->request->data['valores'])) ) {      
 
        if(empty($this->request->data['linhas']) || empty($this->request->data['colunas']) || empty($this->request->data['valores'] )){
       
            $this->process($id, $this->request->data, $koolajax, $pivot);
            $this->set('table',$this->Pivot->select($id, $paging, $count));
   
            
           // $this->request->params['paging'] = array('pageCount' => $paging, 'limit' => 500, 'count' => $count);
            //$this->Pivot->paginate = $this->request->params['paging'];
            
        } else {
            $this->process($id, $this->request->data, $koolajax, $pivot);
            $this->set('table', $this->Pivot->render($koolajax, $pivot));
            
            
        }
    
    }

    public function export($id, $type = "pdf") {
        $this->Pivot->id = $id;
        if (!$this->Pivot->exists()) {
             $this->alert(__('Pivot Inválida'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->checaSeUsuarioLogadoTemAcesso('export');
       
        //http://localhost:8080/triadsag/pivots/export/6/pdf?linhas=&colunas=&valores=&filtros=,titulo,conteudo&properties={}
           
        $this->process($id, $this->params['url'], $koolajax, $pivot);
 
        
        $_htmlTemplate = <<<EOF
            <head>
                <title>Pivot</title>
                <meta http-equiv="content-type" 
                        content="text/html;charset=utf-8" />
            </head>
                <body>
                    <br>

                    {KoolPivotTable}

                    <br>
                </body>
EOF;

                
        $ExSt = $pivot->ExportSettings;
        $ExSt->config(array(
            "fileName" => "Pivot",
            "template" => $_htmlTemplate,
            "showFilterZone" => TRUE,
            "caseSensitive" => TRUE,
            "pdf" => array(
                "pageOrientation" => "L",
                "pageDimension" => array(600, 360),
        )));

        $ExSt->changeText(array(
            "Column fields" => "Colunas",
            "Row fields" => "Linhas",
            "Data fields" => "Valores",
            "Filter fields" => "Filtros"
        ));

        //htmlStyle() only affects HTML and PDF exported files
        $ExSt->htmlStyle(array(
            "table" => "border:1px solid grey;"
            . "border-collapse:collapse;color:black;",
            "totalRow" => "background-color:#E5E5E5; font-weight:bold;",
            "totalColumn" => "background-color:#E5E5E5; font-weight:bold;",
            "dataCell" => "text-align:right;",
            "emptyDataCell" => "text-align:center;",
            "cell" => "padding:5px; border:1px solid grey;",
        ));
        $ExSt->htmlProperty(array(
            "table" => array(
                "border" => "1",
                "cellspacing" => "0",
        )));


        $ExSt->IgnorePaging = TRUE;

        if ($type == "html") {
            ob_end_clean();
            if ($pivot->ExportToHTML()) {
                
            }
        }

        if ($type == "pdf") {
            ob_end_clean();
           
            if ($pivot->ExportToPDF()) {
                
            }
        }

        if ($type == "excel") {
            ob_end_clean();
            if ($pivot->ExportToExcel()) {
                
            }
        }
        if ($type == "word") {

            ob_end_clean();
            if ($pivot->ExportToWord()) {
                
            }
        }
    }

    private function add_edit_post($data, $mensagens) {

        if ($this->Pivot->save($data)) {

            $pivot = array("controller" => "Pivots", "conteudo_id" => $this->Pivot->id, "descricao" => $data['Pivot']['nome']);
            //ClassRegistry::init("Permission")->addPermissoes($data['Permission'], $pivot);
                        

            $this->alert($mensagens['success'], 'success');
           // $this->redirect(array('action' => 'view', $this->Pivot->id));
            $this->redirect('index');
            
        }  
        $this->alert($mensagens['error'], 'error');
        $this->redirect(array('action' => 'index'));
    }

    private function add_edit_display() {
        $grupos_nomes = ClassRegistry::init("Grupo")->getGroupNamesAndIds();
        $grupos = $this->Pivot->Grupo->find('list');
        $this->set(compact('grupos_nomes', 'grupos'));
    }

    
    public function add_edit($id = null){
    
        $this->checaSeUsuarioLogadoTemAcesso('add_edit',$id);
          
        $type = (isset($id) and !empty($id)) ? "edit" : "add";
        
        if($type == "edit"){
             $this->Pivot->id = $id;
        
         if ($this->request->is(array('post','put'))) {
         
           $this->request->data['Pivot']['action']   = "edit";
           $this->request->data['Pivot']['incident'] = "Pivot editado com ID: " . $id;            
            
            $this->add_edit_post($this->request->data, array(
                'success' => "A pivot foi atualizada com sucesso.",
                'error' => "A pivot não pode ser atualizada."
            ));

        }else{
           
            $this->request->data = $this->Pivot->findById($id);
            if (!$this->Pivot->exists()){
                 $this->alert(__('Pivot Inválido'));
                 return $this->redirect(array('action' => 'index'));
}

        }
     
        }else{
            // é add 
           if ($this->request->is(array('post'))) {
            
            $this->Pivot->create();
            
            $this->request->data['Pivot']['action']   = "add";
            $this->request->data['Pivot']['incident'] = "Pivot gravado com ID: ";

            $this->add_edit_post( $this->request->data, array(
                'success' => "A pivot foi salva com sucesso.",
                'error' => "A pivot não pode ser salva."
            ));
               
           } 
            
        }
            $this->set('type', $type);
            $this->add_edit_display();
            $this->render("add");
    }
    
    
    public function edit($id = null) {
        $this->add_edit($id);
    }

    public function add() {
        $this->add_edit();
    }

    
    public function delete($id = null) {
        if (!$this->request->is('post','delete')) {
            throw new MethodNotAllowedException();
        }
        $this->Pivot->id = $id;
        if (!$this->Pivot->exists()) {
            throw new NotFoundException(__('Invalid %s', __('relatorio')));
        }
        $this->checaSeUsuarioLogadoTemAcesso('delete');
        if ($this->Pivot->delete()) {
  
            $this->alert('A pivot foi excluida com sucesso.', 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->alert('A pivot não pode ser excluída.', 'error');
        $this->redirect(array('action' => 'view', $id));
    }

}
