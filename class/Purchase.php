<?php
/** Purchase File
* @package  @subpackage  */
/**
* Purchase Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class Purchase extends Object{
    /** 
     *  
     * 
     * @var int
     */
    protected $id;
    /** 
     *  
     * 
     * @var date
     */
    protected $date;
    /** 
     *  
     * 
     * @var int
     */
    protected $totalAprox;
    /** 
     *  
     * 
     * @var int
     */
    protected $totalReal;
    /** 
     *  
     * 
     * @var int
     */
    protected $paid;
    /** 
     *  
     * 
     * @var int
     */
    protected $provider;
    /**
    * Constructor
    * @param int $id         
    * @param date $date         
    * @param int $totalAprox         
    * @param int $totalReal         
    * @param int $paid         
    * @param int $provider         
    */
    function __construct($id=0,$date="",$totalAprox=0,$totalReal=0,$paid=0,$provider=0){        
        $this->id=$id;
        $this->date=$date;
        $this->totalAprox=$totalAprox;
        $this->totalReal=$totalReal;
        $this->paid=$paid;
        $this->provider=$provider;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter id
    * @param int $value 
    * @return void
    */
    public function setId($value) {
        $this->id=$value;
    }
    /**
    * Setter date
    * @param date $value 
    * @return void
    */
    public function setDate($value) {
        $this->date=$value;
    }
    /**
    * Setter totalAprox
    * @param int $value 
    * @return void
    */
    public function setTotalAprox($value) {
        $this->totalAprox=$value;
    }
    /**
    * Setter totalReal
    * @param int $value 
    * @return void
    */
    public function setTotalReal($value) {
        $this->totalReal=$value;
    }
    /**
    * Setter paid
    * @param int $value 
    * @return void
    */
    public function setPaid($value) {
        $this->paid=$value;
    }
    /**
    * Setter provider
    * @param int $value 
    * @return void
    */
    public function setProvider($value) {
        $this->provider=$value;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Getter: id
    * @return int
    */
    public function getId() {
        return $this->id;
    }
    /**
    * Getter: date
    * @return date
    */
    public function getDate() {
        return $this->date;
    }
    /**
    * Getter: totalAprox
    * @return int
    */
    public function getTotalAprox() {
        return $this->totalAprox;
    }
    /**
    * Getter: totalReal
    * @return int
    */
    public function getTotalReal() {
        return $this->totalReal;
    }
    /**
    * Getter: paid
    * @return int
    */
    public function getPaid() {
        return $this->paid;
    }
    /**
    * Getter: provider
    * @return int
    */
    public function getProvider() {
        return $this->provider;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}