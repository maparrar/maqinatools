<?php
/** Loan File
* @package  @subpackage  */
/**
* Loan Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class Loan extends Object{
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
     * @var float
     */
    protected $interest;
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
    protected $from;
    /** 
     *  
     * 
     * @var int
     */
    protected $to;
    /**
    * Constructor
    * @param int $id         
    * @param date $date         
    * @param float $interest         
    * @param int $paid         
    * @param int $from         
    * @param int $to         
    */
    function __construct($id=0,$date="",$interest=0,$paid=0,$from=0,$to=0){        
        $this->id=$id;
        $this->date=$date;
        $this->interest=$interest;
        $this->paid=$paid;
        $this->from=$from;
        $this->to=$to;
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
    * Setter interest
    * @param float $value 
    * @return void
    */
    public function setInterest($value) {
        $this->interest=$value;
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
    * Setter from
    * @param int $value 
    * @return void
    */
    public function setFrom($value) {
        $this->from=$value;
    }
    /**
    * Setter to
    * @param int $value 
    * @return void
    */
    public function setTo($value) {
        $this->to=$value;
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
    * Getter: interest
    * @return float
    */
    public function getInterest() {
        return $this->interest;
    }
    /**
    * Getter: paid
    * @return int
    */
    public function getPaid() {
        return $this->paid;
    }
    /**
    * Getter: from
    * @return int
    */
    public function getFrom() {
        return $this->from;
    }
    /**
    * Getter: to
    * @return int
    */
    public function getTo() {
        return $this->to;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}