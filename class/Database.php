<?php
/** Database File
* @package core @subpackage  */
/**
* Database Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package core
* @subpackage 
*/
class Database{
    /** 
     * Nombre de la base de datos 
     * 
     * @var string
     */
    protected $name;
    /** 
     * Tipo de conexión: mysql, oracle, ... 
     * 
     * @var string
     */
    protected $driver;
    /** 
     * Si es una base de datos persistente 
     * 
     * @var bool
     */
    protected $persistent;
    /** 
     * Host donde está alojada la base de datos 
     * 
     * @var string
     */
    protected $host;
    /** 
     * Array de conexiones a la base de datos: read, write, delete, all 
     * 
     * @var Connection[]
     */
    protected $connections;
    /**
    * Constructor
    * @param string $name Nombre de la base de datos        
    * @param string $driver Tipo de conexión: mysql, oracle, ...        
    * @param bool $persistent Si es una base de datos persistente        
    * @param string $host Host donde está alojada la base de datos        
    * @param Connection[] $connections Array de conexiones a la base de datos: read, write, delete, all        
    */
    function __construct($name="",$driver="",$persistent=0,$host="",$connections=0){        
        $this->name=$name;
        $this->driver=$driver;
        $this->persistent=$persistent;
        $this->host=$host;
        $this->connections=$connections;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter name
    * @param string $value Nombre de la base de datos
    * @return void
    */
    public function setName($value) {
        $this->name=$value;
    }
    /**
    * Setter driver
    * @param string $value Tipo de conexión: mysql, oracle, ...
    * @return void
    */
    public function setDriver($value) {
        $this->driver=$value;
    }
    /**
    * Setter persistent
    * @param bool $value Si es una base de datos persistente
    * @return void
    */
    public function setPersistent($value) {
        $this->persistent=$value;
    }
    /**
    * Setter host
    * @param string $value Host donde está alojada la base de datos
    * @return void
    */
    public function setHost($value) {
        $this->host=$value;
    }
    /**
    * Setter connections
    * @param Connection[] $value Array de conexiones a la base de datos: read, write, delete, all
    * @return void
    */
    public function setConnections($value) {
        $this->connections=$value;
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
    * Getter: driver
    * @return string
    */
    public function getDriver() {
        return $this->driver;
    }
    /**
    * Getter: persistent
    * @return bool
    */
    public function getPersistent() {
        return $this->persistent;
    }
    /**
    * Getter: host
    * @return string
    */
    public function getHost() {
        return $this->host;
    }
    /**
    * Getter: connections
    * @return Connection[]
    */
    public function getConnections() {
        return $this->connections;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}