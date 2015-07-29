<?php

App::uses('AppModel', 'Model');

class Atalho extends AppModel {

    public $displayField = 'nome';
    public $belongsTo = array('Usuario');

}
