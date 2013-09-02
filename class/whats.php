<?php
/** whats File
* @package  @subpackage  */
/**
* whats Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class whats extends Object{
    /** 
     *  
     * 
     * @var 
     */
    protected $id;
    /** 
     *  
     * 
     * @var int
     */
    protected $tag;
    /**
    * Constructor
    * @param  $id         
    * @param int $tag         
    */
    function __construct($id=0,$tag=0){        
        $this->id=$id;
        $this->tag=$tag;
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
    * Setter tag
    * @param int $value 
    * @return void
    */
    public function setTag($value) {
        $this->tag=$value;
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
    * Getter: tag
    * @return int
    */
    public function getTag() {
        return $this->tag;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}