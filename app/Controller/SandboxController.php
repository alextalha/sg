<?php

App::uses('AppController', 'Controller');

class SandboxController extends AppController {

    public $uses = array();

    public function modelo() {

        $this->layout = 'pdf';
        $this->render();
        ob_flush();
    }

    public function index() {

        $to = "atalha_triad@timbrasil.com.br";
        $subject = "Dan dan dan dan dan";
        $message = "soc pum plaft booom";

        $email = new CakeEmail('smtp');
        $email->from(EMAIL_FROM_ADDRESS, EMAIL_FROM_NAME);
        $email->to($to);
        $email->subject($subject);
        
        if ($email->send($message)) {
            echo 'enviou';
        } else {
            echo 'não enviou';
        }
    }

}
