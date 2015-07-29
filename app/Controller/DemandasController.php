<?php

/* 
 * by furious
 */

App::uses('AppController', 'Controller');
App::uses('Controller', 'ArquivosController');

class DemandasController extends AppController{
    
    public function beforeFilter(){//call
        
        parent::beforeFilter();
        
        
        // $this->Security->unlockedActions = array('save');
         
        Configure::write('diretorio_arquivos', WWW_ROOT . 'files' . DS);
        Configure::write('diretorio_temp', WWW_ROOT . '_temp' . DS);
    }    
    
    public function index( $processo_id = null ){
        
        //$usuariologado_id    = $this->Session->read('UserAuth.Usuario.id');
        //$grupologado_id      = $this->Session->read('UserAuth.Grupo');
        //$grupo_in            = array();
/*        
        if( count( $grupologado_id ) > 0 ){
            
            foreach ( $grupologado_id as $grupo ){
                
                $grupo_in[] = $grupo['id'];
            }
        }        
*/
        $default_filter = '[{"id":"Demanda.grupo_id","type":"select","val":'.$this->UserAuth->getGroupsIds().
                ',"entity":"Grupo"},{"id":"StatusDemanda.id","type":"select","val":["1","2","3","4"],"entity":"StatusAtividade"}]';
           
        $parametros = (isset( $this->Session->read('filters_grid')['demandas'] ))?$this->Session->read('filters_grid')['demandas']:"";
        if( empty( $parametros ) ){
            $parametros = json_decode( $default_filter, true );
        }
        $rs  = $this->getParamsUrl( $parametros );
        $opt = array(
            "joins" => array(
                array(
                    "table" => "atividades",
                    "alias" => "Atividade",
                    "type" => "INNER",
                    "conditions" => array("Demanda.id = Atividade.demanda_id", "Atividade.ordem = '0'")
                ),
                array(
                    "table" => "etapas",
                    "alias" => "Etapa",
                    "type" => "INNER",
                    "conditions" => array("Etapa.id = Atividade.etapa_id")
                ),
                array(
                    "table" => "status_atividades",
                    "alias" => "StatusDemanda",
                    "type" => "LEFT",
                    "conditions" => array("StatusDemanda.id = Demanda.status_atividade_id")
                ),
                array(
                    "table" => "usuarios",
                    "alias" => "ResponsavelDemanda",
                    "type" => "LEFT",
                    "conditions" => array("ResponsavelDemanda.id = Demanda.atividade_usuario_id")
                )
            ),
            'fields' => array(
                'Demanda.id',
                'Demanda.demanda_origem_id',
                'Demanda.nome',
                'Demanda.data_cancelamento',
                'Demanda.data_conclusao',
                'Demanda.data_inicio',
                'Demanda.data_prevista_termino',
                'Usuario.first_name',
                'Usuario.last_name',
                'Processo.nome',
                'Processo.duracao',
                'StatusDemanda.nome',
                'StatusDemanda.cor',
                'ResponsavelDemanda.first_name',
                'Demanda.percentual_conclusao',
                'Demanda.fase'
            ),
            'conditions' => (!$rs ) ? array('Demanda.id > ' => 0) : $rs,
            'group' => 'Demanda.id',
            'limit' => $this->getParametros()->getParametro('paginator')
        );

        if ( isset( $processo_id ) ){
            
            $opt['conditions']['Demanda.processo_id'] = $processo_id;
        }

        $this->paginate = $opt;
        
        $fields = json_encode( $parametros );

        $demanda = $this->paginate( 'Demanda' );

        $this->set( 'demandas', $demanda );
        $this->set( 'fields', $fields );

        if ( isset( $processo_id ) ){
            
            $this->set('processo_id', $processo_id );
        }
    }

    private function salvaAtividades( &$atividades, $demanda_id, $parent_id=NULL, $action="Add" ){//02
/*
a.      Caso ela tenha filhas:

            i.   data_real_inicio       - Pegar a menor data de início real dentre as filhas (que não estejam canceladas)
            ii.  date_real_termino      - Pegar a maior data de término dentre as filhas (que não estejam canceladas).
            1.   Caso alguma filha esteja em aberto, a data de término a ser utilizada então será vazio para a mãe.
            iii. data_prevista_inicio   - Pegar a menor data de início prevista dentre as filhas (que não estejam canceladas)
            iv.  data_prevista_termino  - Pegar a maior data de término prevista dentre as filhas (que não estejam canceladas)
            v.   responsavel_usuario_id - Pegar o usuário id da última atividade (que tenha responsável e que não esteja cancelada)
            vi.  duracao                - Soma das durações das atividades folha.
            vii. dias_uteis             - Sempre null
 
b.      Caso ela NÃO tenha filhas:
 
            i.   Duração - Duração informada pelo usuário
 
c.      Para qualquer atividade (com ou sem filhas):
 
            i.   Quanto ao status_id: Utilizando as regras que temos hoje, setar o id (pela tabela de status)
 
*/

        foreach ( $atividades as $i => $atividade ){
            
            $atividade['demanda_id']            = $demanda_id;
            $atividade['parent_id']             = (empty($parent_id)?null:$parent_id);
            $atividade["percentual_conclusao"]  = substr( $atividade["percentual_conclusao"],0,-1 );
            
            $atividade['data_real_inicio']      = (empty( $atividade['data_real_inicio'] )) ? null :  $atividade['data_real_inicio'];
            $atividade['data_real_termino']     = (empty( $atividade['data_real_termino'] )) ? null : $atividade['data_real_termino'];
            $atividade['data_cancelamento']     = (empty( $atividade['data_cancelamento'] )) ? null : $atividade['data_cancelamento'];

            if( $atividade["percentual_conclusao"] === "100" || $atividade["percentual_conclusao"] === "100.00" ){

                $atividade["data_real_termino"] = date('d/m/Y');
                if( is_null( $atividade['data_real_inicio'] ) ){
                    
                    $atividade['data_real_inicio'] = $atividade['data_prevista_inicio'];
                }
            }
            
            if ( isset( $atividade['children'] ) ){
                
                $this->setDemandaByAtividades( $atividade['children'], $atividade, true );
            }

            $this->Demanda->Atividade->getStatus( $atividade );
            
            $atividades[$i] = $atividade;

            $this->Demanda->Atividade->save( $atividade );

            if( isset( $atividade['children'] ) ){
                
                $this->salvaAtividades( $atividade['children'], $demanda_id, $this->Demanda->Atividade->id );
            }
            
            if( !$atividade['emitir'] ){} else {
                
                
                $this->Aviso->enviaAvisosAtividade( $atividade['id'], $atividade['emitir'] );
            }            
        }
    }

    public function cancelar(){
        
        $this->autoRender = false;
 
        if ( $this->request->is('post') || $this->request->is('put') ){

            $this->Demanda->id = $this->request->data['demanda_id'];

            if ( !$this->Demanda->exists() ) {
                
                $this->alert('Demanda '.$this->request->data['demanda_id'].' inexistente!','error');
                return $this->redirect( 'index' );
                
            } else {
                
                echo json_encode( $this->request->data['demanda_id'] );
            }
        }
    }
    
    public function cancelar_demanda(){

        $this->autoRender = false;

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Demanda->id = $this->request->data['Demanda']['id'];

            if (!$this->Demanda->exists()) {
                
                $this->alert('Demanda '.$this->request->data['Demanda']['id'].' inexistente!','error');
                 $this->redirect( 'index' );
                
            } else {
                
                $this->request->data['Demanda']['data_cancelamento']   = date('Y-m-d H:i:s');
                $this->request->data['Demanda']['status_atividade_id'] = 5;

                if ($this->Demanda->save( $this->request->data )) {

                    $this->cancelaAtividades( $this->request->data['Demanda']['id'] );
                    
                    $this->alert('Demanda '.$this->request->data['demanda_id'].' cancelada com sucesso!','success');
                    $this->redirect($this->referer());
                    
                }
            }
        }
    }
    
    private function cancelaAtividades( $demanda_id ){//05
        
        if( empty( $demanda_id ) ){return false;}
        
        $atividades = $this->Demanda->Atividade->find( 'all', array(

            'conditions' => array(
                
                'Atividade.demanda_id' => $demanda_id
                
                )
            )
        );

        if( !empty( $atividades ) ){
            
            foreach ( $atividades as $i => $v ){

                $atividades[$i]['Atividade']['data_cancelamento']   = date('Y-m-d');
                $atividades[$i]['Atividade']['motivo_cancelamento'] = "Cancelamento da DEMANDA";
                $atividades[$i]['Atividade']['status_atividade_id'] = 5;
                
                $this->Demanda->Atividade->save( $atividades[$i]['Atividade'] );
            }
        }
    }
    
    private function setDemandaByAtividades( Array $atividades, &$demanda, $atividade_parent = false ){
        
        $inicio   = $this->Demanda->Atividade->getDateI(  $atividades );
        $termino  = $this->Demanda->Atividade->getDateT(  $atividades );
        $pinicio  = $this->Demanda->Atividade->getDatePI( $atividades );
        $ptermino = $this->Demanda->Atividade->getDatePT( $atividades );
        $cancel   = $this->Demanda->Atividade->getDateCancel(  $atividades );
        $usuario  = $this->Demanda->Atividade->getUser(   $atividades );
        $duracao  = $this->Demanda->Atividade->getDuracao( $atividades );
                
        if( $inicio && !is_null($inicio) ){      $demanda['data_real_inicio'] = $inicio; }
        if( $termino && !is_null($termino) ){    $demanda['data_real_termino'] = $termino; }
        if( $pinicio && !is_null($pinicio) ){    $demanda['data_prevista_inicio'] = $pinicio; }
        if( $ptermino && !is_null($ptermino) ){  $demanda['data_prevista_termino'] = $ptermino; }
        if( $cancel && !is_null($cancel) ){      $demanda['data_cancelamento'] = $cancel; }
        if( $usuario && !is_null($usuario) ){
            if( $atividade_parent ){
                
                $demanda['usuario_id'] = $usuario; 
            }else{ 
                $demanda['atividade_usuario_id'] = $usuario; 
                
            }
        }
        if( $duracao && !is_null($duracao) ){    $demanda['duracao'] = $duracao; }

    }

    public function add( $demanda_id = null ){
                
        
        if( $this->request->is( "post" ) || $this->request->is( "put" ) ){
           
                
            $atividades = json_decode( $this->request->data['Demanda']['atividades_json'], true );
            $files      = json_decode( $this->request->data['Demanda']['files'], true );

            $this->Demanda->create();
            $this->request->data['Demanda']['usuario_id'] = $this->UserAuth->getUsuarioId();

            $this->setDemandaByAtividades( $atividades, $this->request->data['Demanda'] );

            $this->Demanda->Atividade->getStatus( $this->request->data['Demanda'] );

            if( $this->Demanda->saveAll(  $this->request->data, array( 'deep' => true ) ) ){
                
                
                $this->alert('Demanda Criada com Sucesso!', 'success');
             
                $this->salvaAtividades( $atividades, $this->Demanda->id );

                if( isset( $files ) ){
                    
                    $arquivos = new ArquivosController();
                    
                    foreach ( $files as $i => $v ){
                        
                        $arquivos->save( $v, $this->Demanda->id );
                    }
                }
               
                         $this->redirect('index');
    
            }
            
            
        }

        $processos          = $this->Demanda->Processo->getActiveProcesses();
        $sugestao_demanda   = $this->Demanda->Processo->find('all',array(
            'fields'        => 'sugestao_demanda',
            'conditions'    => array( 'Processo.id' => $demanda_id ),
            'recursive'     => -1,
        ));
        
        $grupos             = $this->Demanda->Grupo->find( 'list', 
                array(
                    
                    'order'      => array( 'Grupo.nome' => 'ASC' ),
                    'recursive'  => -1,
                    )
                );
        
        $usuariosEnvolvidos = $this->Demanda->UsuariosEnvolvidos->find( 'list', 
                array(
                    'order' => array('UsuariosEnvolvidos.first_name' => 'ASC'),
                    'recursive'  => -1,
                    )
                );

        $categoria = $this->Demanda->Arquivo->CategoriaArquivo->find( 'list' );
        
        $grupo     = ( is_null( $demanda_id ) ? '' : $this->Demanda->Processo->findById( $demanda_id ) );
        $grupo     = (isset($grupo) && !empty($grupo)?$grupo['Grupo']['id']:'');
        
        $sugestao_demanda = ( count ( $sugestao_demanda ) >0 ) ? $sugestao_demanda[0]['Processo']['sugestao_demanda'] : '';

        
        $this->set( 'usuario', $this->Session->read('UserAuth.Usuario.nome') );
        $this->set( 'sugestao_demanda', $sugestao_demanda );
        $this->set( 'categorias', $categoria );
        $this->set( compact( 'processos', 'usuariosEnvolvidos', 'grupos' ) ); 
        $this->set( 'type', 'Add' );
        $this->set( 'demanda_id', $demanda_id );
        $this->set( 'grupo_id', $grupo );
        
        
        
    }
    
    public function edit( $id = null ){
        
        $this->Demanda->id = $id;
        if (!$this->Demanda->exists()){
            
            $this->alert('Demanda '.$id.' inexistente!','error');
            $this->redirect( 'index' );
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
         
             $valor  = json_decode($this->request->data['Demanda']['files'],true);
             
              for($i = 0; $i < count($valor); $i++){
                $montaArquivoArray[$i] = ($valor[$i]['Arquivo']);  
              }
              
              $this->request->data['Arquivo'] = $montaArquivoArray;
                    
          //  unset( $this->request->data['Arquivo'] );
            
            $this->request->data['Demanda']['data_prevista_termino'] = (!isset($this->request->data['Demanda']['data_prevista_termino'])?null:$this->request->data['Demanda']['data_prevista_termino']);

            $atividades = json_decode( $this->request->data['Demanda']['atividades_json'], true );
            $files      = json_decode( $this->request->data['Demanda']['files'], true );

            $this->salvaAtividades( $atividades, $this->Demanda->id, null, "Edit" );
            
            $this->setDemandaByAtividades( $atividades, $this->request->data['Demanda'] );
            
            $p = intval($this->Demanda->Atividade->getPercentualParent( $atividades, $this->request->data['Demanda']['duracao'] ));

            if( $p > 99 ){
                
                $this->request->data['Demanda']['data_conclusao'] = date('Y-m-d');
            }
            $this->request->data['Demanda']['percentual_conclusao'] = $p;

            $this->Demanda->Atividade->getStatus( $this->request->data['Demanda'] );
            
            $this->Demanda->saveAll( $this->request->data, array( 'deep' => true));
            
            
            debug($this->Demanda->getDataSource()->getLog(false, false));      
            
            
            
            //$this->Arquivo->saveAll($this->request->data['Arquivo']);
            
            
            
            
            $arquivos = new ArquivosController();
                          if (isset($files)){
                        foreach ($files as $i => $v){
                              $arquivos->save($v, $this->Demanda->id);
                           
                        }
                    }
              
               // $this->redirect($this->origReferer());
            
        }

        $this->Demanda->contain(array("Processo", "Grupo", "Usuario", "UsuariosEnvolvidos", "Arquivo" => array("Usuario", "CategoriaArquivo", "Atividade"), "Atividade" => array("Etapa", "Usuario", "UsuariosEnvolvidos" => array('fields' => array('id')))));
        $this->request->data = $this->Demanda->findById( $id );
        $this->Demanda->formataMultiplosUsuariosEnvolvidos( $this->request->data['Atividade'] );

        $date_ini = implode("/", array_reverse(explode("-", $this->request->data['Demanda']['data_inicio'])));
        $date_ter = implode("/", array_reverse(explode("-", $this->request->data['Demanda']['data_prevista_termino'])));
        $date_con = implode("/", array_reverse(explode("-", $this->request->data['Demanda']['data_conclusao'])));
        
        $this->request->data['Demanda']['data_inicio']              = $date_ini;
        $this->request->data['Demanda']['data_prevista_termino']    = $date_ter;
        $this->request->data['Demanda']['data_conclusao']           = $date_con;
        $this->request->data['Demanda']['demandante']               = $this->request->data['Usuario']['nome'];
        
        $categoria = $this->Demanda->Arquivo->CategoriaArquivo->find( 'list' );
        
        $creator_or_admin = $this->creatorOrAdmin( $this->request->data['Demanda'] );

        $this->set( 'creator_or_admin', $creator_or_admin );
        $this->set( 'categorias', $categoria );
        $this->set( 'demanda', $this->request->data );
        $this->set( 'demanda_id', $id );
        $this->set( 'type', 'Edit' );
//debug ($this->request->data);
        $this->add_edit_display("Edit");
        $this->render("add");
    }
    
    private function creatorOrAdmin( $demanda ){
        
        if( $this->UserAuth->isAdmin() ){
            return true;
        }
        
        if( !isset( $demanda['usuario_id'] ) ){
            return false;
        }
        
        if( $demanda['usuario_id'] == $this->UserAuth->getUsuarioId() ){
            return true;
        }
        return false;
    }

    private function add_edit_display($mode="Add"){
        
        if( $mode === "Add" ){
            $processos = $this->Demanda->Processo->find('list', array('conditions' => array('Processo.ativo' => 1)));
        }else{
            $processos = $this->Demanda->Processo->find( 'list' );
        }
        
        $grupos             = $this->Demanda->Grupo->find('list', array( 'order' => array( 'Grupo.nome' => 'ASC' ) ));
        $etapas             = $this->Demanda->Atividade->Etapa->find('list');
        $usuariosEnvolvidos = $this->Demanda->UsuariosEnvolvidos->find('list', array('order' => array('UsuariosEnvolvidos.first_name' => 'ASC')));

        $this->set( compact( 'processos', 'usuariosEnvolvidos', 'grupos', 'etapas' ) );
    }
    
    public function getAtividadesDemanda(){
        
        $this->autoRender = false;
        
        $processo_id      = (isset($this->request->data['processo_id'])?$this->request->data['processo_id']:null);
        $demanda_id       = (isset($this->request->data['demanda_id'])?$this->request->data['demanda_id']:null);
        $data_inicio      = (isset($this->request->data['data_inicio'])?$this->request->data['data_inicio']:null);
        $atividade_id     = (isset($this->request->data['atividade_id'])?$this->request->data['atividade_id']:null);
        $obj_atividades   = (isset($this->request->data['obj_atividades'])?$this->request->data['obj_atividades']:null);
        
        if( !is_null( $obj_atividades ) ){
            
            $this->Demanda->Atividade->propagaDatas( $obj_atividades, $data_inicio, $atividade_id );
            
            return json_encode( array_values ( $obj_atividades ) );
            
        }else if( !is_null( $demanda_id ) ){
            
            $atividades = $this->Demanda->Atividade->find('threaded', array(
                
                    "joins" => array(

                            array(

                                "table"         => "status_atividades",
                                "alias"         => "Status_Atividade",
                                "type"          => "INNER",
                                "conditions"    => array( "Status_Atividade.id = Atividade.status_atividade_id" )
                            )                     
                     ),
                    'conditions' => array('Atividade.demanda_id' => $demanda_id),
                    'order'      => array('Atividade.ordem' => 'ASC'
                    )
                )
            );

            if( empty( $atividades ) ){ return false; }

            $this->createChild( $atividades, $demanda_id );

            $atividades = $this->criaAtividades( $atividades, $demanda_id );

            return json_encode( array_values ( $atividades ) );
        }else if( !is_null( $processo_id ) ){
            
            $atividades = $this->Demanda->Atividade->Etapa->find('threaded', array(
                
                    'conditions' => array('Processo.id' => $processo_id),
                    'order'      => array('Etapa.ordem' => 'ASC'
                    ),
                )
            );
            if( empty( $atividades ) ){ return false; }

            $this->createEtapaChild( $atividades, $processo_id );

            $atividades = $this->criaNovaAtividades( $atividades, $processo_id );
            
            $this->Demanda->Atividade->propagaDatas( $atividades, $data_inicio );

            return json_encode( array_values ( $atividades ) );            
        }
    }

    private function criaAtividades( &$etapas ){

        if( empty( $etapas ) ){return false;}
        
        $this->makeDateForm( $etapas );

        $atividades = array();

            foreach ($etapas as $etapa) {

                $atividade = array(
                    
                    'id'                    => $etapa['id'],
                    'demanda_id'            => $etapa['demanda_id'],
                    'usuario_id'            => $etapa['usuario_id'],
                    'etapa_id'              => $etapa['etapa_id'],
                    'usuario_nome'          => (is_null($etapa['usuario_nome']))?"":$etapa['usuario_nome'],
                    'nome'                  => $etapa['nome'],
                    'descricao'             => $etapa['descricao'],
                    'duracao'               => $etapa['duracao'],
                    'status'                => $etapa['status'],
                    'cor'                   => $etapa['cor'],
                    'percentual_conclusao'  => $etapa['percentual_conclusao']."%",
                    'data_real_inicio'      => $etapa['data_real_inicio'],
                    'data_real_termino'     => $etapa['data_real_termino'],
                    'data_prevista_inicio'  => $etapa['data_prevista_inicio'],                    
                    'data_prevista_termino' => $etapa['data_prevista_termino'],                    
                    'ordem'                 => $etapa['ordem'],
                    'data_cancelamento'     => $etapa['data_cancelamento'],
                    'obs_diario'            => $etapa['obs_diario'],
                    'motivo_cancelamento'   => $etapa['motivo_cancelamento'],
                    'justifique_data'       => ( isset ( $etapa['justifique_data'] ) ? $etapa['justifique_data'] : '' ),
                    'acesso'                => $this->checkacesso( $etapa['id'],$this->UserAuth, $this->Session->read('UserAuth.Grupo') ),
                    'emitir'                => (isset($etapa['emitir'])?$etapa['emitir']:''),
                    'dados_acoes'           => (isset($etapa['dados_acoes'])?$etapa['dados_acoes']:''),
                    'grupo_id'              => (isset($etapa['grupo_id'])?$etapa['grupo_id']:''),
                );
                
                if (isset( $etapa['children'] ) ) {
                    
                    $atividade['children'] = $this->criaAtividades( $etapa['children'] );
                }
                $atividades[] = $atividade;
            }
        return $atividades;        
    }
    
    private function criaNovaAtividades( &$etapas ){//19

        if( empty( $etapas ) ){ return false; }
        
        $atividades = array();

            foreach ($etapas as $etapa){
                
                $atividade = array(
                    
                    'id'                    => rand(5000, 9999),
                    'demanda_id'            => '',
                    'usuario_id'            => '',
                    'etapa_id'              => $etapa['id'],
                    'usuario_nome'          => 'N/D',
                    'nome'                  => $etapa['nome'],
                    'descricao'             => $etapa['descricao'],
                    'duracao'               => $etapa['duracao'],
                    'percentual_conclusao'  => "0%",
                    'data_real_inicio'      => '',
                    'data_real_termino'     => '',
                    'data_prevista_inicio'  => '',                    
                    'data_prevista_termino' => '',
                    'data_cancelamento'     => '',
                    'ordem'                 => $etapa['ordem'],
                    'justifique_data'       => '',
                    'emitir'                => '',
                    'status'                => "Planejado",
                    'acesso'                => $this->checkacesso( $etapa['id'],$this->UserAuth, $this->Session->read('UserAuth.Grupo') ),
                    'dados_acoes'           => '',
                    'grupo_id'              => ''
                    
                );
                
                if (isset( $etapa['children'] ) ) {
                    
                    $atividade['usuario_nome'] = '';
                    $atividade['children']     = $this->criaNovaAtividades( $etapa['children'] );
                }
                $atividades[] = $atividade;
            }
        return $atividades;
    }    

    private function createChild( &$etapas, $processo_id ){
        
        if ( !$etapas ){ return false; }

        foreach ($etapas as $key => $etapa){
            
            if ( $etapa['Atividade']['demanda_id'] != $processo_id ){
                
                unset( $etapas[$key] );
                
            } else {
                
                $status   = $etapa['StatusAtividade']['nome'];
                $cor      = $etapa['StatusAtividade']['cor'];
                $nome     = $etapa['Usuario']['nome'];
                $duracao  = $etapa['Etapa']['duracao'];
                $grupo_id = $etapa['Etapa']['grupo_id'];
                
                $etapas[$key]['Atividade'] = array_merge( $etapas[$key]['Atividade'], array( 'usuario_nome' => $nome, 'duracao' => $duracao, 'cor' => $cor, 'status' => $status, 'grupo_id' => $grupo_id ) );                
                
                if ( count( $etapas[$key]['children'] ) > 0 ) {
                    
                    $this->createChild( $etapas[$key]['children'], $processo_id ); 
                    $etapas[$key]['Atividade']['children'] = $etapas[$key]['children'];
                    
                } else {
                    
                    unset($etapas[$key]['children']);
                }
                $etapas[$key] = $etapas[$key]['Atividade'];

            }
        }
    }

    private function createEtapaChild( &$etapas, $processo_id ){//20
        
        if ( !$etapas ){ return false; }
        
        foreach ($etapas as $key => $etapa){
            
            if ( $etapa['Etapa']['processo_id'] != $processo_id ){
                
                unset( $etapas[$key] );
                
            } else {
                
                if ( count( $etapas[$key]['children'] ) > 0 ) {
                    
                    $this->createEtapaChild( $etapas[$key]['children'], $processo_id ); 
                    $etapas[$key]['Etapa']['children'] = $etapas[$key]['children'];
                    
                } else {
                    
                    unset($etapas[$key]['children']);
                }
                $etapas[$key] = $etapas[$key]['Etapa'];
            }
        }
    }        
    
    public function setSLAinDate(){//16
        
        $this->autoRender = false;
        
        $date  = $this->request->data['date'];
        $sla   = intval( $this->request->data['sla'] );
        
        $data = $this->Processo->somar_dias_uteis($date, $sla, '');
        return json_encode($data);
    }
     
    private function makeDateForm( &$atividades ){//18
        
        if( empty( $atividades ) ){return false;}
        
        foreach ( $atividades as $i => $v ){
            
            $date_ini = implode("/", array_reverse(explode("-", $v['data_real_inicio'])));
            $date_ter = implode("/", array_reverse(explode("-", $v['data_real_termino'])));
            
            $date_ini_p = implode("/", array_reverse(explode("-", $v['data_prevista_inicio'])));
            $date_ter_p = implode("/", array_reverse(explode("-", $v['data_prevista_termino'])));
            
            $atividades[$i]['data_prevista_inicio']  = $date_ini_p;
            $atividades[$i]['data_prevista_termino'] = $date_ter_p;
            $atividades[$i]['data_real_inicio']  = $date_ini;
            $atividades[$i]['data_real_termino']  = $date_ter;
        }
    }
    
    
    public function checkOrign(){//19
        
        $this->autoRender = false;
        
        if ($this->request->is('post')){
            
            if( isset( $this->request->data['origem'] ) ){
                
                $demanda = $this->Demanda->findById( $this->request->data['origem'] );
                echo json_encode($demanda['Demanda']);
            }
        }
    } 
    
    private function checkUserInGroup( $grupo_a_ser_checado_id, $grupos_array ){//20
        
        if( !empty( $grupos_array ) ){
            
            foreach ( $grupos_array as $i => $v ){

                if( $v['id'] == $grupo_a_ser_checado_id ){ return true; }
            }
            return false;
        }
    }
    
    private function checkIfExist( $value, Array $array ){//21
        
        $envolvido_demanda = false;

        foreach ($array as $i => $v) {

            if ($v['id'] == $value) {

                $envolvido_demanda = true;
            }
        }
        return $envolvido_demanda;
    }

    public function checkacesso( $atividade_id, $user_session, $grupos_array ){
        
        $this->autoRender  = false;
        
        $usuariologado_id  = $user_session->getUsuarioId();
        
        $atividades_acoes  = array(
            
            "assumir"  => false,
            "delegar"  => false,
            "concluir" => false,
            "cancelar" => false,
            "editar"   => false,
            "anexar"   => false
        );
        
        if ($user_session->isAdmin()){
            
            $atividades_acoes['assumir']  = true;
            $atividades_acoes['delegar']  = true;
            $atividades_acoes['concluir'] = true;
            $atividades_acoes['cancelar'] = true;
            $atividades_acoes['editar']   = true;
            $atividades_acoes['anexar']   = true;
        }

        $atividade = $this->Demanda->Atividade->find('all', array(
                     
            "conditions" => array( "Atividade.id" => $atividade_id )
        ));

        if( count( $atividade ) > 0 ){
            
            $pertence_ao_etapa_grupo    = $this->checkUserInGroup( $atividade[0]['Etapa']['grupo_id'],$grupos_array );
            $envolvido_demanda          = $this->checkIfExist( $usuariologado_id, $atividade[0]['UsuariosEnvolvidos'] );
            $criador_demanda            = ( $atividade[0]['Demanda']['usuario_id'] == $usuariologado_id ) ? true : false;  

            if( $atividade[0]['Atividade']['usuario_id'] == $usuariologado_id ){
                
                $atividades_acoes['concluir'] = true;
                $atividades_acoes['delegar']  = true;
                $atividades_acoes['cancelar'] = true;
                $atividades_acoes['editar']   = true;
                $atividades_acoes['anexar']   = true;
                
            } else if( $pertence_ao_etapa_grupo || $envolvido_demanda ){
                
                $atividades_acoes['assumir'] = true;
                
            } else if( $criador_demanda ){
                
                $atividades_acoes['cancelar'] = true;
            }
        }
        return $atividades_acoes;
    }
    
    public function updateDemandaByAtividade( $demanda_id, $parent_id_atividade_modificada, $child_id=null ){
/*
a.      Caso ela tenha filhas:

            i.   data_real_inicio       - Pegar a menor data de início real dentre as filhas (que não estejam canceladas)
            ii.  date_real_termino      - Pegar a maior data de término dentre as filhas (que não estejam canceladas).
            1.   Caso alguma filha esteja em aberto, a data de término a ser utilizada então será vazio para a mãe.
            iii. data_prevista_inicio   - Pegar a menor data de início prevista dentre as filhas (que não estejam canceladas)
            iv.  data_prevista_termino  - Pegar a maior data de término prevista dentre as filhas (que não estejam canceladas)
            v.   responsavel_usuario_id - Pegar o usuário id da última atividade (que tenha responsável e que não esteja cancelada)
            vi.  duracao                - Soma das durações das atividades folha.
            vii. dias_uteis             - Sempre null
 
b.      Caso ela NÃO tenha filhas:
 
            i.   Duração - Duração informada pelo usuário
 
c.      Para qualquer atividade (com ou sem filhas):
 
            i.   Quanto ao status_id: Utilizando as regras que temos hoje, setar o id (pela tabela de status)
 
*/
        if ( !empty( $demanda_id ) && !is_null( $demanda_id ) ) {
            
            if( !is_null($parent_id_atividade_modificada) && !empty($parent_id_atividade_modificada) ){

                $atividade = $this->Demanda->Atividade->find( 'all', array(

                    "fields"     => array(
                        "id",
                        "data_real_inicio",
                        "data_real_termino",
                        "data_prevista_inicio",
                        "data_prevista_termino",
                        "data_cancelamento",
                        "duracao",
                        "status_atividade_id",
                        "usuario_id",
                        "percentual_conclusao"
                    ),
                    "conditions" => array(
                        "Atividade.demanda_id"          => $demanda_id,
                        "Atividade.parent_id"           => $parent_id_atividade_modificada
                    ),
                    "order"      => array( 'ordem' => 'asc' ),
                    "recursive"  => -1
                ));

                $inicio   = $this->Demanda->Atividade->getDateI(  $atividade );
                $termino  = $this->Demanda->Atividade->getDateT(  $atividade );
                $pinicio  = $this->Demanda->Atividade->getDatePI( $atividade );
                $ptermino = $this->Demanda->Atividade->getDatePT( $atividade );
                $cancel   = $this->Demanda->Atividade->getDateCancel(  $atividade );
                $usuario  = $this->Demanda->Atividade->getUser(   $atividade );
                $duracao  = $this->Demanda->Atividade->getDuracao( $atividade );
                $percent  = $this->Demanda->Atividade->getPercentualParent( $atividade, $duracao );
                
                if( $inicio && !is_null($inicio) ){      $atividade_pai['data_real_inicio'] = $inicio; }
                if( $termino && !is_null($termino) ){    $atividade_pai['data_real_termino'] = $termino; }
                if( $pinicio && !is_null($pinicio) ){    $atividade_pai['data_prevista_inicio'] = $pinicio; }
                if( $ptermino && !is_null($ptermino) ){  $atividade_pai['data_prevista_termino'] = $ptermino; }
                if( $cancel && !is_null($cancel) ){      $atividade_pai['data_cancelamento'] = $cancel; }
                if( $usuario && !is_null($usuario) ){    $atividade_pai['usuario_id'] = $usuario; }
                if( $duracao && !is_null($duracao) ){    $atividade_pai['duracao'] = $duracao; }
                if( $percent && !is_null($percent) ){    $atividade_pai['percentual_conclusao'] = $percent; }
                
                $atividade_pai['id'] = $parent_id_atividade_modificada;

                if( !$this->Demanda->Atividade->save( $atividade_pai ) ){
                    return false;
                }

            }
            $options = array(
                'conditions' => array('id' => $demanda_id),
                'recursive'  => -1
            );
            
            $demanda_ = $this->Demanda->find( 'all', $options )[0];

            $demanda['Demanda']['id']                    = $demanda_id;
            $demanda['Demanda']['duracao']               = $demanda_['Demanda']['duracao'];
            $demanda['Demanda']['data_real_inicio']      = $demanda_['Demanda']['data_real_inicio'];
            $demanda['Demanda']['data_real_termino']     = $demanda_['Demanda']['data_real_termino'];
            $demanda['Demanda']['data_prevista_inicio']  = $demanda_['Demanda']['data_prevista_inicio'];
            $demanda['Demanda']['data_prevista_termino'] = $demanda_['Demanda']['data_prevista_termino'];
            $demanda['Demanda']['data_cancelamento']     = $demanda_['Demanda']['data_cancelamento'];
            $demanda['Demanda']['atividade_usuario_id']  = $demanda_['Demanda']['atividade_usuario_id'];
            $demanda['Demanda']['percentual_conclusao']  = $demanda_['Demanda']['percentual_conclusao'];
            
            $atividade = $this->Demanda->Atividade->find('all', array(
                
                "fields" => array(
                    "id",
                    "data_real_inicio",
                    "data_real_termino",
                    "data_prevista_inicio",
                    "data_prevista_termino",
                    "data_cancelamento",
                    "duracao",
                    "status_atividade_id",
                    "usuario_id",
                    "percentual_conclusao"
                ),
                "conditions" => array(
                    "Atividade.demanda_id" => $demanda_id,
                    //"Atividade.data_cancelamento" => null,
                    "Atividade.parent_id" => NULL
                ),
                "order" => array('ordem' => 'asc'),
                "recursive" => -1
            ));
            //atualização da demanda//

            $p = $this->Demanda->Atividade->getPercentualParent( $atividade, $demanda['Demanda']['duracao'] );

            if( $p > 99 ){
                
                $demanda['Demanda']['data_conclusao'] = date('Y-m-d');
            }
            $demanda['Demanda']['percentual_conclusao'] = $p;

            $this->setDemandaByAtividades( $atividade, $demanda['Demanda'] );
            $this->Demanda->Atividade->getStatus( $demanda['Demanda'] );

            if( $this->Demanda->save( $demanda ) ) {

                return true;
            }else{
                return false;
            }
        }
    }
    
//---------Edit by furious-----------//        
}