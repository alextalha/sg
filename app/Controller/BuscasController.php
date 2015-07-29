<?php

/*   busca
  * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppController', 'Controller');
App::uses('Menu', 'Model');

class BuscasController extends AppController {

    var $uses = array('Menu');

    public function index() {

        if ($this->request->is(array('post'))) {


            if (!empty($this->data)) {

                $valor = $this->data['Menus']['menu_search'];

                $list = $this->Menu->find('list', array(
                    'fields' => array('Menu.nome', 'Menu.descricao', 'Menu.url'),
                    'conditions' => array('Menu.nome LIKE' => "%$valor%"),
                    'recursive' => -1
                ));
            }

            if (!empty($list)) {

                foreach ($list as $k => $v) {
                    echo $k;
                }


                echo $this->redirect($k);
            } else {

                $this->redirect($this->origReferer());
            }
        } else {


            // busca somente pelo formulário senão volta ...
            $this->redirect($this->origReferer());
        }
    }

    public function getlist() {


        $this->autoRender = false;

        error_reporting(0);
        if ($this->request->is(array('post'))) {
            $list = $this->Menu->find('list', array(
                'fields' => array('nome'),
                'recursive' => -1
            ));

            foreach ($list as $v) {
                $lista[] = $v;
            }

            return json_encode($lista);
        }
    }

}
