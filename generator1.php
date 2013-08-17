<?php
    $package="";
    $subpackage="";
    $class="Struct";
    $attributes=array(
        array("name"=>"package", "type"=>"string",   "comment"=>"Nombre del paquete"),
        array("name"=>"subpackage", "type"=>"string",   "comment"=>"Nombre del subpaquete"),
        array("name"=>"class", "type"=>"string",   "comment"=>"Nombre d ela clase"),
        array("name"=>"atributes", "type"=>"array",   "comment"=>"Lista de atributos de la clase"),
        array("name"=>"pk", "type"=>"string",   "comment"=>"Nombre de la PK (primary key) de la tabla")
    );
    
    
    //Genera la clase
    classGenerator($package,$subpackage,$class,$attributes);
    //Genera el DAO para la clase
    daoGenerator($package,$subpackage,$class,$attributes);
    //Guarda el generador de la clase
    saveGenerator($package,$subpackage,$class,$attributes);
    //Imprime el enlace para volver
    echo '<a href="index.php">Volver</a>';
    
    
/******************************************************************************/
/***************************** GENERADOR DE CLASE *****************************/
/******************************************************************************/
function classGenerator($package,$subpackage,$class,$attributes){
$file = 'class/'.$class.'.php';
$header='<?php
/** '.$class.' File
 * @'.$package.' @'.$subpackage.' */
/**
 * '.$class.' Class
 *
 * @author https://github.com/maparrar/maqinato
 * @author Alejandro Parra <maparrar@gmail.com>
 * @package '.$package.'
 * @subpackage '.$subpackage.'
 */';
/******************************* ATRIBUTOS ********************************/
foreach ($attributes as $attribute){
    $atributes.='
    /** 
     * '.$attribute['comment'].' 
     * 
     * @var '.$attribute['type'].'
     */
    protected $'.$attribute['name'].';';
}
/****************************** CONSTRUCTOR *******************************/
$constructor='
    /**
    * Constructor';
foreach ($attributes as $attribute){
    $value='0';
    if(strtolower($attribute['type'])==="string"){
        $value='""';
    }elseif(strtolower($attribute['type'])==="date"){
        $value='date(\'Y-m-d H:i:s\')';
    }elseif(strtolower($attribute['type'])==="array"){
        $value='array()';
    }
    $parameters.='$'.$attribute['name'].'='.$value.',';
    $constructor.='
    * @param '.$attribute['type'].' '.$attribute['comment'].'        ';
}
$parameters=substr($parameters,0,-1);
$constructor.='
    */';
$constructor.='
    function __construct('.$parameters.'){        ';
foreach ($attributes as $attribute){
    $constructor.='
        $this->'.$attribute['name'].'=$'.$attribute['name'].';'; 
}
$constructor.='
    }';
/******************************** SETTERS *********************************/
$setters='
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<';
foreach ($attributes as $attribute){
    $setters.='
    /**
    * Setter '.$attribute['name'].'
    * @param '.$attribute['type'].' $value '.$attribute['comment'].'
    * @return void
    */
    public function set'.ucfirst($attribute['name']).'($value) {
        $this->'.$attribute['name'].'=$value;
    }        '; 
}
/******************************** SETTERS *********************************/
$getters='
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<';
foreach ($attributes as $attribute){
    $getters.='
    /**
    * Getter: '.$attribute['name'].'
    * @return '.$attribute['type'].'
    */
    public function get'.ucfirst($attribute['name']).'() {
        return $this->'.$attribute['name'].';
    }        '; 
}
/********************************* CLASS **********************************/
$class='
class '.$class.' extends Object{';
$class.=$atributes;
$class.=$constructor;
$class.=$setters;
$class.=$getters;
$class.='    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}
';
//Escribe la clase
file_put_contents($file,$header.$class);
print_r("CLASE GENERADA <br>");
}



/******************************************************************************/
/**************************** GENERADOR DE MODELO *****************************/
/******************************************************************************/
function daoGenerator($package,$subpackage,$class,$attributes){
$file = 'dao/Dao'.$class.'.php';
$header='<?php
/** Dao'.$class.' File
 * @package models @subpackage dal */
/**
 * Dao'.$class.' Class
 *
 * Class data layer for the '.$class.' class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author Alejandro Parra <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */';

/****************************** CONSTRUCTOR *******************************/
$constructor='
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function Dao'.$class.'(){
        parent::Dao();
    }';
/*********************************** CREATE ***********************************/
    $create='
    /**
     * Create an '.$class.' in the database
     * @param '.$class.' new '.$class.'
     * @return '.$class.' '.$class.' stored
     * @return string "exist" if the '.$class.' already exist
     * @return false if the '.$class.' couldn\'t created
     */
    function create($'.strtolower($class).'){
        $created=false;
        if(!$this->exist($'.strtolower($class).'->getId())){    ';
    foreach ($attributes as $attribute){
        $columns.='`'.$attribute['name'].'`,';
        $parameters.=':'.$attribute['name'].',';
    }
    $columns=substr($columns,0,-1);
    $parameters=substr($parameters,0,-1);
    $sql='"INSERT INTO '.strtolower($class).'s 
                (';
    $sql.=$columns.') VALUES 
                (';
    $sql.=$parameters.')"';
    $create.='
            $stmt = $this->handler->prepare('.$sql.');
            ';
    foreach ($attributes as $attribute){
        $create.='$stmt->bindParam(\':'.$attribute['name'].'\',$'.strtolower($class).'->get'.ucfirst($attribute['name']).'());
            ';
    }            
    $create.='if($stmt->execute()){
                $'.strtolower($class).'->setId(intval($this->handler->lastInsertID()));
                $created=$'.strtolower($class).';
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }else{
            $created="exist";
        }
        return $created;
    }';
/************************************ READ ************************************/
    $read='
    /**
     * Read a '.$class.' from the database
     * @param int '.$class.' identificator
     * @return '.$class.' '.$class.' loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){';
    $sql='"SELECT * FROM '.strtolower($class).'s WHERE id= ?"';
    $read.='
            $stmt = $this->handler->prepare('.$sql.');
            ';
    $read.='if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $'.strtolower($class).'=new '.$class.'();
            ';
    foreach ($attributes as $attribute){
        $value='$row["'.$attribute['name'].'"]';
        if(strtolower($attribute['type'])==="int"){
            $value='intval($row["'.$attribute['name'].'"])';
        }elseif(strtolower($attribute['type'])==="float"){
            $value='floatval($row["'.$attribute['name'].'"])';
        }
        $read.='    $'.strtolower($class).'->set'.ucfirst($attribute['name']).'('.$value.');
            ';
    }
    $read.='    $response=$'.strtolower($class).';
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }';
/*********************************** UPDATE ***********************************/
    $update='
    /**
     * Update a '.$class.' in the database
     * @param '.$class.' '.$class.' object
     * @return false if could\'nt update it
     * @return true if the '.$class.' was updated
     */
    function update($'.strtolower($class).'){
        $updated=false;
        if($this->exist($'.strtolower($class).'->getId())){';
    $columns='
                ';
    foreach ($attributes as $attribute){
        if($attribute['name']!="id"){
            $columns.='`'.$attribute['name'].'`=:'.$attribute['name'].',
                ';
        }
    }
    $columns=substr($columns,0,-1);
    $sql='"UPDATE '.strtolower($class).'s SET '.$columns.' WHERE id=:id"';
    $update.='
            $stmt = $this->handler->prepare('.$sql.');
            ';
    foreach ($attributes as $attribute){
        $update.='$stmt->bindParam(\':'.$attribute['name'].'\',$'.strtolower($class).'->get'.ucfirst($attribute['name']).'());
            ';
    }            
    $update.='if($stmt->execute()){
                $updated=true;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }else{
            $updated=false;
        }
        return $updated;
    }';
/*********************************** DELETE ***********************************/    
    $delete='
    /**
     * Delete an '.$class.' from the database
     * @param '.$class.' '.$class.' object
     * @return false if could\'nt delete it
     * @return true if the '.$class.' was deleted
     */
    function delete($'.strtolower($class).'){
        $deleted=false;
        if($this->exist($'.strtolower($class).'->getId())){
            $stmt = $this->handler->prepare("DELETE '.strtolower($class).'s WHERE id=:id");
            $stmt->bindParam(\':id\',$'.strtolower($class).'->getId());
            if($stmt->execute()){
                $deleted=true;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }else{
            $deleted=false;
        }
        return $deleted;
    }';
/************************************ EXIST ***********************************/    
    $exist='
    /**
     * Return if a '.$class.' exist in the database
     * @param int '.$class.' identificator
     * @return false if doesn\'t exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT id FROM '.strtolower($class).'s WHERE id=:id");
        $stmt->bindParam(\':id\',$id);
        if ($stmt->execute()) {
            $list=$stmt->fetch();
            if($list){
                if(intval($list["id"])===intval($id)){
                    $exist=true;
                }else{
                    $exist=false;
                }
            }
        }
        return $exist;
    }';
/*********************************** LISTING **********************************/    
    $listing='
    /**
     * Get the list of '.$class.'
     * @return '.$class.'[] List of '.$class.'
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT id FROM '.strtolower($class).'s");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $'.strtolower($class).'=$this->read($row["id"]);
                array_push($list,$'.strtolower($class).');
            }
        }
        return $list;
    }';
/********************************* CLASS **********************************/
$class='
class Dao'.$class.' extends Dao{';
$class.=$constructor;
$class.=$create;
$class.=$read;
$class.=$update;
$class.=$delete;
$class.=$exist;
$class.=$listing;
$class.='
}
';
//Escribe la clase
file_put_contents($file,$header.$class);
print_r("CLASE DE MODELO GENERADA <br>");
}


/******************************************************************************/
/********************* ALMACENA LA ESTRUCTURA GENERADORA **********************/
/******************************************************************************/
function saveGenerator($package,$subpackage,$class,$attributes){
$file = 'struct/struct'.$class.'.php';
    //Crea el texto de los atributos
    foreach ($attributes as $attribute){
        $textAtributes.='array("name"=>"'.$attribute['name'].'", "type"=>"'.$attribute['type'].'",   "comment"=>"'.$attribute['comment'].'"),
        ';
    }
    $textAtributes=substr(trim($textAtributes),0,-1);
    //Texto completo
    $text='$package="'.$package.'";
    $subpackage="'.$subpackage.'";
    $class="'.$class.'";
    $attributes=array(
        '.$textAtributes.'
    );';
    //Escribe el texto
    file_put_contents($file,$text);
    print_r("ESTRUCTURA ALMACENADA <br>");
}