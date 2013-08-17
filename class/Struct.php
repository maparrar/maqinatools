<?php
/** Struct File
 * @ @ */
/**
 * Struct Class
 *
 * @author https://github.com/maparrar/maqinato
 * @author Alejandro Parra <maparrar@gmail.com>
 * @package 
 * @subpackage 
 */
class Struct extends Object{
    /** 
     * Nombre del paquete 
     * 
     * @var string
     */
    protected $package;
    /** 
     * Nombre del subpaquete 
     * 
     * @var string
     */
    protected $subpackage;
    /** 
     * Nombre d ela clase 
     * 
     * @var string
     */
    protected $class;
    /** 
     * Lista de atributos de la clase 
     * 
     * @var array
     */
    protected $atributes;
    /** 
     * Nombre de la PK (primary key) de la tabla 
     * 
     * @var string
     */
    protected $pk;
    /**
    * Constructor
    * @param string Nombre del paquete        
    * @param string Nombre del subpaquete        
    * @param string Nombre d ela clase        
    * @param array Lista de atributos de la clase        
    * @param string Nombre de la PK (primary key) de la tabla        
    */
    function __construct($package="",$subpackage="",$class="",$atributes=array(),$pk=""){        
        $this->package=$package;
        $this->subpackage=$subpackage;
        $this->class=$class;
        $this->atributes=$atributes;
        $this->pk=$pk;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter package
    * @param string $value Nombre del paquete
    * @return void
    */
    public function setPackage($value) {
        $this->package=$value;
    }        
    /**
    * Setter subpackage
    * @param string $value Nombre del subpaquete
    * @return void
    */
    public function setSubpackage($value) {
        $this->subpackage=$value;
    }        
    /**
    * Setter class
    * @param string $value Nombre d ela clase
    * @return void
    */
    public function setClass($value) {
        $this->class=$value;
    }        
    /**
    * Setter atributes
    * @param array $value Lista de atributos de la clase
    * @return void
    */
    public function setAtributes($value) {
        $this->atributes=$value;
    }        
    /**
    * Setter pk
    * @param string $value Nombre de la PK (primary key) de la tabla
    * @return void
    */
    public function setPk($value) {
        $this->pk=$value;
    }        
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Getter: package
    * @return string
    */
    public function getPackage() {
        return $this->package;
    }        
    /**
    * Getter: subpackage
    * @return string
    */
    public function getSubpackage() {
        return $this->subpackage;
    }        
    /**
    * Getter: class
    * @return string
    */
    public function getClass() {
        return $this->class;
    }        
    /**
    * Getter: atributes
    * @return array
    */
    public function getAtributes() {
        return $this->atributes;
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
