<?php
/** influences File
* @package  @subpackage  */
/**
* influences Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class influences extends Object{
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
    protected $achievement;
    /** 
     *  
     * 
     * @var 
     */
    protected $impact;
    /** 
     *  
     * 
     * @var 
     */
    protected $quantity;
    /** 
     *  
     * 
     * @var 
     */
    protected $minCost;
    /** 
     *  
     * 
     * @var 
     */
    protected $maxCost;
    /**
    * Constructor
    * @param  $id         
    * @param int $achievement         
    * @param  $impact         
    * @param  $quantity         
    * @param  $minCost         
    * @param  $maxCost         
    */
    function __construct($id=0,$achievement=0,$impact=0,$quantity=0,$minCost=0,$maxCost=0){        
        $this->id=$id;
        $this->achievement=$achievement;
        $this->impact=$impact;
        $this->quantity=$quantity;
        $this->minCost=$minCost;
        $this->maxCost=$maxCost;
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
    * Setter achievement
    * @param int $value 
    * @return void
    */
    public function setAchievement($value) {
        $this->achievement=$value;
    }
    /**
    * Setter impact
    * @param  $value 
    * @return void
    */
    public function setImpact($value) {
        $this->impact=$value;
    }
    /**
    * Setter quantity
    * @param  $value 
    * @return void
    */
    public function setQuantity($value) {
        $this->quantity=$value;
    }
    /**
    * Setter minCost
    * @param  $value 
    * @return void
    */
    public function setMinCost($value) {
        $this->minCost=$value;
    }
    /**
    * Setter maxCost
    * @param  $value 
    * @return void
    */
    public function setMaxCost($value) {
        $this->maxCost=$value;
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
    * Getter: achievement
    * @return int
    */
    public function getAchievement() {
        return $this->achievement;
    }
    /**
    * Getter: impact
    * @return 
    */
    public function getImpact() {
        return $this->impact;
    }
    /**
    * Getter: quantity
    * @return 
    */
    public function getQuantity() {
        return $this->quantity;
    }
    /**
    * Getter: minCost
    * @return 
    */
    public function getMinCost() {
        return $this->minCost;
    }
    /**
    * Getter: maxCost
    * @return 
    */
    public function getMaxCost() {
        return $this->maxCost;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}