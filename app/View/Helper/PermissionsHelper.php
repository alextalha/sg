<?php
class PermissionsHelper extends AppHelper {
    
    var $helpers = array('Session');
    
    function check($path){
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