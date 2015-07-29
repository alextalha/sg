<?php

App::uses('AppModel', 'Model');

class Aviso extends AppModel {

    public $displayField = 'nome';
    public $hasMany = array('AvisoEtapa');
    public $hasAndBelongsToMany = array('Etapa');

    /**
     * Send mail to destination, change automatically data if necessary (and informed)
     *
     * @access public
     * @param string $subject subject of message
     * @param string $message message body to send
     * @param string $to destination identifier
     * @param array $data array of data do change in message body
     * 
     * @return void
     */
    
//    public function create($id,$model){
//          $model = str_replace('sController',"",$model);
//        $instanceModel = ClassRegistry::init($model);
//        
//        
//        if($model == 'Demanda'){
//            echo $model;
//            echo "dkflsdjaklsdfj";
//          
//            $x = $instanceModel->find('list');
//            
//        }
//        
//    }

    
    public function send($action, $to, $data = array()){
        $aviso = $this->findAllByAction($action);
        
        $subject = $aviso[0]['Aviso']['nome'];
        $message = $aviso[0]['Aviso']['mensagem'];
        
        // Fill data
        if(!empty($data)){ $message = $this->fillEmailMessageData($message, $data); }
        
        // Send mail
        $this->sendEmail($subject, $message, $to);
        die;
    }
    
    public function sendEmail( $subject, $message, $to){
        // SendMail
        //$email = new CakeEmail('smtp');
        $email = new CakeEmail('smtp');
        //$email->to( 'brunoalves.dev@gmail.com','fgraca@lepsus.com.br' );
        $email->from( EMAIL_FROM_ADDRESS , EMAIL_FROM_NAME );
        $email->to( $to );
        $email->subject( $subject );
        $email->send( $message );
        //$this->redirect('/');
    }

    public function fillEmailMessageData($message, $dados){
        
        foreach ($dados as $i => $dado) {
            
            $message = str_replace("%$i", $dado, $message);
        }
        return $message;
    }

    private function enviaAvisos($etapa_id, $atividade_id, $action){
        
        $avisos_configurados = $this->AvisoEtapa->findAllByEtapaId($etapa_id);
        if ($avisos_configurados){
            
            foreach ($avisos_configurados as $aviso){
                
                if ($aviso['Aviso']['action'] == $action){
                    
                    $to = $this->Etapa->Atividade->getDestinatariosAviso($aviso['AvisoEtapa']['destinatarios_aviso'], $atividade_id);
                    $dados = explode(",", $aviso['Aviso']['dados']);
                    $dados = $this->Etapa->Atividade->preencheDados($dados, $atividade_id);
                    $mensagem = $this->fillEmailMessageData($aviso['Aviso']['mensagem'], $dados);

                    $this->sendEmail($aviso['Aviso']['nome'], $mensagem, $to);
                }
            }
        }
    }

    public function enviaAvisosDemanda($demanda_id, $action) {
        $etapas_id = $this->Etapa->Atividade->field('etapa_id', array('Atividade.demanda_id' => $demanda_id));
        $atividades_id = $this->Etapa->Atividade->field('id', array('Atividade.demanda_id' => $demanda_id));
        $this->enviaAvisos($etapas_id, $atividades_id, $action);
    }

    public function enviaAvisosAtividade($atividade_id, $action) {
        $etapa_id = $this->Etapa->Atividade->field('etapa_id', array('Atividade.id' => $atividade_id));
        $this->enviaAvisos($etapa_id, $atividade_id, $action);
    }

}
