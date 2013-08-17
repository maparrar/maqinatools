<?php
/** Generator File
 * @ @ */
/**
 * Generator Class
 *
 * @author https://github.com/maparrar/maqinato
 * @author Alejandro Parra <maparrar@gmail.com>
 * @package 
 * @subpackage 
 */
class Generator{
    /** 
     * Nombre del proyecto 
     * 
     * @var string
     */
    protected $project;
    /** 
     * Nombre y correo del autor 
     * 
     * @var string
     */
    protected $author;
    /** 
     * Página web del proyecto 
     * 
     * @var string
     */
    protected $web;
    /** 
     * Array de estructuras a generar 
     * 
     * @var array
     */
    protected $structs;
    /**
    * Constructor
    * @param string Nombre del proyecto        
    * @param string Nombre y correo del autor   
    * @param string Página web del proyecto     
    * @param array Array de estructuras a generar
    */
    function __construct($project="",$author="",$web="",$structs=array()){        
        $this->project=$project;
        $this->author=$author;
        $this->web=$web;
        $this->structs=$structs;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter project
    * @param string $value Nombre del proyecto
    * @return void
    */
    public function setProject($value) {
        $this->project=$value;
    }        
    /**
    * Setter author
    * @param string $value Nombre y correo del autor
    * @return void
    */
    public function setAuthor($value) {
        $this->author=$value;
    }
    /**
    * Setter web
    * @param string $value Página web del proyecto
    * @return void
    */
    public function setWeb($value) {
        $this->web=$value;
    }
    /**
    * Setter structs
    * @param array $value Array de estructuras a generar
    * @return void
    */
    public function setStructs($value) {
        $this->structs=$value;
    }        
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Getter: project
    * @return string
    */
    public function getProject() {
        return $this->project;
    }        
    /**
    * Getter: author
    * @return string
    */
    public function getAuthor() {
        return $this->author;
    }
    /**
    * Getter: web
    * @return string
    */
    public function getWeb() {
        return $this->web;
    }
    /**
    * Getter: structs
    * @return array
    */
    public function getStructs() {
        return $this->structs;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
     * Lee las estructuras a partir de un SQL
     */
    public function readFromSQL($sql){
//        CREATE TABLE Pay_Loan (pay int(10) NOT NULL, loan int(10) NOT NULL, amount bigint(20), PRIMARY KEY (pay, loan));
//        CREATE TABLE Loan (id int(10) NOT NULL AUTO_INCREMENT, `date` datetime NULL, interest float, paid bigint(20), `from` int(10) NOT NULL, `to` int(10) NOT NULL, PRIMARY KEY (id));
//        CREATE TABLE Pay_Sale (pay int(10) NOT NULL, sale int(10) NOT NULL, amount bigint(20), PRIMARY KEY (pay, sale));
//        CREATE TABLE Sale_Product (sale int(10) NOT NULL, product int(10) NOT NULL, units int(10), priceReal bigint(20), PRIMARY KEY (sale, product));
//        CREATE TABLE Sale (id int(10) NOT NULL AUTO_INCREMENT, `date` datetime NULL, totalReal bigint(20), paid bigint(20), client int(10) NOT NULL, PRIMARY KEY (id));
//        CREATE TABLE Pay_Purchase (pay int(10) NOT NULL, purchase int(10) NOT NULL, amount bigint(20), PRIMARY KEY (pay, purchase));
//        CREATE TABLE Purchase_Product (purchase int(10) NOT NULL, product int(10) NOT NULL, units int(10), priceAprox bigint(20), priceReal bigint(20), PRIMARY KEY (purchase, product));
//        CREATE TABLE Purchase (id int(10) NOT NULL AUTO_INCREMENT, `date` datetime NULL, totalAprox bigint(20), totalReal bigint(20), paid bigint(20), provider int(10) NOT NULL, PRIMARY KEY (id));
//        CREATE TABLE ProductPrice (id int(10) NOT NULL AUTO_INCREMENT, product int(10) NOT NULL, `date` datetime NULL, pricePurchase int(10), priceSale int(10), PRIMARY KEY (id));
//        CREATE TABLE Product (id int(10) NOT NULL AUTO_INCREMENT, name varchar(255), PRIMARY KEY (id));
//        CREATE TABLE Pay (id int(10) NOT NULL AUTO_INCREMENT, `date` datetime NULL, amount int(10), `from` int(10) NOT NULL, `to` int(10) NOT NULL, PRIMARY KEY (id));
//        CREATE TABLE Client (id int(10) NOT NULL, PRIMARY KEY (id));
//        CREATE TABLE Provider (id int(10) NOT NULL, PRIMARY KEY (id));
//        CREATE TABLE `User` (id int(10) NOT NULL, password varchar(255), salt varchar(255), PRIMARY KEY (id));
//        CREATE TABLE Person (id int(10) NOT NULL AUTO_INCREMENT, name varchar(100), lastname varchar(100), phone varchar(100), PRIMARY KEY (id));
        
        $lines=explode(";",$sql);
        foreach ($lines as $line){
            if(strpos($line,'CREATE TABLE')!== false){
                $tableLine=trim(str_replace("CREATE TABLE","",$line));
                $class=trim(str_replace("`","",substr($tableLine,0,strpos($tableLine,"("))));
                $attrLineRaw=trim(str_replace(array("NOT","NULL","AUTO_INCREMENT","`"),"",substr($tableLine,strpos($tableLine,"("))));
                $attrLine=$this->str_freplace("(","",$this->str_lreplace(")","",$attrLineRaw));
                //Extra la PK
                $pkText=trim(str_replace(array("PRIMARY KEY","(",")"),"",substr($attrLine,strpos($attrLine,"PRIMARY KEY"),strpos($attrLine,")",strpos($attrLine,"PRIMARY KEY")))));
                //Solo se procesan las que tengan una sola PK
                if(strpos($pkText,',')===false){
                    $pk=trim($pkText);
                    $attrArray=explode(",",$attrLine);
                
                
                
                    print_r("class: <b>".$class."</b><br/>");
                    print_r("pk: ".$pk."<br/>");
                    
                    
                    
                    foreach ($attrArray as $attr) {
                        //Se elimina la PK, porque ya fue capturada
                        if(strpos($attr,'PRIMARY KEY')===false){
                            if(strpos($attr,"(")!==false){
                                $attrRaw=trim(substr($attr,0,strpos($attr,"(")));
                            }else{
                                $attrRaw=trim($attr);
                            }
                            print_r("___ attr: ".$attrRaw."<br/>");
                        }
                        
                    }
                    print_r("=======================================================<br/>");
                }
            }
        }
    }
    /**
     * Reemplaza la primera ocurrencia de un caracter en una cadena
     */
    private function str_freplace($search, $replace, $subject){
        $newstring="";
        $pos = strpos($subject,$search);
        if ($pos !== false) {
            $newstring = substr_replace($subject,$replace,$pos,strlen($search));
        }
        return $newstring;
    }
    /**
     * Reemplaza la última ocurrencia de un caracter en una cadena
     */
    private function str_lreplace($search, $replace, $subject){
        $pos = strrpos($subject, $search);
        if($pos !== false){
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }

    /**
     * Genera la lista de archivos para cada estructura pasada
     */
    public function createFiles(){
        //Para cada estructura pasada genera los archivos
        foreach ($this->structs as $struct){
            //Genera y escribe la clase en archivo
            $class=$this->generateClass($struct);
            $this->writeFile('class/'.$struct->getClass().'.php',$class);
            print_r("Clase generada: class/".$struct->getClass().'.php<br/>');
            //Genera y escribe el dao de la clase en archivo
            $dao=$this->generateDao($struct);
            $this->writeFile('dao/Dao'.$struct->getClass().'.php',$dao);
            print_r("DAO de Clase generado: dao/Dao".$struct->getClass().'.php<br/>');
            //Genera y escribe la estructura en archivo
            $stringStruct=$this->genetrateStruct($struct);
            $this->writeFile('struct/struct'.$struct->getClass().'.php',$stringStruct);
            print_r("Estructura de Clase generada: struct/struct".$struct->getClass().'.php<br/>');
            print_r("---------------------------------------------------<br/>");
        }
    }
    /**
     * Escribe las clases en archivo
     */
    private function writeFile($file,$content){
        file_put_contents($file,$content);
    }
    /**************************************************************************/
    /*************************** GENERADOR DE CLASE ***************************/
    /**************************************************************************/
    private function generateClass(Struct $struct){
        $header='<?php
/** '.$struct->getClass().' File
* @package '.$struct->getPackage().' @subpackage '.$struct->getSubpackage().' */
/**
* '.$struct->getClass().' Class
*
* @author '.$this->web.'
* @author '.$this->author.'
* @package '.$struct->getPackage().'
* @subpackage '.$struct->getSubpackage().'
*/';
        /***************************** ATRIBUTOS ******************************/
        $atributes="";
        foreach ($struct->getAtributes() as $attribute){
            $atributes.='
    /** 
     * '.$attribute['comment'].' 
     * 
     * @var '.$attribute['type'].'
     */
    protected $'.$attribute['name'].';';
        }
        /**************************** CONSTRUCTOR *****************************/
        $constructor='
    /**
    * Constructor';
        $parameters="";
        foreach ($struct->getAtributes() as $attribute){
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
        foreach ($struct->getAtributes() as $attribute){
            $constructor.='
        $this->'.$attribute['name'].'=$'.$attribute['name'].';'; 
        }
        $constructor.='
    }';
        /****************************** SETTERS *******************************/
        $setters='
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<';
        foreach ($struct->getAtributes() as $attribute){
            $setters.='
    /**
    * Setter '.$attribute['name'].'
    * @param '.$attribute['type'].' $value '.$attribute['comment'].'
    * @return void
    */
    public function set'.ucfirst($attribute['name']).'($value) {
        $this->'.$attribute['name'].'=$value;
    }'; 
        }
        /****************************** SETTERS *******************************/
        $getters='
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<';
        foreach ($struct->getAtributes() as $attribute){
            $getters.='
    /**
    * Getter: '.$attribute['name'].'
    * @return '.$attribute['type'].'
    */
    public function get'.ucfirst($attribute['name']).'() {
        return $this->'.$attribute['name'].';
    }'; 
        }
        /******************************* CLASS ********************************/
        $class='
class '.$struct->getClass().$struct->getExtends().'{';
        $class.=$atributes;
        $class.=$constructor;
        $class.=$setters;
        $class.=$getters;
        $class.='    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}';
        return $header.$class;
    }

    /******************************************************************************/
    /**************************** GENERADOR DE MODELO *****************************/
    /******************************************************************************/
    private function generateDao(Struct $struct){
        $header='<?php
/** Dao'.$struct->getClass().' File
 * @package models @subpackage dal */
/**
 * Dao'.$struct->getClass().' Class
 *
 * Class data layer for the '.$struct->getClass().' class
 * 
 * @author '.$this->web.'
 * @author '.$this->author.'
 * @package models
 * @subpackage dal
 */';

        /****************************** CONSTRUCTOR *******************************/
        $constructor='
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function Dao'.$struct->getClass().'(){
        parent::Dao();
    }';
        /*********************************** CREATE ***********************************/
            $create='
    /**
     * Create an '.$struct->getClass().' in the database
     * @param '.$struct->getClass().' new '.$struct->getClass().'
     * @return '.$struct->getClass().' '.$struct->getClass().' stored
     * @return string "exist" if the '.$struct->getClass().' already exist
     * @return false if the '.$struct->getClass().' couldn\'t created
     */
    function create($'.strtolower($struct->getClass()).'){
        $created=false;
        if(!$this->exist($'.strtolower($struct->getClass()).'->get'.ucfirst($struct->getPk()).'())){    ';
            $parameters="";
            $columns="";
            foreach ($struct->getAtributes() as $attribute){
                $columns.='`'.$attribute['name'].'`,';
                $parameters.=':'.$attribute['name'].',';
            }
            $columns=substr($columns,0,-1);
            $parameters=substr($parameters,0,-1);
            $sql='"INSERT INTO '.$struct->getClass().' 
                (';
            $sql.=$columns.') VALUES 
                (';
            $sql.=$parameters.')"';
            $create.='
            $stmt = $this->handler->prepare('.$sql.');
            ';
            foreach ($struct->getAtributes() as $attribute){
                $create.='$stmt->bindParam(\':'.$attribute['name'].'\',$'.strtolower($struct->getClass()).'->get'.ucfirst($attribute['name']).'());
            ';
            }            
            $create.='if($stmt->execute()){
                $'.strtolower($struct->getClass()).'->set'.ucfirst($struct->getPk()).'(intval($this->handler->lastInsertID()));
                $created=$'.strtolower($struct->getClass()).';
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
     * Read a '.$struct->getClass().' from the database
     * @param int '.$struct->getClass().' identificator
     * @return '.$struct->getClass().' '.$struct->getClass().' loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){';
            $sql='"SELECT * FROM '.$struct->getClass().' WHERE '.$struct->getPk().'= ?"';
            $read.='
            $stmt = $this->handler->prepare('.$sql.');
            ';
            $read.='if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $'.strtolower($struct->getClass()).'=new '.$struct->getClass().'();
            ';
            foreach ($struct->getAtributes() as $attribute){
                $value='$row["'.$attribute['name'].'"]';
                if(strtolower($attribute['type'])==="int"){
                    $value='intval($row["'.$attribute['name'].'"])';
                }elseif(strtolower($attribute['type'])==="float"){
                    $value='floatval($row["'.$attribute['name'].'"])';
                }
                $read.='    $'.strtolower($struct->getClass()).'->set'.ucfirst($attribute['name']).'('.$value.');
            ';
            }
            $read.='    $response=$'.strtolower($struct->getClass()).';
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
     * Update a '.$struct->getClass().' in the database
     * @param '.$struct->getClass().' '.$struct->getClass().' object
     * @return false if could\'nt update it
     * @return true if the '.$struct->getClass().' was updated
     */
    function update($'.strtolower($struct->getClass()).'){
        $updated=false;
        if($this->exist($'.strtolower($struct->getClass()).'->get'.ucfirst($struct->getPk()).'())){';
            $columns='
                ';
            foreach ($struct->getAtributes() as $attribute){
                if($attribute['name']!=$struct->getPk()){
                    $columns.='`'.$attribute['name'].'`=:'.$attribute['name'].',
                ';
                }
            }
            $columns=substr($columns,0,-1);
            $sql='"UPDATE '.$struct->getClass().' SET '.$columns.' WHERE '.$struct->getPk().'=:'.$struct->getPk().'"';
            $update.='
            $stmt = $this->handler->prepare('.$sql.');
            ';
            foreach ($struct->getAtributes() as $attribute){
                $update.='$stmt->bindParam(\':'.$attribute['name'].'\',$'.strtolower($struct->getClass()).'->get'.ucfirst($attribute['name']).'());
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
     * Delete an '.$struct->getClass().' from the database
     * @param '.$struct->getClass().' '.$struct->getClass().' object
     * @return false if could\'nt delete it
     * @return true if the '.$struct->getClass().' was deleted
     */
    function delete($'.strtolower($struct->getClass()).'){
        $deleted=false;
        if($this->exist($'.strtolower($struct->getClass()).'->get'.ucfirst($struct->getPk()).'())){
            $stmt = $this->handler->prepare("DELETE '.$struct->getClass().' WHERE '.$struct->getPk().'=:'.$struct->getPk().'");
            $stmt->bindParam(\':'.$struct->getPk().'\',$'.strtolower($struct->getClass()).'->get'.ucfirst($struct->getPk()).'());
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
     * Return if a '.$struct->getClass().' exist in the database
     * @param int '.$struct->getClass().' identificator
     * @return false if doesn\'t exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT '.$struct->getPk().' FROM '.$struct->getClass().' WHERE '.$struct->getPk().'=:'.$struct->getPk().'");
        $stmt->bindParam(\':'.$struct->getPk().'\',$id);
        if ($stmt->execute()) {
            $list=$stmt->fetch();
            if($list){
                if(intval($list["'.$struct->getPk().'"])===intval($id)){
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
     * Get the list of '.$struct->getClass().'
     * @return '.$struct->getClass().'[] List of '.$struct->getClass().'
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT '.$struct->getPk().' FROM '.$struct->getClass().'");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $'.strtolower($struct->getClass()).'=$this->read($row["'.$struct->getPk().'"]);
                array_push($list,$'.strtolower($struct->getClass()).');
            }
        }
        return $list;
    }';
        /********************************* CLASS **********************************/
        $class='
class Dao'.$struct->getClass().' extends Dao{';
        $class.=$constructor;
        $class.=$create;
        $class.=$read;
        $class.=$update;
        $class.=$delete;
        $class.=$exist;
        $class.=$listing;
        $class.='
}';
        return $header.$class;
    }


    /******************************************************************************/
    /********************* ALMACENA LA ESTRUCTURA GENERADORA **********************/
    /******************************************************************************/
    private function genetrateStruct(Struct $struct){
        //Crea el texto de los atributos
        $textAtributes="";
        foreach ($struct->getAtributes() as $attribute){
            $textAtributes.='array("name"=>"'.$attribute['name'].'", "type"=>"'.$attribute['type'].'",   "comment"=>"'.$attribute['comment'].'"),
            ';
        }
        $textAtributes=substr(trim($textAtributes),0,-1);
        //Texto completo
        $text='"'.$struct->getPackage().'",
        "'.$struct->getSubpackage().'",
        "'.$struct->getClass().'",
        array(
            '.$textAtributes.'
        ),
        "'.$struct->getPk().'",
        "'.trim(str_replace("extends","",$struct->getExtends())).'"';
        return $text;
    }
}