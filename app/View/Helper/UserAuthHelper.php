<?php
/*
	This file is part of UsuarioMgmt.

	Author: Chetan Varshney (http://ektasoftwares.com)

	UsuarioMgmt is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	UsuarioMgmt is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
*/
class UserAuthHelper extends AppHelper {

	/**
	 * This helper uses following helpers
	 *
	 * @var array
	 */
	var $helpers = array('Session');
	/**
	 * Used to check whether user is logged in or not
	 *
	 * @access public
	 * @return boolean
	 */
	public function isLogged() {
		return ($this->getUsuarioId() !== null);
	}
	/**
	 * Used to get user from session
	 *
	 * @access public
	 * @return array
	 */
	public function getUsuario() {
		return $this->Session->read('UserAuth');
	}
	/**
	 * Used to get user id from session
	 *
	 * @access public
	 * @return integer
	 */
	public function getUsuarioId(){
		return $this->Session->read('UserAuth.Usuario.id');
	}
	/**
	 * Used to get group id from session
	 *
	 * @access public
	 * @return integer
	 */
	public function getGrupoIds() {
		return $this->Session->read('UserAuth.Usuario.grupo_id');
	}
        
        public function getGroupsIds(){
            
            $grupo = $this->Session->read('UserAuth')['Grupo'];
            //debug( $grupo );
            $grupos = '';
            if( count($grupo) == 1 ){
                
                foreach ( $grupo as $i => $v ){
                    
                    $grupos = '"'.$v['id'].'"';
                }                
            }else if( count($grupo) > 1 ){
                
                foreach ( $grupo as $i => $v ){
                    if( empty( $grupos ) ){
                        $grupos .= '["' . $v['id'] .'"';
                    }else{
                        $grupos .= ',"'.$v['id'].'"';
                    }
                }
                $grupos .= ']';
            }else{
                $grupos = '[]';
            }
            return $grupos;
        }
        /**
	 * Used to get group name from session
	 *
	 * @access public
	 * @return string
	 */
	/*public function getGroupName() {
		return $this->Session->read('UserAuth.Grupo.alias_name');
	}
	/**
	 * Used to check is admin logged in
	 *
	 * @access public
	 * @return string
	 */
	public function isAdmin() {
		$groupId = $this->Session->read('UserAuth.Grupo.0.id');
		if($groupId==ADMIN_GROUP_ID) {
			return true;
		}
		return false;
	}
	/**
	 * Used to check is guest logged in
	 *
	 * @access public
	 * @return string
	 */
	/*public function isGuest() {
		$groupId = $this->Session->read('UserAuth.Usuario.grupo_id');
		if(empty($groupId)) {
			return true;
		}
		return false;
	}*/
	public function showCaptcha($error) {
		App::import("Vendor", "recaptcha/recaptchalib");
		$code = recaptcha_get_html(PUBLIC_KEY_FROM_RECAPTCHA, $error, true);
		return $this->output($code);
	}
}