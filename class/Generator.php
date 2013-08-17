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
class Generator extends Object{
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
     * Si hereda de otra clase 
     * 
     * @var string
     */
    protected $extends;
    /**
    * Constructor
    * @param string Nombre del proyecto        
    * @param string Nombre y correo del autor        
    * @param string Página web del proyecto        
    * @param array Array de estructuras a generar        
    * @param string Si hereda de otra clase        
    */
    function __construct($project="",$author="",$web="",$structs=array(),$extends=""){        
        $this->project=$project;
        $this->author=$author;
        $this->web=$web;
        $this->structs=$structs;
        $this->extends=$extends;
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
    /**
    * Setter extends
    * @param string $value Si hereda de otra clase
    * @return void
    */
    public function setExtends($value) {
        $this->extends=$value;
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
    /**
    * Getter: extends
    * @return string
    */
    public function getExtends() {
        return $this->extends;
    }            
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}
