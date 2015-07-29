<?php

class UsuariosController extends AppController {

    public $uses = array('Usuario', 'Grupo', 'LoginToken');
    
    private function checaSeUsuarioLogadoTemAcesso($action,$id="") {
        $path = "Usuarios/".$action.($id!=""?"/".$id:"");
        if(!$this->checkAccess($path)){
            $this->alert("Sorry, You don't have permission to view that page.", 'error');
            $this->redirect('index');
            return false;
        }
        return true;
    }

    public function beforeFilter(){
        
        parent::beforeFilter();
        $this->Usuario->userAuth = $this->UserAuth;
        
    }

    public function index() {

        $this->checaSeUsuarioLogadoTemAcesso("index");
        
        $this->Usuario->contain(array("Grupo", "Cargo"));
        
        $parametros = (isset( $this->Session->read('filters_grid')['usuarios'] ))?$this->Session->read('filters_grid')['usuarios']:"";
        $rs  = $this->getParamsUrl( $parametros );

        $opt = array(
            "joins" => array(
                    array(
                        "table"         => "grupos_usuarios",
                        "alias"         => "GrupoUsuario",
                        "type"          => "LEFT",
                        "conditions"    => array( "Usuario.id = GrupoUsuario.usuario_id" )
                    ),
                    array(
                        "table"         => "grupos",
                        "alias"         => "Grupo",
                        "type"          => "LEFT",
                        "conditions"    => array( "Grupo.id = GrupoUsuario.grupo_id" )
                    )
             ),
            'conditions' => ( !$rs ) ? array( 'Usuario.id > ' => 0 ) : $rs,
            'group'      => 'Usuario.id',
            'limit'      => $this->getParametros()->getParametro('paginator')
        );
        
        $this->paginate = $opt;
        
        $fields = json_encode( $parametros );
        
        $this->Usuario->recursive = 0;
        $users  = $this->paginate( 'Usuario' );

        $this->set( 'users',  $users );
        $this->set( 'fields', $fields );
        
    }

    
    /**
     * Used to logged in the site
     *
     * @access public
     * @return void
     */
    public function login() {
        // Only accept login request's from post requests
        if ($this->request->isPost()) {
            $this->Usuario->set($this->data);
            if ($this->Usuario->LoginValidate()) {
                
                // check user by username
                $user = $this->Usuario->Demanda->recursive=-1;
                $user = $this->Usuario->findByUsername($this->data['Usuario']['username']);
                if (empty($user)) {
                    // if not found, check user by email
                    $user = $this->Usuario->findByEmail($this->data['Usuario']['username']);
                    if (empty($user)) {
                        $this->alert('Incorrect Email/Username or Password','error');
                        $this->redirect(LOGOUT_REDIRECT_URL);
                    }
                }

                // check for inactive account
                if ($user['Usuario']['id'] != 1 and $user['Usuario']['active'] == 0) {
                    $this->alert('Sorry your account is not active, please contact to Administrator','error');
                    $this->redirect(LOGOUT_REDIRECT_URL);
                }

                // check for verified account
                if ($user['Usuario']['id'] != 1 and $user['Usuario']['email_verified'] == 0) {
                    $this->alert('Your registration has not been confirmed please verify your email or contact to Administrator','error');
                    $this->redirect(LOGOUT_REDIRECT_URL);
                }
                
                // hashing informed password
                $hashed = $this->UserAuth->makePassword($this->data['Usuario']['password'], $user['Usuario']['salt']);
  
                // Verify user password
                if ($user['Usuario']['password'] === $hashed) {
                    
                    // Registering user login on session 
                    $this->UserAuth->login( $user );

                    // Setting "remember me" cookie
                    $remember = (!empty($this->data['Usuario']['remember']));
                    if ($remember) { $this->UserAuth->persist('4 weeks'); }
                    
                    // Get current user groups and permissions from user
                    $grupos = $this->Grupo->getGrupoIdsDeUsuario($user['Usuario']['id']);
                    foreach ($this->Grupo->getAllPermissions($grupos) as $row) {
                        $this->Session->write('Permissions.' . $row, true);
                    }

                    // Get original url before login request to redirect after login
                    $OriginAfterLogin = $this->Session->read('OriginAfterLogin');
                    $this->Session->delete('OriginAfterLogin');
                    $redirect = (!empty($OriginAfterLogin) || !is_null($OriginAfterLogin)) ? $OriginAfterLogin : LOGIN_REDIRECT_URL;
                    $this->redirect($redirect);

                } else {
                    $this->alert('Incorrect Email/Username or Password','error');
                    $this->redirect(LOGOUT_REDIRECT_URL);
                }
            }
        }
       
    }

    /**
     * Used to logged out from the site
     *
     * @access public
     * @return void
     */
    public function logout() {
        
        $this->UserAuth->logout();
        $this->Session->delete('Permissions');
        $this->Session->destroy();
        $this->alert('You are successfully signed out');
        $this->redirect(LOGOUT_REDIRECT_URL);
    }

    /**
     * Used to change the password by user
     *
     * @access public
     * @return void
     */
    public function changePassword() {
        
        if ( $this->request->isPost() || $this->request->isPut() ) {
        
            $this->Usuario->set($this->data);
            
            if ( $this->Usuario->RegisterValidate() ) {
                
                $user = array();
                $user['Usuario']['id'] = $this->UserAuth->getUsuarioId();
                $salt = $this->UserAuth->makeSalt();
                $user['Usuario']['salt'] = $salt;
                $user['Usuario']['password'] = $this->UserAuth->makePassword($this->request->data['Usuario']['password'], $salt);
                $this->Usuario->save($user, false);
                $this->LoginToken->deleteAll(array('LoginToken.usuario_id' => $user['Usuario']['id']), false);
                $this->alert('Password changed successfully', 'success');
                $this->redirect('myprofile');
            }
        }
    }

    /**
     * Used to change the user password by Admin
     *
     * @access public
     * @param integer $userId user id of user
     * @return void
     */
    public function changeUsuarioPassword() {
        
        if ( !empty( $this->request->data['user'] ) ) {
            
            $this->checaSeUsuarioLogadoTemAcesso("edit");
            
            $name = $this->Usuario->getNameById( $this->request->data['user'] );

            $this->set('name', $name);
            $this->set('usuario_id', $this->request->data['user']);
            
            if ($this->request->is('post')) {
                
                $this->autoRender = false;
                $data = array();
                $data['Usuario']['password']  = $this->request->data['password'];
                $data['Usuario']['cpassword'] = $this->request->data['cpassword'];
                
                $this->Usuario->set( $data );
                
                if ( $this->Usuario->RegisterValidate() ) {
                    
                    $user = array();
                    $user['Usuario']['id'] = $this->request->data['user'];
                    $salt = $this->UserAuth->makeSalt();
                    $user['Usuario']['salt'] = $salt;
                    $user['Usuario']['password'] = $this->UserAuth->makePassword($this->request->data['password'], $salt);
                    $this->Usuario->save($user, false);
                    $this->LoginToken->deleteAll(array('LoginToken.usuario_id' => $this->request->data['user']), false);
                    
                }
                $errors = $this->Usuario->validationErrors;
                $status = $this->Usuario->RegisterValidate();
                $msg = array( 'msg'=>$errors,'status'=>$status,'link'=>$this->origReferer() );
                echo json_encode( $msg );
            }
        } else {
            //$this->redirect('index');
        }
    }

    /**
     * Persist users data to database 
     *
     * @access private
     * @param integer $id user id of user
     * @param boolean $profile identifys that only a read request of profile page
     * @return void
     */
    private function add_edit($id=null,$profile=false) {
        
        $type = "add";
        if(!is_null($id)){
            $type = ($profile? "myprofile": "edit");    
        }
        
        $this->checaSeUsuarioLogadoTemAcesso($type);
        
        if ($this->request->isPost() || $this->request->isPut()){
            $this->Usuario->set( $this->request->data['Usuario'] );
            if ( $this->Usuario->RegisterValidate() ) {
                if( is_null( $id ) ){   // Add
                    $this->Usuario->create();    
                    
                    $this->request->data['Usuario']['email_verified'] = 1;
                    $this->request->data['Usuario']['active'] = 1;

                    $this->request->data['Usuario']['salt'] = $this->UserAuth->makeSalt();

                    $this->request->data['Usuario']['password'] = $this->UserAuth->makePassword($this->request->data['Usuario']['username'], $this->request->data['Usuario']['salt']);
                    $this->request->data['Usuario']['cpassword'] = $this->UserAuth->makePassword($this->request->data['Usuario']['username'], $this->request->data['Usuario']['salt']);

                    //$this->request->data['Usuario']['action']   = 'add';
                } else {                // Edit
                    $this->Usuario->id = $id;
                    if (!$this->Usuario->exists()) {            
                        throw new NotFoundException(__('Invalid %s', __('Usuario')));
                    }
                }
                
                if ( $this->Usuario->save( $this->request->data ) ) {
                    if($type == "add"){
                        //$this->Usuario->sendRegistrationMail($this->request->data);
                    }
                    $this->alert('Usuario Criado', 'success');
                    $this->redirect(array('action' => 'index'));
                }else{
                    $this->alert('Usuario não pode ser criado', 'error');
                }
            }
        }else{  // Read database data
            $this->request->data = $this->Usuario->findById($id);
        }
        $grupos = $this->Usuario->Grupo->find('list');
        $cargos = $this->Usuario->Cargo->find('list');
        $this->set(compact('grupos', 'cargos'));
        $this->set( 'type', $type );
        $this->render("edit");
    }
    
    /**
     * Show my user data
     *
     * @access public
     * @param none
     * @return void
     */
    public function myprofile() {
        $this->add_edit($this->UserAuth->getUsuarioId(), true);
    }

    /**
     * Add a user to database
     *
     * @access public
     * @param none
     * @return void
     */
    public function add(){
        $this->add_edit();
    }

    /**
     * Edit a user stored on database
     *
     * @access public
     * @param integer $id user id of user
     * @return void
     */
    public function edit($id = null) {
        $this->add_edit($id);
    }    

    /**
     * Used to delete the user by Admin
     *
     * @access public
     * @param integer $userId user id of user
     * @return void
     */
    public function delete( $id = null ) {
        
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        $this->checaSeUsuarioLogadoTemAcesso("delete");
        
        $user = $this->Usuario->find('all',array('conditions' => 'Usuario.id', $id));
        
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        
        if ($this->Usuario->delete()) {
            $this->alert('Usuario deleted', 'success');
        }else{
            $this->alert('Usuario NOT removed', 'error');
        }
        $this->redirect(array('action' => 'index'));
    }
    /**
     * Used to activate or deactivate user by Admin
     *
     * @access public
     * @param integer $userId user id of user
     * @param integer $active active or inactive
     * @return void
     */
    private function makeActiveInactive($userId = null, $active = 0) {
        
        if (!empty($userId)) {
            
            $user = array();
            $user['Usuario']['id'] = $userId;
            $user['Usuario']['active'] = ($active) ? 1 : 0;
            $this->Usuario->save($user, false);
            
            if ($active) {
                
                $this->alert('Usuario is successfully activated', 'success');
            } else {
                $this->alert('Usuario is successfully deactivated', 'success');
            }
        }
        $this->redirect('/usuarios');
    }

    public function ativar($usuario_id = null) {
        $this->checaSeUsuarioLogadoTemAcesso("ativar");
        
        $this->makeActiveInactive($usuario_id, 1);
    }

    public function desativar($usuario_id = null) {
        $this->checaSeUsuarioLogadoTemAcesso("desativar");
        
        $this->makeActiveInactive($usuario_id, 0);
    }

    /**
     * Used to show access denied page if user want to view the page without permission
     *
     * @access public
     * @return void
     */
    public function acesso_negado() {
        //$this->alert("Sorry, You don't have permission to view that page.", 'error');
        $this->alert("Desculpe, você não tem permissão para acessar este conteúdo.", 'error');
        $this->redirect(Router::url("/", true));
        //header('Location: '.Router::url("/", true));
        //die;
        //die;
    }

    /**
     * Used to send forgot password email to user
     *
     * @access public
     * @return void
     */
    public function forgotPassword(){
        if ($this->request->isPost()){
            $this->Usuario->set($this->data);
            if ($this->Usuario->LoginValidate()) {
                $email = $this->data['Usuario']['username'];
                $user = $this->Usuario->findByUsername($email);
                if (empty($user)) {
                    $user = $this->Usuario->findByEmail($email);
                    if (empty($user)) {
                        $this->alert('Incorrect Email/Username','error');
                        //return;
                    }
                }
                // check for inactive account
                if ($user['Usuario']['id'] != 1 and $user['Usuario']['email_verified'] == 0) {
                    $this->alert('Your registration has not been confirmed yet please verify your email before reset password','error');
                    //return;
                }
                $this->alert($this->Usuario->forgotPassword($user), 'success');
                $this->alert('Please check your mail for reset your password', 'success');
                $this->redirect('/');
            }
        }
    }

    /**
     *  Used to reset password when user comes on the by clicking the password reset link from their email.
     *
     * @access public
     * @return void
     */
    public function activatePassword() {
        if ($this->request->isPost()) {
            if (!empty($this->data['Usuario']['ident']) && !empty($this->data['Usuario']['activate'])) {
                $this->set('ident', $this->data['Usuario']['ident']);
                $this->set('activate', $this->data['Usuario']['activate']);
                $this->Usuario->set($this->data);
                if ($this->Usuario->RegisterValidate()) {
                    $userId = $this->data['Usuario']['ident'];
                    $activateKey = $this->data['Usuario']['activate'];
                    $FAIL_LINK = Router::url("activatePassword?ident=$userId&activate=$activateKey", true);
                    $user = $this->Usuario->read(null, $userId);
                    if (!empty($user)) {
                        $password = $user['Usuario']['password'];
                        $thekey = $this->Usuario->getActivationKey($password);
                        //debug($thekey );
                        //debug($activateKey);
                        //die;
                        if ($thekey == $activateKey) {
                            $_SESSION['UserAuth']['Usuario']['id'] = $userId; // Trick to log (P 1/2)
                            $user['Usuario']['password'] = $this->data['Usuario']['password'];
                            $salt = $this->UserAuth->makeSalt();
                            $user['Usuario']['salt'] = $salt;
                            $user['Usuario']['password'] = $this->UserAuth->makePassword($user['Usuario']['password'], $salt);
                            $this->Usuario->save($user, false);
                            unset($_SESSION['UserAuth']);                   // Trick to log (P 1/2)
                            $this->alert('Your password has been reset successfully');
                            $this->redirect('/');
                        } else {
                            $this->alert('Invalid activation key','error');
                            $this->redirect($FAIL_LINK);
                        }
                    } else {
                        $this->alert('Fail to identify user','error');
                        $this->redirect($FAIL_LINK);
                    }
                }
            } else {
                $this->alert('Something went wrong, please click again on the link in email','warning');
                $this->redirect('/');
            }
        } else {
            if (isset($_GET['ident']) && isset($_GET['activate'])) {
                $this->set('ident', $_GET['ident']);
                $this->set('activate', $_GET['activate']);
            }
        }
    }

    public function escolher_fundo_pagina_inicial( $fundo ){
        
        if ( $this->request->isPost() ) {
            
            $this->Usuario->id = $this->UserAuth->getUsuarioId();
            $this->Usuario->saveField('fundo_pagina_inicial', $fundo);
            $this->Session->write('UserAuth.Usuario.fundo_pagina_inicial', $fundo);
            
        }
    }
}
