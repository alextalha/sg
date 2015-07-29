<?php

App::uses('CakeEmail', 'Network/Email');

class Usuario extends AppModel {

    public $virtualFields = array(
        
          'nome' => 'CONCAT(first_name, " ", last_name)'
    );
    
    public $displayField = 'nome';    
    
    var $belongsTo = array('Cargo');
    var $hasMany = array('Atividade','Parametro', 'Demanda', 'LoginToken' => array('className' => 'LoginToken', 'limit' => 1));
    
    public $hasAndBelongsToMany = array(
        
        'Demanda' => array(
            'className' => 'Demanda',
            'joinTable' => 'demandas_usuarios',
            'foreignKey' => 'usuario_id',
            'associationForeignKey' => 'demanda_id',
            'unique' => 'keepExisting'
        ),
        'Grupo' => array(
            'className' => 'Grupo',
            'joinTable' => 'grupos_usuarios',
            'foreignKey' => 'usuario_id',
            'associationForeignKey' => 'grupo_id',
            'unique' => 'keepExisting'
        )
        
        );

    var $validate = array(
        'username' => array(
            'mustNotEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter username',
                'last' => true),
            'mustUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This username already taken',
                'last' => true),
            'mustBeLonger' => array(
                'rule' => array('minLength', 4),
                'message' => 'Username must be greater than 3 characters',
                'last' => true),
        ),
        'email' => array(
            'mustNotEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter email',
                'last' => true),
            'mustBeEmail' => array(
                'rule' => array('email'),
                'message' => 'Please enter valid email',
                'last' => true),
            'mustUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This email is already registered',
            )
        ),
        'password' => array(
            'mustNotEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter password',
                'on' => 'create',
                'last' => true),
            'mustBeLonger' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password must be greater than 5 characters',
                'on' => 'create',
                'last' => true),
            'mustMatch' => array(
                'rule' => array('verifies'),
                'message' => 'Both passwords must match'),
            'on' => 'create'
        ),
        'cpassword' => array(
            'mustNotEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter password',
                'on' => 'create',
                'last' => true),
            'mustBeLonger' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password must be greater than 5 characters',
                'on' => 'create',
                'last' => true),
            'mustMatch' => array(
                'rule' => array('verifies'),
                'message' => 'Both passwords must match'),
            'on' => 'create'
        )
    );

    /**
     * UsetAuth component object
     *
     * @var object
     */
    var $userAuth;

    /**
     * model validation array
     *
     * @var array
     */
        
    function LoginValidate() {
        $validate1 = array(
            'email' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter email or username')
            ),
            'password' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter password')
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    function RegisterValidate() {
        $validate1 = array(
            'username' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter username',
                    'last' => true),
                'mustUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'This username already taken',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 4),
                    'message' => 'Username must be greater than 3 characters',
                    'last' => true),
            ),
            'first_name' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter first name')
            ),
            'email' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter email',
                    'last' => true),
                'mustBeEmail' => array(
                    'rule' => array('email'),
                    'message' => 'Please enter valid email',
                    'last' => true),
                'mustUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'This email is already registered',
                )
            ),
            'oldpassword' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter old password',
                    'last' => true),
                'mustMatch' => array(
                    'rule' => array('verifyOldPass'),
                    'message' => 'Please enter correct old password'),
            ),
            'password' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter password',
                    'on' => 'create',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 6),
                    'message' => 'Password must be greater than 5 characters',
                    'on' => 'create',
                    'last' => true),
                'mustMatch' => array(
                    'rule' => array('verifies'),
                    'message' => 'Both passwords must match'),
            //'on' => 'create'
            ),
            'captcha' => array(
                'mustMatch' => array(
                    'rule' => array('recaptchaValidate'),
                    'message' => ''),
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function recaptchaValidate() {
        App::import("Vendor", "recaptcha/recaptchalib");
        $recaptcha_challenge_field = (isset($_POST['recaptcha_challenge_field'])) ? $_POST['recaptcha_challenge_field'] : "";
        $recaptcha_response_field = (isset($_POST['recaptcha_response_field'])) ? $_POST['recaptcha_response_field'] : "";
        $resp = recaptcha_check_answer(PRIVATE_KEY_FROM_RECAPTCHA, $_SERVER['REMOTE_ADDR'], $recaptcha_challenge_field, $recaptcha_response_field);
        $error = $resp->error;
        if (!$resp->is_valid) {
            $this->validationErrors['captcha'][0] = $error;
        }
        return true;
    }

    public function verifies() {
        return ($this->data['Usuario']['password'] === $this->data['Usuario']['cpassword']);
    }

    public function verifyOldPass() {
        $userId = $this->userAuth->getUsuarioId();
        $user = $this->findById($userId);
        $oldpass = $this->userAuth->makePassword($this->data['Usuario']['oldpassword'], $user['Usuario']['salt']);
        return ($user['Usuario']['password'] === $oldpass);
    }

    /**
     * Used to generate activation key
     *
     * @access public
     * @param string $password user password
     * @return hash
     */
    public function getActivationKey($password) {
        $salt = Configure::read("Security.salt");
        return md5(md5($password) . $salt);
    }

    /**
     * Used to send forgot password mail to user
     *
     * @access public
     * @param array $user user detail
     * @return void
     */
    public function forgotPassword($user) {
        $userId = $user['Usuario']['id'];
        $activate_key = $this->getActivationKey($user['Usuario']['password']);
        $link = Router::url("/activatePassword?ident=$userId&activate=$activate_key", true);
        $body = "Olá " . $user['Usuario']['first_name'] . ", vamos te ajudar a acessar o sistema.

Você solicitou uma mudança de senha. Clique no link abaixo para seguir com o procedimento:

" . $link . "


Se o link não funcionar, copie-o e cole-o na barra de endereços do seu navegador. 

Escolha uma senha que se lembre e mantenha-a segura.

Agradecemos,
Time TRIAD";
        try {
            $result = ClassRegistry::init("Aviso")->sendEmail('Recuperação de Senha', $body, $user['Usuario']['email']);
            if ($result) {
                $result = __('E-mail enviado.');
            }
        } catch (Exception $ex) {
            $result = "O e-mail de recuperação de senha não pode ser enviado para o usuário com ID " . $userId;
        }
        $this->log($result, LOG_DEBUG);
        return $result;
    }

    /**
     * Used to mark cookie used
     *
     * @access public
     * @param string $type
     * @param string $credentials
     * @return array
     */
    public function authsomeLogin($type, $credentials = array()) {
        switch ($type) {
            case 'guest':
                // You can return any non-null value here, if you don't
                // have a guest account, just return an empty array
                return array();
            case 'cookie':
                $loginToken = false;
                if (strpos($credentials['token'], ":") !== false) {
                    list($token, $userId) = split(':', $credentials['token']);
                    $duration = $credentials['duration'];

                    $loginToken = $this->LoginToken->find('first', array(
                        'conditions' => array(
                            'usuario_id' => $userId,
                            'token' => $token,
                            'duration' => $duration,
                            'used' => false,
                            'expires <=' => date('Y-m-d H:i:s', strtotime($duration)),
                        ),
                        'contain' => false
                    ));
                }
                if (!$loginToken) {
                    return false;
                }
                $loginToken['LoginToken']['used'] = true;
                $this->LoginToken->save($loginToken);

                $conditions = array(
                    'Usuario.id' => $loginToken['LoginToken']['usuario_id']
                );
                break;
            default:
                return array();
        }
        return $this->find('first', compact('conditions'));
    }

    /**
     * Used to generate cookie token
     *
     * @access public
     * @param integer $userId user id
     * @param string $duration cookie persist life time
     * @return string
     */
    public function authsomePersist($userId, $duration) {
        $token = md5(uniqid(mt_rand(), true));
        $this->LoginToken->create(array(
            'usuario_id' => $userId,
            'token' => $token,
            'duration' => $duration,
            'expires' => date('Y-m-d H:i:s', strtotime($duration)),
        ));
        $this->LoginToken->save();
        return "${token}:${userId}";
    }      
    
    /**
     * Used to get name by user id
     *
     * @access public
     * @param integer $userId user id
     * @return string
     */
    public function getNameById($userId) {
        $res = $this->findById($userId);
        return (!empty($res)) ? ($res['Usuario']['first_name'] . ' ' . $res['Usuario']['last_name']) : '';
    }

    public function getIdByNome($nome) {
        $res = $this->findByNome($nome);
        if ($res)
            return $res['Usuario']['id'];
        return 1;
    }

    /**
     * Used to check users by group id
     *
     * @access public
     * @param integer $groupId user id
     * @return boolean
     */
    public function isUsuarioAssociatedWithGroup($grupo_id) {
        return $this->Grupo->usuarioPertenceAlgumDosGrupos($this->Usuario->id, $grupo_id);
    }

    public function isAdmin($usuario_id) {
        if (in_array(ADMIN_GROUP_ID, $this->Grupo->getGrupoIdsDeUsuario($usuario_id))) {
            return true;
        }
        return false;
    }

    public function getPrimeiroGrupo($usuario_id) {
        $grupos = $this->Grupo->getGrupoIdsDeUsuario($usuario_id);
        return ($grupos[0]) ? $grupos[0] : GUEST_GROUP_ID;
    }
    
    public function getNomeGrupos() {
        $grupos = $this->Grupo->getGrupoIdsDeUsuario($this->Usuario->id);
     
        $ret = "";
        foreach ($grupos as $x) {
            $ret .= ", ".$x["nome"];
        }
        
        return substr($ret,3);
    }
}
