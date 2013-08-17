<?php
/** ProductPrice File
* @package  @subpackage  */
/**
* ProductPrice Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class ProductPrice extends Object{
    /** 
     *  
     * 
     * @var int
     */
    protected $id;
    /** 
     *  
     * 
     * @var int
     */
    protected $product;
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
    protected $pricePurchase;
    /** 
     *  
     * 
     * @var int
     */
    protected $priceSale;
    /**
    * Constructor
    * @param int         
    * @param int         
    * @param date         
    * @param int         
    * @param int         
    */
    function __construct($id=0,$product=0,$date="",$pricePurchase=0,$priceSale=0){        
        $this->id=$id;
        $this->product=$product;
        $this->date=$date;
        $this->pricePurchase=$pricePurchase;
        $this->priceSale=$priceSale;
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
    * Setter product
    * @param int $value 
    * @return void
    */
    public function setProduct($value) {
        $this->product=$value;
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
    * Setter pricePurchase
    * @param int $value 
    * @return void
    */
    public function setPricePurchase($value) {
        $this->pricePurchase=$value;
    }
    /**
    * Setter priceSale
    * @param int $value 
    * @return void
    */
    public function setPriceSale($value) {
        $this->priceSale=$value;
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
    * Getter: product
    * @return int
    */
    public function getProduct() {
        return $this->product;
    }
    /**
    * Getter: date
    * @return date
    */
    public function getDate() {
        return $this->date;
    }
    /**
    * Getter: pricePurchase
    * @return int
    */
    public function getPricePurchase() {
        return $this->pricePurchase;
    }
    /**
    * Getter: priceSale
    * @return int
    */
    public function getPriceSale() {
        return $this->priceSale;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}