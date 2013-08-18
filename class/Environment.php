<?php
/** Environment File
* @package core @subpackage  */
/**
* Environment Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package core
* @subpackage 
*/
class Environment{
    /** 
     * Nombre del Environment 
     * 
     * @var string
     */
    protected $name;
    /** 
     * Lista de las urls para las que el ambiente es válido 
     * 
     * @var array
     */
    protected $urls;
    /** 
     * Base de datos del Environment 
     * 
     * @var Database
     */
    protected $database;
    /**
    * Constructor
    * @param string $name Nombre del Environment        
    * @param array $urls Lista de las urls para las que el ambiente es válido        
    * @param Database $database Base de datos del Environment        
    */
    function __construct($name="",$urls=array(),$database=0){        
        $this->name=$name;
        $this->urls=$urls;
        $this->database=$database;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter name
    * @param string $value Nombre del Environment
    * @return void
    */
    public function setName($value) {
        $this->name=$value;
    }
    /**
    * Setter urls
    * @param array $value Lista de las urls para las que el ambiente es válido
    * @return void
    */
    public function setUrls($value) {
        $this->urls=$value;
    }
    /**
    * Setter database
    * @param Database $value Base de datos del Environment
    * @return void
    */
    public function setDatabase($value) {
        $this->database=$value;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Getter: name
    * @return string
    */
    public function getName() {
        return $this->name;
    }
    /**
    * Getter: urls
    * @return array
    */
    public function getUrls() {
        return $this->urls;
    }
    /**
    * Getter: database
    * @return Database
    */
    public function getDatabase() {
        return $this->database;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}