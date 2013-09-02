<?php
/** wheres File
* @package  @subpackage  */
/**
* wheres Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class wheres extends Object{
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
    protected $country;
    /**
    * Constructor
    * @param  $id         
    * @param string $country         
    */
    function __construct($id=0,$country=""){        
        $this->id=$id;
        $this->country=$country;
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
    * Setter country
    * @param string $value 
    * @return void
    */
    public function setCountry($value) {
        $this->country=$value;
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
    * Getter: country
    * @return string
    */
    public function getCountry() {
        return $this->country;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}