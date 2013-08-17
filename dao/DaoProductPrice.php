<?php
/** DaoProductPrice File
 * @package models @subpackage dal */
/**
 * DaoProductPrice Class
 *
 * Class data layer for the ProductPrice class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoProductPrice extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoProductPrice(){
        parent::Dao();
    }
    /**
     * Create an ProductPrice in the database
     * @param ProductPrice new ProductPrice
     * @return ProductPrice ProductPrice stored
     * @return string "exist" if the ProductPrice already exist
     * @return false if the ProductPrice couldn't created
     */
    function create($productprice){
        $created=false;
        if(!$this->exist($productprice->getId())){    
            $stmt = $this->handler->prepare("INSERT INTO ProductPrice 
                (`id`,`product`,`date`,`pricePurchase`,`priceSale`) VALUES 
                (:id,:product,:date,:pricePurchase,:priceSale)");
            $stmt->bindParam(':id',$productprice->getId());
            $stmt->bindParam(':product',$productprice->getProduct());
            $stmt->bindParam(':date',$productprice->getDate());
            $stmt->bindParam(':pricePurchase',$productprice->getPricePurchase());
            $stmt->bindParam(':priceSale',$productprice->getPriceSale());
            if($stmt->execute()){
                $productprice->setId(intval($this->handler->lastInsertID()));
                $created=$productprice;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }else{
            $created="exist";
        }
        return $created;
    }
    /**
     * Read a ProductPrice from the database
     * @param int ProductPrice identificator
     * @return ProductPrice ProductPrice loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $stmt = $this->handler->prepare("SELECT * FROM ProductPrice WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $productprice=new ProductPrice();
                $productprice->setId(intval($row["id"]));
                $productprice->setProduct(intval($row["product"]));
                $productprice->setDate($row["date"]);
                $productprice->setPricePurchase(intval($row["pricePurchase"]));
                $productprice->setPriceSale(intval($row["priceSale"]));
                $response=$productprice;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a ProductPrice in the database
     * @param ProductPrice ProductPrice object
     * @return false if could'nt update it
     * @return true if the ProductPrice was updated
     */
    function update($productprice){
        $updated=false;
        if($this->exist($productprice->getId())){
            $stmt = $this->handler->prepare("UPDATE ProductPrice SET 
                `product`=:product,
                `date`=:date,
                `pricePurchase`=:pricePurchase,
                `priceSale`=:priceSale,
                WHERE id=:id");
            $stmt->bindParam(':id',$productprice->getId());
            $stmt->bindParam(':product',$productprice->getProduct());
            $stmt->bindParam(':date',$productprice->getDate());
            $stmt->bindParam(':pricePurchase',$productprice->getPricePurchase());
            $stmt->bindParam(':priceSale',$productprice->getPriceSale());
            if($stmt->execute()){
                $updated=true;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }else{
            $updated=false;
        }
        return $updated;
    }
    /**
     * Delete an ProductPrice from the database
     * @param ProductPrice ProductPrice object
     * @return false if could'nt delete it
     * @return true if the ProductPrice was deleted
     */
    function delete($productprice){
        $deleted=false;
        if($this->exist($productprice->getId())){
            $stmt = $this->handler->prepare("DELETE ProductPrice WHERE id=:id");
            $stmt->bindParam(':id',$productprice->getId());
            if($stmt->execute()){
                $deleted=true;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }else{
            $deleted=false;
        }
        return $deleted;
    }
    /**
     * Return if a ProductPrice exist in the database
     * @param int ProductPrice identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT id FROM ProductPrice WHERE id=:id");
        $stmt->bindParam(':id',$id);
        if ($stmt->execute()) {
            $list=$stmt->fetch();
            if($list){
                if(intval($list["id"])===intval($id)){
                    $exist=true;
                }else{
                    $exist=false;
                }
            }
        }
        return $exist;
    }
    /**
     * Get the list of ProductPrice
     * @return ProductPrice[] List of ProductPrice
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT id FROM ProductPrice");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $productprice=$this->read($row["id"]);
                array_push($list,$productprice);
            }
        }
        return $list;
    }
}