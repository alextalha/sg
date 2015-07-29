<?php

/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Model',     'Model');
App::uses('Logevento', 'Model');
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model{
    
    private function getUserSession(){

        App::uses('CakeSession', 'Model/Datasource');
        $Session = new CakeSession();
        $user = $Session->read('UserAuth');
        return $user;
    }

    public function beforeDelete($cascade = true){

        $controller = Router::getParams()['controller'];
        $action     = Router::getParams()['action'];        
        
        $entity = $this->alias;
        $userId     = $this->getUserSession()['Usuario']['id'];

        $log = ClassRegistry::init( 'Logevento' );
        
        $log->createLog(

            $userId,    
            $entity,
            $action,
            $controller.':' . $this->id . ';' . $action . ";link:1",
            $this->id
        );
    }
    
    public function afterSave( $created, $options = array() ){
        
        //alter table logeventos add entidade_id int(11)
        $exceptions = array(
            
            "Logevento", 
            "Session",
            //"Etapa",
            //"Processo"
        );

        $controller = Router::getParams()['controller'];
        $action     = Router::getParams()['action'];

        $entity     = $this->alias;
        $userId     = $this->getUserSession()['Usuario']['id'];

        if( in_array( $entity, $exceptions ) ){ return false; }

        //$log = ClassRegistry::init( 'Logevento' );
        
       // $log->createLog(

         //   $userId,
         //   $entity,
         //   $action
           // $controller.':' . $this->data[$entity]['id'] . ';' . $action. ";link:1",
           //
      //  );
    }

    public $actsAs = array( 'Containable' );

    public function getSubArraysWithThisKey($array, $key, &$results) {
        if (!is_array($array))
            return;

        if (isset($array[$key]) && count($array[$key])) {
            if (isset($array[$key][0]))
                $results = array_merge($results, $array[$key]);
            else
                $results[$array[$key]['id']] = $array[$key];
        } else
            foreach ($array as $subarray) {
                if (is_array($subarray))
                    $this->getSubArraysWithThisKey($subarray, $key, $results);
            }
    }
    
    public function in_array_fields($fields, $array, $subarray_name = null) {
        $count = count($fields);
        foreach ($array as $value) {
            $ret = 0;
            foreach ($fields as $field) {
                $subarray = ($subarray_name) ? $value[$subarray_name] : $value;
                if ($subarray[$field['name']] == $field['value']) {
                    $ret++;
                }
            }
            if ($ret == $count)
                break;
        }
        return ($ret == $count);
    }
    
    public function in_array_fields_key($fields, $array, $subarray_name = null) {
        $count = count($fields);
        $found = false;
        foreach ($array as $key=>$value) {
            $ret = 0;
            foreach ($fields as $field) {
                $subarray = ($subarray_name) ? $value[$subarray_name] : $value;
                if ($subarray[$field['name']] == $field['value']) {
                    $ret++;
                }
            }
            if ($ret == $count){
                $found = true;
                break;
            }
                
        }
        //debug($key);
        if ($found == false)
            $key=false;
        
        return $key;
    }

    public function array_multisort_fields(&$array, $sort_fields, $asc_desc) {
        $sort = array();
        $param = array();
        if (count($array) > 1) {
            foreach ($array as $k => $v) {
                foreach ($sort_fields as $s => $sort_field) {
                    $sort[$sort_field][$k] = (!empty($v[$sort_field])) ? $v[$sort_field] : '';
                }
            }
            foreach ($sort_fields as $s => $sort_field) {
                $param[] = &$sort[$sort_field];
                $param[] = $asc_desc[$s];
            }
            $param[] = &$array;
            call_user_func_array("array_multisort", $param);
        }
    }

    // usado em AppController.subAtividades
    public function formataUsuariosEnvolvidos(&$elemento) {
        if ($elemento) {
            foreach ($elemento['UsuariosEnvolvidos'] as $u => $usuario) {
                if ($usuario['id'])
                    $elemento['UsuariosEnvolvidos'][$u] = $usuario['id'];
                else
                    unset($elemento['UsuariosEnvolvidos'][$u]);
            }
        }
    }

    // usado em DemandasController.edit
    public function formataMultiplosUsuariosEnvolvidos(&$elementos) {
        if ($elementos)
            foreach ($elementos as $t => $elemento) {
                $this->formataUsuariosEnvolvidos($elementos[$t]);
            }
    }

    /*
      _tsl
      - Trata o excedente de caracteres de uma string. Utilizada comumente na apresentação de dados.
      - Parâmetros:
      $_entrada: Texto a ser tratado;
      $_limite : Limite de caracters. Default: 25;
     */

    public function reticencias_apos_limite_caracteres($_entrada, $_limite = 25) {
        $_limite = ($_limite == 0 ? 25 : $_limite);
        if (strlen($_entrada) > $_limite) {
            return substr($_entrada, 0, $_limite) . "...";
        } else {
            return $_entrada;
        }
    }

}
