<?php

App::uses('CakeEmail', 'Network/Email');

class Permission extends AppModel {

    var $belongsTo = array('Grupo');

    public function addPermissoes($permissoes, $info) {
        foreach ($permissoes as $grupo_id => $actions) {
            foreach ($actions as $action => $allowed) {
                $this->recursive = -1;
                $permissao = $this->find('first', array('conditions' => array(
                        'Permission.grupo_id' => $grupo_id,
                        'Permission.controller' => $info['controller'],
                        'Permission.action' => $action,
                        'Permission.conteudo_id' => $info['conteudo_id']
                )));
                if (count($permissao)) {
                    $permissao = $permissao['Permission'];
                    $permissao['descricao'] = $info['descricao'];
                    $permissao['allowed'] = $allowed;
                    $dados[] = $permissao;
                } else
                    $dados[] = array('grupo_id' => $grupo_id,
                        'controller' => $info['controller'],
                        'action' => $action,
                        'conteudo_id' => $info['conteudo_id'],
                        'descricao' => $info['descricao'],
                        'allowed' => $allowed
                    );
            }
        }
        $this->saveMany($dados);
    }

    public function addPermissoesGrupo($permissoes, $grupo_id) {
        $kx=0;
        foreach ($permissoes as $controller => $actions){
            if((++$kx)>1) {
                foreach ($actions as $action => $ids){
                    foreach ($ids as $conteudo_id => $id_allowed){
                        foreach ($id_allowed as $id => $allowed){
                            if (!$conteudo_id){ $conteudo_id = null; }
                            $aux = array('id'          => $id
                                       , 'controller'  => $controller
                                       , 'action'      => $action
                                       , 'conteudo_id' => $conteudo_id
                                       , 'grupo_id'    => $grupo_id
                                       , 'allowed'     => $allowed);
                            //debug ($aux);
                            $dados[] = array('Permission' => $aux);
                        }
                    }
                }
            }
        }
        //debug($dados);
        return $this->saveMany($dados);
    }

    private function getPermissoes($user_group_permissions, $controllerList, $grupo_id = 0) {
//debug($user_group_permissions);
//debug($controllerList);
        if(count($user_group_permissions)>0){
            foreach ($user_group_permissions as $k => $v) {
                $conteudo_id = (!isset($v["Permission"]["conteudo_id"])?0:$v["Permission"]["conteudo_id"]);
                $token = $v["Permission"]["controller"]."/".$v["Permission"]["action"]."/".$conteudo_id;
                $aux[$token] = ['controller'  => $v["Permission"]["controller"]
                              , 'action'      => $v["Permission"]["action"]
                              , 'conteudo_id' => $conteudo_id
                              , 'descricao'   => (!isset($v["Permission"]["descricao"])?"":$v["Permission"]["descricao"])
                              , 'id'          => (!isset($v["Permission"]["id"])?0:$v["Permission"]["id"])
                              , 'allowed'     => ($v["Permission"]["allowed"]?"1":"0")];
            }
            $user_group_permissions = $aux; 
        }
//debug($aux);
        foreach ($controllerList as $k => $v) {
            $aux = ['controller'  => $v["controller"],
                    'action'      => $v["action"],
                    'conteudo_id' => ($v["conteudo_id"]==""?"0":$v["conteudo_id"]),
                    'descricao'   => $v["descricao"],
                    'id'          => "0",
                    'allowed'     => "0"];
            //if ($arr_key === false){
            $token = $aux["controller"]."/".$aux["action"]."/".$aux["conteudo_id"];
            if (!isset($user_group_permissions[$token])){
                //debug("INSERT - ".$token);
                $user_group_permissions[] = $aux;
            }else{
                //debug("UPDATE - ".$token);
                //$aux["allowed"] = 1;
                $user_group_permissions[$token]["controller"]  = $aux["controller"];
                $user_group_permissions[$token]["action"]      = $aux["action"];
                $user_group_permissions[$token]["conteudo_id"] = $aux["conteudo_id"];
                $user_group_permissions[$token]["descricao"]   = $aux["descricao"];
            }
        }
        //debug($user_group_permissions);
        $this->array_multisort_fields($user_group_permissions
                                    , array("controller", "action", "conteudo_id")
                                    , array(SORT_ASC, SORT_ASC, SORT_ASC));

        return $user_group_permissions;
    }

    public function getFreePermissions(){
        return ['AppCombos/makeCombo'
              , 'App/alert', 'App/getLogevent', 'App/getParametros', 'App/origReferer', 'App/setReferer', 'App/setSessionCrumb', 'App/createJson', 'App/getParamsUrl', 'App/afterSave', 'App/checkAccess'
              , "Atalhos/add", "Atalhos/delete", "Atalhos/show"
              , "Arquivos/download"
              , "AvisosEtapas/view", "AvisosEtapas/getAvisos", "AvisosEtapas/add", "AvisosEtapas/delete"
              , "BreadCrumbSistema/delete", "BreadCrumbSistema/close"
              , "GenericFilters/mountFilter", "GenericFilters/getElements"
              , "Grupos/ajax_grupos_usuarios", "Grupos/view"
              , "Historicos/index"
              , "Menus/index", "Menus/controller_list_menu", "Menus/menu", "Menus/elementos_menu", "Menus/bpm_menu", "Menus/perfil", "Menus/ajax_treegrid", "Menus/open"
              , "Onvalites/getValidate"
              , "Pages/display", "Pages/display/home"
              , "Permissions/index", "Permissions/index_usergroup"
              , "Relatorios/bpm", "Relatorios/download", "Relatorios/menu", "Relatorios/view"
              , "Sandbox/index", "Sandbox/search", "Sandbox/autocomplete", "Sandbox/index2", "Sandbox/menu"
              , "Buscas/getlist", "Buscas/index"
              , "Usuarios/myprofile", "Usuarios/login", "Usuarios/logout", "Usuarios/register", "Usuarios/requestPassword", "Usuarios/changePassword", "Usuarios/verifyEmail", "Usuarios/acesso_negado", "Usuarios/userVerification", "Usuarios/forgotPassword", "Usuarios/activatePassword", "Usuarios/emailVerification", "Usuarios/escolher_fundo_pagina_inicial"
              , "ToolbarAccess/history_state", "ToolbarAccess/sql_explain"
              , "TwitterBootstrap/index"
              , 'Arquivos/setFile'
              , 'Atividades/return_json_request_data'
              , 'Atividades/getAtividades'
              , 'Atividades/checkAviso'
              , 'Atividades/subAtividades'
              , 'Demandas/getAtividadesDemanda'
              , 'Demandas/createChild'
              , 'Demandas/setSLAinDate'
              , 'Demandas/checkOrign'
              , 'Demandas/checkacesso'
              , 'Etapas/ajax_template'
              , 'Etapas/return_json_request_data'
              , 'Etapas/ajax_treegrid'
              , 'Etapas/subEtapas'
              , 'Menus/reordena'
              , 'Permissions/update_group'
              , 'Pivots/ajax_process'
              , 'Pivots/view'
              , 'Pivots/lista_distinct_campo'
              , 'Processos/propagAtividade'
              , 'Processos/createChild'
              , 'Processos/setSLAinDate'
              , 'Processos/getGrupo'
              , 'Processos/checkchildren'
              , 'Processos/getProcess'
              , 'Processos/getSugestaoDemandaNome'
              , 'Processos/updateProcess'
              , 'Processos/ajax_usuarios_do_grupo_do_processo'
            ];
    }
            
    private function mergeArrayPermissions($controllerList=null) {
        //debug($controllerList);
        if(!is_null($controllerList)){
            $exceptionList = $this->getFreePermissions();
//debug($exceptionList);
            
            foreach ($controllerList as $controller=>$v) {
                foreach ($v as $k=>$action) {
                    //debug($controller."/".$action);
                    if(!in_array($controller."/".$action,$exceptionList)){
                        $aux = array("controller"=>$controller,"action"=>$action,"conteudo_id"=>"","id"=>"","descricao"=>__($controller." ".$action));
                        //debug($aux);
                        //debug($ret);
                        //$ret = array_merge($ret,$aux);
                        $ret[$controller."/".$action] = $aux;
                    }
                }
            }
            //debug($ret);
        }
        foreach( $this->getArrayPermissionReports() as $k=>$v){
            $ret[$k] = $v;    
        }
        foreach( $this->getArrayPermissionPivots() as $k=>$v){
            $ret[$k] = $v;    
        }
        ksort($ret);
        //debug($ret);
        return $ret;
    }
    
    private function getArrayPermissionReports() {
        $aux = ClassRegistry::init('Relatorio');
        $ret2 = $aux->find('all', array('fields' => array('DISTINCT Relatorio.id', 'Relatorio.nome')));
        foreach($ret2 as $v){
            $ret["Relatorios/".$v["Relatorio"]["nome"]."/".$v["Relatorio"]["id"]] = array("controller"=>"Relatorios","action"=>"view","conteudo_id"=>$v["Relatorio"]["id"], "id"=>"", "descricao"=>$v["Relatorio"]["nome"]);
        }
        unset($aux);
        unset($ret2);
        //debug($ret);
        return $ret;
    }
    
    private function getArrayPermissionPivots() {
        $aux = ClassRegistry::init('Pivot');
        $ret2 = $aux->find('all', array('fields' => array('DISTINCT Pivot.id', 'Pivot.nome')));
        foreach($ret2 as $v){
            $ret["Pivot/".$v["Pivot"]["nome"]."/".$v["Pivot"]["nome"]] = array("controller"=>"Pivots","action"=>"view","conteudo_id"=>$v["Pivot"]["id"], "id"=>"", "descricao"=>$v["Pivot"]["nome"]);
        }
        unset($aux);
        unset($ret2);
        //debug($ret);
        return $ret;
    }
    
    public function getAllPermissoes($controllerList) {
        $this->recursive = -1;
        //$user_group_permissions = $this->find('all', array('fields' => array('DISTINCT Permission.controller', 'Permission.action', 'Permission.conteudo_id', 'Permission.descricao')));
        $user_group_permissions = array();
        return $this->getPermissoes($user_group_permissions, $this->mergeArrayPermissions($controllerList));
    }

    public function getPermissoesGrupo($controllerList, $grupo_id){
        $this->recursive = -1;
        $user_group_permissions = $this->find('all'
                                            , array('conditions' => array('Permission.grupo_id' => $grupo_id)
                                                  , 'fields' => array('Permission.controller'
                                                                    , 'Permission.action'
                                                                    , 'Permission.conteudo_id'
                                                                    , 'Permission.id'
                                                                    , 'Permission.descricao'
                                                                    , 'Permission.allowed')));
        return $this->getPermissoes($user_group_permissions, $this->mergeArrayPermissions($controllerList), $grupo_id);
    }

    public function getPermissoesConteudo(&$dados, $info) {
        $permissoes = $this->findAllByControllerAndConteudoId($info['controller'], $info['conteudo_id']);
        foreach ($permissoes as $permissao) {
            $dados[$permissao['Permission']['grupo_id']][$permissao['Permission']['action']] = $permissao['Permission']['allowed'];
        }
    }

    public function getConteudosIdDeUsuario($controller, $action, $usuario_id) {
        $grupos_id = $this->Grupo->getGrupoIdsDeUsuario($usuario_id);
        $permissions = $this->findAllByControllerAndActionAndGrupoIdAndAllowed($controller, $action, $grupos_id, 1);
        $conteudos_id = array();
        foreach ($permissions as $permission) {
            if (!$permission['Permission']['conteudo_id']) {
                return 'all';
                break;
            } else
                $conteudos_id[] = $permission['Permission']['conteudo_id'];
        }
        return $conteudos_id;
    }

}
