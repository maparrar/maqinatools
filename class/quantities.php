<?php
/** quantities File
* @package  @subpackage  */
/**
* quantities Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class quantities extends Object{
    /** 
     *  
     * 
     * @var 
     */
    protected $id;
    /** 
     *  
     * 
     * @var string
     */
    protected $name;
    /**
    * Constructor
    * @param  $id         
    * @param string $name         
    */
    function __construct($id=0,$name=""){        
        $this->id=$id;
        $this->name=$name;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter id
    * @param  $value 
    * @return void
    */
    public function setId($value) {
        $this->id=$value;
    }
    /**
    * Setter name
    * @param string $value 
    * @return void
    */
    public function setName($value) {
        $this->name=$value;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Getter: id
    * @return 
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
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}