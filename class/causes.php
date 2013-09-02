<?php
/** causes File
* @package  @subpackage  */
/**
* causes Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class causes extends Object{
    /** 
     *  
     * 
     * @var 
     */
    protected $id;
    /** 
     *  
     * 
     * @var 
     */
    protected $what;
    /** 
     *  
     * 
     * @var int
     */
    protected $where;
    /** 
     *  
     * 
     * @var 
     */
    protected $who;
    /**
    * Constructor
    * @param  $id         
    * @param  $what         
    * @param int $where         
    * @param  $who         
    */
    function __construct($id=0,$what=0,$where=0,$who=0){        
        $this->id=$id;
        $this->what=$what;
        $this->where=$where;
        $this->who=$who;
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
    * Setter what
    * @param  $value 
    * @return void
    */
    public function setWhat($value) {
        $this->what=$value;
    }
    /**
    * Setter where
    * @param int $value 
    * @return void
    */
    public function setWhere($value) {
        $this->where=$value;
    }
    /**
    * Setter who
    * @param  $value 
    * @return void
    */
    public function setWho($value) {
        $this->who=$value;
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
    * Getter: what
    * @return 
    */
    public function getWhat() {
        return $this->what;
    }
    /**
    * Getter: where
    * @return int
    */
    public function getWhere() {
        return $this->where;
    }
    /**
    * Getter: who
    * @return 
    */
    public function getWho() {
        return $this->who;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}