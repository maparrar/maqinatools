<?php
/** User File
* @package models @subpackage basic */
/**
* User Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package models
* @subpackage basic
*/
class User extends Object{
    /** 
     * Código de usuario 
     * 
     * @var int
     */
    protected $code;
    /** 
     * Nombre de usuario 
     * 
     * @var string
     */
    protected $name;
    /** 
     * Apellido de usuario 
     * 
     * @var string
     */
    protected $lastname;
    /**
    * Constructor
    * @param int Código de usuario        
    * @param string Nombre de usuario        
    * @param string Apellido de usuario        
    */
    function __construct($code=0,$name="",$lastname=""){        
        $this->code=$code;
        $this->name=$name;
        $this->lastname=$lastname;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter code
    * @param int $value Código de usuario
    * @return void
    */
    public function setCode($value) {
        $this->code=$value;
    }
    /**
    * Setter name
    * @param string $value Nombre de usuario
    * @return void
    */
    public function setName($value) {
        $this->name=$value;
    }
    /**
    * Setter lastname
    * @param string $value Apellido de usuario
    * @return void
    */
    public function setLastname($value) {
        $this->lastname=$value;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Getter: code
    * @return int
    */
    public function getCode() {
        return $this->code;
    }
    /**
    * Getter: name
    * @return string
    */
    public function getName() {
        return $this->name;
    }
    /**
    * Getter: lastname
    * @return string
    */
    public function getLastname() {
        return $this->lastname;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}