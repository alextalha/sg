<?php

App::uses('AppModel', 'Model');

class Grupo extends AppModel {

    public $displayField = 'nome';
    //public $hasMany = array('Permission', "Processo", "Demanda");
    public $hasMany = array(
        'Processo' => array(
            'className' => 'Processo',
            'foreignKey' => 'grupo_id',
            'dependent' => false
        ),
        'Demanda' => array(
            'className' => 'Demanda',
            'foreignKey' => 'grupo_id',
            'dependent' => false
        ),
        'Permission' => array(
            'className' => 'Permission',
            'foreignKey' => 'grupo_id',
            'dependent' => true
        ), 
        'Grupo' => array(
            'className' => 'Etapa',
            'foreignKey' => 'grupo_id',
            'dependent' => false
        )
    );    
    public $hasAndBelongsToMany = array(
        'Usuario' => array(
            'className' => 'Usuario',
            'joinTable' => 'grupos_usuarios',
            'foreignKey' => 'grupo_id',
            'associationForeignKey' => 'usuario_id',
            'unique' => 'keepExisting'
        )
    );
    
    var $validate = array(
        'nome' => array(
            'mustNotEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter name',
                'last' => true),
            'mustUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This name already taken',
                'last' => true),
            'mustBeLonger' => array(
                'rule' => array('minLength', 4),
                'message' => 'Name must be greater than 3 characters',
                'last' => true),
        )
    );    

    public function getGrupoIds() {
        $grupos = $this->find('list');
        return array_keys($grupos);
    }

    public function getGrupoIdsDeUsuario($usuario_id) {
        $usuario = $this->Usuario->find('first', array('conditions' => array('Usuario.id' => $usuario_id), 'contain' => array("Grupo")));
        if (!isset($usuario['Grupo']) || !count($usuario['Grupo']))
            return array(GUEST_GROUP_ID);
        foreach ($usuario['Grupo'] as $grupo)
            $grupos[] = $grupo['id'];
        return $grupos;
    }

    public function getListGruposTemAcesso($usuario_id) {
        if ($this->Usuario->isAdmin($usuario_id))
            return $this->find('list');
        $usuario = $this->Usuario->find('first', array('conditions' => array('Usuario.id' => $usuario_id), 'contain' => array("Grupo")));
        foreach ($usuario['Grupo'] as $grupo)
            $grupos[$grupo['id']] = $grupo['nome'];
        return $grupos;
    }

    public function usuarioPertenceAlgumDosGrupos($usuario_id, $grupos) {
        $this->Usuario->contain(array("Grupo" => array('conditions' => array('Grupo.id' => $grupos))));
        $usuario = $this->Usuario->findById($usuario_id);
        return (count($usuario['Grupo']) > 0);
    }

    public function usuarioTemAcesso($usuario_id, $grupo_id) {
        // Usuário precisa ser do grupo
        return ($this->Usuario->isAdmin($usuario_id) || $this->usuarioPertenceAlgumDosGrupos($usuario_id, $grupo_id));
    }

    public function getEmailsUsuariosGrupos($grupos_id) {
        $this->contain(array("Usuario"));
        $grupos = $this->findAllById($grupos_id);
        $emails_usuarios = "";
        foreach ($grupos as $grupo)
            foreach ($grupo['Usuario'] as $usuario)
                $emails_usuarios .= $usuario['email'] . ",";
        return $emails_usuarios;
    }

    public function isGrupoAccess($controller, $action, $grupos_id, $conteudo_id = null) {
        $ret = false;
        
        $includeGuestPermission = false;
        if ( !PERMISSIONS ) {
            $ret = true;
        }else{
            // Validate if groups has been informed
            if (!is_array($grupos_id))
                $grupos_id = array($grupos_id);

            // Validate if user has admin permissions, the allow full access
            if ( in_array( ADMIN_GROUP_ID, $grupos_id ) ) { // && !ADMIN_PERMISSIONS
                $ret = true;
            }else{
                // Get all allowed permissions from groups of user
                $permissions = $this->getAllPermissions($grupos_id);

                //debug( $permissions );
                // If wanted access is is permissions list, allow access
                $access = str_replace(' ', '', ucwords(str_replace('_', ' ', $controller))) . '/' . $action;
                if (in_array($access, $permissions)){
                    $ret = true;
                }else{
                    if ($conteudo_id)
                        $access .= "/" . $conteudo_id;
                    
                    // if view as content controlled, check if it is in allowed list from user groups
                    //AQUI
                    if (in_array($access, $permissions) ){
                        $ret = true;
                    }
                }
            }
        }
        return $ret;
    }

    public function isGuestAccess($controller, $action) {
        if (PERMISSIONS) {
            return $this->isGrupoAccess($controller, $action, GUEST_GROUP_ID);
        } else {
            return true;
        }
    }

    public function getAllPermissions( $grupos_id ){
        
        if (!is_array($grupos_id))
            $grupos_id = array($grupos_id);
        
        $permissions = array();
        foreach ($grupos_id as $grupo_id)
            $permissions = array_merge($permissions, $this->getPermissions($grupo_id));
        
        return $permissions;
    }

    public function getPermissions($userGroupID) {
        $permissions = array();
        
        /**
         * Discard cache funcionality for permission rules
         */
        // using the cake cache to store rules
        //$cacheKey = 'rules_for_group_' . $userGroupID;
        //$actions = Cache::read($cacheKey, 'UsuarioMgmt');
        //if ($actions === false) {
            $actions = $this->Permission->findAllByGrupoIdAndAllowed($userGroupID, 1);
            //Cache::write($cacheKey, $actions, 'UsuarioMgmt');
        //}
        foreach($this->Permission->getFreePermissions() as $k=>$v){
            $aux = explode("/",$v);
            $actions[] = array('Permission' => array('id' => 0,
			                             'grupo_id' => $userGroupID,
                                                     'controller' => $aux[0],
                                                     'action' => $aux[1],
                                                     'conteudo_id' => (isset($aux[2])?$aux[2]:null),
                                                     'descricao' => null,
                                                     'allowed' => true,
                                                     'created' => null,
                                                     'modified' => null)
                );
        }
        
        //debug( $actions );
        //die;
        
        foreach ($actions as $action) {
            $permission = $action['Permission']['controller'] . '/' . $action['Permission']['action'];
            if (isset($action['Permission']['conteudo_id']))
                $permission .= '/' . $action['Permission']['conteudo_id'];
            $permissions[] = $permission;
        }
        
        return $permissions;
    }

    public function getGroupNames() {
        $this->recursive = -1;
        $result = $this->find("all", array("order" => "id"));
        $grupos = array();
        foreach ($result as $row) {
            $grupos[] = $row['Grupo']['nome'];
        }
        return $grupos;
    }

    public function getGroupNamesAndIds() {
        $this->recursive = -1;
        $result = $this->find("all", array("order" => "id"));
        $grupos = array();
        foreach ($result as $row) {
            $grupos[] = array(
                'id' => $row['Grupo']['id'],
                'nome' => $row['Grupo']['nome'],
                'alias_name' => $row['Grupo']['alias_name']
            );
        }
        return $grupos;
    }

    public function getGroups() {
        $this->recursive = -1;
        $grupos = $this->find("list", array("conditions" => array('nome !=' => "Guest")));
        $grupos[-2] = '== Selecione ==';
        ksort($grupos);
        return $grupos;
    }

    public function getGroupByName($name) {
        $this->recursive = -1;
        $result = $this->findAllByName($name);
        return $result[0]['Grupo']['nome'];
    }

    public function getGroupsForRegistration() {
        $this->unbindModel(array('hasMany' => array('Permission')));
        $result = $this->find("all", array("order" => "id", "conditions" => array('allowRegistration' => 1)));
        $grupos = array();
        $grupos[0] = 'Select';
        foreach ($result as $row) {
            $grupos[$row['Grupo']['id']] = $row['Grupo']['nome'];
        }
        return $grupos;
    }

    function isAllowedForRegistration($groupId) {
        $result = $this->findById($groupId);
        if (!empty($result)) {
            if ($result['Grupo']['allowRegistration'] == 1)
                return true;
        }
        return false;
    }

}
