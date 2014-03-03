<?php
/** Table File
* @package html5sync @subpackage core */
/**
* Table Class
*
* @author https://github.com/maparrar/html5sync
* @author maparrar <maparrar@gmail.com>
* @package html5sync
* @subpackage core
*/
class Table{
    /** 
     * Identificador de la tabla 
     * 
     * @var int
     */
    protected $id;
    /** 
     * Nombre de la tabla 
     * 
     * @var string
     */
    protected $name;
    /** 
     * Modo de uso de la tabla: ('unlock': Para operaciones insert+read), ('lock': Para operaciones update+delete) 
     * 
     * @var string
     */
    protected $mode;
    /** 
     * Array con los nombres de las columnas 
     * 
     * @var array
     */
    protected $fields;
    /** 
     * Array con los datos de la tabla 
     * 
     * @var array
     */
    protected $data;
    /** 
     * Nombre de la Primary Key para la tabla 
     * 
     * @var string
     */
    protected $pk;
    /**
    * Constructor
    * @param int $id Identificador de la tabla        
    * @param string $name Nombre de la tabla        
    * @param string $mode Modo de uso de la tabla: ('unlock': Para operaciones insert+read), ('lock': Para operaciones update+delete)        
    * @param array $fields Array con los nombres de las columnas        
    * @param array $data Array con los datos de la tabla        
    * @param string $pk Nombre de la Primary Key para la tabla        
    */
    function __construct($id=0,$name="",$mode="",$fields=array(),$data=array(),$pk=""){        
        $this->id=$id;
        $this->name=$name;
        $this->mode=$mode;
        $this->fields=$fields;
        $this->data=$data;
        $this->pk=$pk;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter id
    * @param int $value Identificador de la tabla
    * @return void
    */
    public function setId($value) {
        $this->id=$value;
    }
    /**
    * Setter name
    * @param string $value Nombre de la tabla
    * @return void
    */
    public function setName($value) {
        $this->name=$value;
    }
    /**
    * Setter mode
    * @param string $value Modo de uso de la tabla: ('unlock': Para operaciones insert+read), ('lock': Para operaciones update+delete)
    * @return void
    */
    public function setMode($value) {
        $this->mode=$value;
    }
    /**
    * Setter fields
    * @param array $value Array con los nombres de las columnas
    * @return void
    */
    public function setFields($value) {
        $this->fields=$value;
    }
    /**
    * Setter data
    * @param array $value Array con los datos de la tabla
    * @return void
    */
    public function setData($value) {
        $this->data=$value;
    }
    /**
    * Setter pk
    * @param string $value Nombre de la Primary Key para la tabla
    * @return void
    */
    public function setPk($value) {
        $this->pk=$value;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Getter: id
    * @return int
    */
    public function getId() {
        return $this->id;
    }
    /**
    * Getter: name
    * @return string
    */
    public function getName() {
        return $this->name;
    }
    /**
    * Getter: mode
    * @return string
    */
    public function getMode() {
        return $this->mode;
    }
    /**
    * Getter: fields
    * @return array
    */
    public function getFields() {
        return $this->fields;
    }
    /**
    * Getter: data
    * @return array
    */
    public function getData() {
        return $this->data;
    }
    /**
    * Getter: pk
    * @return string
    */
    public function getPk() {
        return $this->pk;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}