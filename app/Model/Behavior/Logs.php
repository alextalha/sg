<?php

/*
 * by Furious
 */

App::import('Model', 'Log');
App::import('Component', 'Session');

class LogsBehavior extends ModelBehavior {

    /**
     * Current model
     *
     * @var Object
     */
    private $Model;

    /**
     * Session component object
     *
     * @var Object
     */
    private $Session;

    /**
     * Old data
     * last data from model before modified
     *
     * @var array
     */
    private $_oldData;

    /**
     * New data
     * new value from model after modified
     *
     * @var array
     */
    private $_newData;

    /**
     * Model log
     *
     * @var Object
     */
    private $Log;

    /**
     * Action
     * type of action called
     *
     * @var string
     */
    private $_action;

    /**
     * Deleted id
     * id from data to delete
     *
     * @var int
     */
    private $_deletedId;

    /**
     * Setup method
     *
     * Configure this behavior
     *
     * @param ObjectModel $model
     * @param array $config
     */
    public function setup(&$model, $config = null) {

        $this->Model    = $model;
        $this->Session  = new SessionComponent();
        $this->Log      = new Log();
    }

    /**
     * Before save
     *
     * @param ObjectModel $model
     * @return boolean true
     */
    public function beforeSave( &$model ) {

        if ( is_numeric( $this->Model->id ) ) {

            $this->_action = 'edit';
            $newData = $this->Model->find('first', array('conditions' => array("{$this->Model->name}.id" => $this->Model->data[$this->Model->name]['id'])));

            foreach ($newData[$this->Model->name] as $input => $value) {
                $this->_oldData .= "$input :: $value";
            }
        } else {
            
            $this->_action = 'add';
        }
        return true;
    }

    /**
     * After save
     *
     * @param objectModel $model
     * @param string $created
     * @return boolean true
     */
    public function afterSave( &$model, $created ) {

        $newData = $this->Model->read(null, $this->Model->id);
        foreach ($newData[$this->Model->name] as $input => $value) {

            $this->_newData .= "$input :: $value";
        }
        $this->write();
        return true;
    }

    /**
     * Before delete
     *
     * @param objectModel $model
     * @param boolean $cascade
     * @return boolean true
     */
    public function beforeDelete( &$model, $cascade = true ) {

        $this->_action = 'delete';
        $this->_deletedId = $this->Model->data[$this->Model->name]['id'];
        $newData = $this->Model->read(null, $this->_deletedId);

        foreach ($newData[$this->Model->name] as $input => $value) {
            
            $this->_oldData .= "$input :: $value";
        }

        return true;
    }

    /**
     * After delete action
     *
     * @param ObjectModel $model
     * @return boolean true
     */
    public function afterDelete( &$model ) {
        
        $this->write();
        return true;
    }

    /**
     * Write log
     *
     * @return void
     */
    public function write() {
        
        if ($this->Model->name == 'Log'){
            
            return true;
        }
        $this->Log->id = null;
        $this->Log->save(array(
            
            'Log' => array(
                
                'authuser_id' => $this->Session->read('Usuario.id'),
                'model'       => $this->Model->name,
                'action'      => $this->_action,
                'old_data'    => $this->_oldData,
                'new_data'    => $this->_newData
            )
        ));
    }

}
