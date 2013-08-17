<?php
/** Sale File
* @package  @subpackage  */
/**
* Sale Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class Sale extends Object{
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
    protected $client;
    /**
    * Constructor
    * @param int         
    * @param date         
    * @param int         
    * @param int         
    * @param int         
    */
    function __construct($id=0,$date="",$totalReal=0,$paid=0,$client=0){        
        $this->id=$id;
        $this->date=$date;
        $this->totalReal=$totalReal;
        $this->paid=$paid;
        $this->client=$client;
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
    * Setter client
    * @param int $value 
    * @return void
    */
    public function setClient($value) {
        $this->client=$value;
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
    * Getter: client
    * @return int
    */
    public function getClient() {
        return $this->client;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}