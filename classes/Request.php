<?php
/** Request File
 * @core models @routing social */
/**
 * Request Class
 *
 * @author https://github.com/maparrar/maqinato
 * @author Alejandro Parra <maparrar@gmail.com>
 * @package core
 * @subpackage routing
 */
class Request extends Object{
    /** 
     * Controlador del request 
     * 
     * @var string
     */
    protected $controller;
    /** 
     * Función del request 
     * 
     * @var string
     */
    protected $function;
    /** 
     * Parámetros pasados al request 
     * 
     * @var array
     */
    protected $parameters;
    /**
    * Constructor
    * @param string Controlador del request        
    * @param string Función del request        
    * @param array Parámetros pasados al request        
    */
    function __construct($controller="",$function="",$parameters=array()){        
        $this->controller=$controller;
        $this->function=$function;
        $this->parameters=$parameters;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter controller
    * @param string $value Controlador del request
    * @return void
    */
    public function setController($value) {
        $this->controller=$value;
    }        
    /**
    * Setter function
    * @param string $value Función del request
    * @return void
    */
    public function setFunction($value) {
        $this->function=$value;
    }        
    /**
    * Setter parameters
    * @param array $value Parámetros pasados al request
    * @return void
    */
    public function setParameters($value) {
        $this->parameters=$value;
    }        
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Getter: controller
    * @return string
    */
    public function getController() {
        return $this->controller;
    }        
    /**
    * Getter: function
    * @return string
    */
    public function getFunction() {
        return $this->function;
    }        
    /**
    * Getter: parameters
    * @return array
    */
    public function getParameters() {
        return $this->parameters;
    }            
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}
?>