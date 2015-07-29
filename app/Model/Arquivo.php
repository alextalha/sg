<?php

App::uses('AppModel', 'Model');

class Arquivo extends AppModel {

    public $displayField = 'nome';
    public $belongsTo = array('Usuario', 'CategoriaArquivo');
    //public $hasAndBelongsToMany = array('Atividade');
    //public $hasMany = array('Atividade');
    
    public $hasAndBelongsToMany = array(

        'Atividade' => array(
            'className' => 'Atividade',
            'joinTable' => 'arquivos_demandas',
            'foreignKey' => 'arquivo_id',
            'associationForeignKey' => 'atividade_id',
            'unique' => 'keepExisting'
        ),
        'Demanda' => array(
            'className' => 'Demanda',
            'joinTable' => 'arquivos_demandas',
            'foreignKey' => 'arquivo_id',
            'associationForeignKey' => 'demanda_id',
            'unique' => 'keepExisting'
        )        
    );    
    
    var $validate = array(
        
        'nome' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser deixado em branco'
        ),
        
        'categoria_arquivo_id' => array(
            'rule' => 'notEmpty',
            'message' => 'Este campo não pode ser deixado em branco'
        )
    );    

    public function usuarioTemAcesso($usuario_id, $arquivo_id){
        
        $this->contain(array("Demanda", "Atividade"));
        $arquivo = $this->findById($arquivo_id);
        
        foreach ($arquivo['Demanda'] as $demanda){
            
            $demandas[] = $demanda['id'];
        }
        foreach ($arquivo['Atividade'] as $atividade){
            
            $atividades[] = $atividade['id'];
        }
        return true;
        //return ($this->Demanda->usuarioTemAcesso($usuario_id,$demandas) || $this->Atividade->usuarioTemAcesso($usuario_id,$atividades));
    }

    public function flushfile($name, $filepath, $contenttype) {
        $filesize = filesize($filepath);

        if ($contenttype != ""){
            header('Content-Type: ' . $contenttype);
        }
        header('Content-Disposition: attachment;filename=' . $name);
        header('Content-Length: ' . $filesize);

        $tmpfile = tempnam(sys_get_temp_dir(), 'tmp' . rand(1, 99999) . '.tmp');
        copy( $filepath, $tmpfile );

        ob_start();
        ob_clean();

        $handle = fopen($tmpfile, "rb");
        $content = fread($handle, $filesize);
        fclose($handle);

        echo $content;
        ob_flush();
    }
}
