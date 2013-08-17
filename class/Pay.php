<?php
/** Pay File
* @package  @subpackage  */
/**
* Pay Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class Pay extends Object{
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
    protected $amount;
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
    * @param int         
    * @param date         
    * @param int         
    * @param int         
    * @param int         
    */
    function __construct($id=0,$date="",$amount=0,$from=0,$to=0){        
        $this->id=$id;
        $this->date=$date;
        $this->amount=$amount;
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
    * Setter amount
    * @param int $value 
    * @return void
    */
    public function setAmount($value) {
        $this->amount=$value;
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
    * Getter: amount
    * @return int
    */
    public function getAmount() {
        return $this->amount;
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