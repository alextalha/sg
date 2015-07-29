<?php

App::uses('AppModel', 'Model');

class Pivot extends AppModel {

    
  public $displayField = 'nome';
  
  private $host, $user , $password , $port;
  
   public $belongsTo = array(
		'Grupo' => array(
			'className' => 'Grupo',
			'foreignKey' => 'grupo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    private function bd_connect($pivot_info) {

        switch ($pivot_info['Pivot']['tipo_base']) {
            case 'sqlsrv':
            
                try{
                
               // new PDO("sqlsrv:Server=localhost;Database=$database",$username, $password);
                    //$conn = new PDO("odbc:Driver={MSSQL Server};Server=" .$pivot_info['Pivot']['servidor']. ";Database= " . $pivot_info['Pivot']['base'] ,$pivot_info['Pivot']['usuario'] , $pivot_info['Pivot']['senha']);
                   
                $conn = new PDO("odbc:Driver={SQL Server};Server=" .$pivot_info['Pivot']['servidor']. ";Database=" . $pivot_info['Pivot']['base'] . "; Uid=" . $pivot_info['Pivot']['usuario'] . " ;Pwd=" . $pivot_info['Pivot']['senha']);
                
                
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               } catch(PDOException $e) {
                     echo 'ERROR: ' . $e->getMessage();
                }
                
                break;
            
            
            case 'sqlite':
 
                /* Sqlite trabalha com chamada a arquivo */
                
                $arquivo = $pivot_info['Pivot']['base'];
               
                    try {   
                     $conn = new PDO('sqlite:'.$pivot_info['Pivot']['base']);
                     }catch (PDOException $e) {
                        print $e->getMessage();
                    }
           
                
            break;    
                
            case 'mysql' || 'pgsql':
                

                if (isset($pivot_info['Pivot']['servidor'])) {

                    /* var conections */

                    $pivot_info['Pivot']['servidor'] = explode(":", $pivot_info['Pivot']['servidor']);
                    $this->port = $pivot_info['Pivot']['servidor'][1];

                    $this->host = "host=" . $pivot_info['Pivot']['servidor'][0] . ";port=" . $this->port . ";dbname=" . $pivot_info['Pivot']['base'];
                    $this->user = $pivot_info['Pivot']['usuario'];
                    $this->password = $pivot_info['Pivot']['senha'];

                    try {
    
                        $conn = new PDO($pivot_info['Pivot']['tipo_base'] . ":" . $this->host, $this->user, $this->password);
                    } catch (PDOException $e) {
                        print $e->getMessage();
                    }
                    break;
                }
            default:
                $conn = false;
                break;
        }
        return $conn;

    }

    public function lista_distinct_campo($pivot_info, $campo) {
        $conn = $this->bd_connect($pivot_info);
        $ret = array();
        switch ($pivot_info['Pivot']['tipo_base']) {
            case 'sqlsrv':
                $query = 'select ' . utf8_decode($campo) . ' from ' . $pivot_info['Pivot']['tabela'] . ' group by ' . utf8_decode($campo);
                $result = sqlsrv_query($conn, $query);
                if ($result)
                    while ($row = sqlsrv_fetch_array($result))
                        $ret[$row[0]] = $row[0];
                break;
            case 'sqlite':

                $query = 'select ' . utf8_decode($campo) . ' from ' . $pivot_info['Pivot']['tabela'] . ' group by ' . utf8_decode($campo);
                foreach ($conn->query($query) as $row) {
                    $ret[$row[0]] = $row[0];
                }
                break;
        }
        return $ret;
    }

    private function connect( $pivot_info, &$pivot ) {
        
        
    
        
        $conn = $this->bd_connect($pivot_info);
        
        switch ($pivot_info['Pivot']['tipo_base']) {
            /*
            case 'sqlsrvv':
                $ds = new SQLSRVPivotDataSource($conn);
                break;
             * 
             */
            
            case 'sqlite' || 'mysql' || 'pgsql' || 'sqlsrv' :
                $ds = new PdoPivotDataSource($conn);
                break;
            
            default:
                break;
        }
        
        
        $ds->select($pivot_info['Pivot']['campos'])->from($pivot_info['Pivot']['tabela']);
        $pivot->DataSource = $ds;
        $pivot->styleFolder = "office2007";
        
        //Turn on ajax features.
	$pivot->AjaxEnabled = true;
    }
    
    
     public function select($id, $page = 0, &$count) {
        $pivot_info = $this->findById($id);

        $conn = $this->bd_connect($pivot_info);
        
       

        $ret = array();
        switch ($pivot_info['Pivot']['tipo_base']) {
            
            /*
            case 'sqlsrvv':
                
                $query = 'select top 500 * from ' . $pivot_info['Pivot']['tabela'];
                $result = sqlsrv_query($conn, $query);
                if ($result)
                    $ret = sqlsrv_fetch_array($result);
                break;
             * 
             * 
             */
            
            case ('sqlite' || 'mysql' || 'psql' || 'sqlsrv' ):
                $query = 'select * from ' . $pivot_info['Pivot']['tabela'] . " limit 500 offset " . $page * 500;
                
                
                $ret = '<table class="table">';
                foreach ($conn->query($query, PDO::FETCH_ASSOC) as $num_row => $row) {
                    if ($num_row == 0) {
                        $ret .= "<tr>";
                        foreach (array_keys($row) as $coluna)
                            $ret .= "<th>" . $coluna . "</th>";
                        $ret .= "</tr>";
                    }
                    $ret .= "<tr>";
                    foreach ($row as $value)
                        $ret .= "<td>" . $value . "</td>";
                    $ret .= "</tr>";
                }
                $ret .= "</table>";
                foreach ($conn->query('select count(*) from ' . $pivot_info['Pivot']['tabela']) as $row)
                    $count = $row[0];
                break;
                
        }
        
              return $ret;
        
        

     }   
        

    private function pivotProperties(&$pivot) {
        $pivot->styleFolder = 'default';
        $pivot->Localization->Load(SITE_URL . "localization/pivot_pt.xml");
        $pivot->AjaxEnabled = true;
        $this->AjaxHandlePage = true;
        $pivot->AjaxLoadingImage = SITE_URL . DS . IMAGES_URL . "loading.gif";
        //$pivot->KeepViewStateInSession = true;
        $pivot->Width = "100%";
        $pivot->HorizontalScrolling = false;
        //$pivot->Height = "700px";
        $pivot->VerticalScrolling = false;
        $pivot->AllowFiltering = true;
        $pivot->AllowSorting = true;
        $pivot->AllowSortingData = true;
        $pivot->AllowReorder = true;
        //$pivot->Appearance->RowHeaderMinWidth = "500px";
        //$pivot->Appearance->RowHeaderWidth = "500px";

        $pivot->AllowCaching = true;
    }

    private $formatString = array('' => '{}', '9' => '{n}', '$' => 'R${n}', 'date' => "d/m/Y", 'datetime' => "d/m/Y H:i:s", '%' => "{n}%");

    public function createField($name, $type, &$pivot, $properties) {
        if ($name != '') {
            if ($type === 'Data') {
                $tipo = (isset($properties['tipo'])) ? $properties['tipo'] : 'Sum';
                $method = "Pivot" . $tipo . "Field";
                $field = new $method(utf8_decode($name));
                //$field->FormatString = $this->formatString[$properties['formato']];
                $field->DecimalNumber = (isset($properties['casas_decimais'])) ? $properties['casas_decimais'] : '2';
                $field->DecimalPoint = (isset($properties['separador_decimal'])) ? $properties['separador_decimal'] : ',';
                $field->ThousandSeperate = (isset($properties['separador_milhar'])) ? $properties['separador_milhar'] : '';
            } else
                $field = new PivotField(utf8_decode($name));

            if (isset($properties['filtro']) && count($properties['filtro'])) {
                $field->IncludeAll = $properties['incluir'];
                $field->ExceptionList = $properties['filtro'];
            }

            if (isset($properties['all'])) {
                foreach ($properties['all'] as $property => $value) {
                    $field->$property = $value;
                }
            }

            $field->Text = $name;
            $method = 'Add' . $type . 'Field';
            $pivot->$method($field);
        }
    }

    public function createFields($string, $type, &$pivot, $properties) {
        $array = $string;
        $array = explode(',', $string);
        $array = array_unique($array);

        foreach ($array as $value) {
            $properties_value = (isset($properties[$value])) ? $properties[$value] : array();
            if (isset($properties['all']))
                $properties_value['all'] = $properties['all'];
            if ($type != 'Filter' || !empty($properties_value))
                $this->createField($value, $type, $pivot, $properties_value);
        }
    }

    public function createPainel( &$pivot_info ) {

        $array = explode(',', $pivot_info['Pivot']['campos']);
        $string = $pivot_info['Pivot']['colunas'] . $pivot_info['Pivot']['linhas'] . $pivot_info['Pivot']['valores'];
        $campos = array();
        foreach ($array as $value) {
            
            if (empty($value)) { return false; }
            if (strpos($string, trim($value)) === false) {
                
                $campos[] = $value;
            }
        }
        $pivot_info['Pivot']['campos'] = implode(",", $campos);
    }

    public function init($pivot_info, &$koolajax, &$pivot) {
  
        set_time_limit(0);
        if ( !$koolajax ){
            
            $koolajax = new koolajax();
        }
        if ( !$pivot ) {
            
            $pivot = new KoolPivotTable("pivot");
        }
  
        $this->connect($pivot_info, $pivot);
        $this->pivotProperties($pivot);

        //$this->initialProcess($pivot_info,$pivot);
        //sqlsrv_close($conn);
    }

    public function render(&$koolajax, &$pivot) {
        $ajax = $koolajax->Render();
        $table = $pivot->Render();
        return $ajax . $table;
    }

    public function getPivotsDeUsuario($usuario_id) {
        $conteudos_id = $this->Grupo->Permission->getConteudosIdDeUsuario("Pivots", "view", $usuario_id);
        if ($conteudos_id == 'all')
            return $this->find('list', array('fields' => array('id', 'nome', 'Grupo.alias_name'), 'contain' => array("Grupo")));
        return $this->find('list', array('fields' => array('id', 'nome', 'Grupo.alias_name'), 'contain' => array("Grupo"),
                    'conditions' => array('Pivot.id' => $conteudos_id)
        ));
    }

    public function usuarioTemAcesso($usuario_id, $pivot_id, $action) {
        $grupos_id = $this->Grupo->getGrupoIdsDeUsuario($usuario_id);
        return $this->Grupo->Permission->find('count', array('conditions' => array(
                        'controller' => "Pivots",
                        'action' => $action,
                        'conteudo_id' => array($pivot_id, null),
                        'grupo_id' => $grupos_id,
                        'allowed' => 1
        )));
    }

    public function paginate2($array, $page = 0) {
        // array_slice() to extract needed portion of data (page)
        // usort() to sort data using comparision function $this->sort()
        return(
                array_slice(
                        usort(
                                $array, array($this, 'sort') // callback to $this->sort()
                        ), $page * $this->paginate['limit'], $this->paginate['limit']
                )
                );
    }

    public function sort($a, $b) {
        $result = 0;
        foreach ($this->paginate['order'] as $key => $order) {
            list($table, $field) = explode('.', $key);
            if ($a[$table][$field] == $b[$table][$field])
                continue;
            $result = ($a[$table][$field] < $b[$table][$field] ? -1 : 1) *
                    ($order == 'asc' ? 1 : -1);
        }
        return($result);
    }

}


