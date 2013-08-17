<?php
/** DaoPurchase File
 * @package models @subpackage dal */
/**
 * DaoPurchase Class
 *
 * Class data layer for the Purchase class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoPurchase extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoPurchase(){
        parent::Dao();
    }
    /**
     * Create an Purchase in the database
     * @param Purchase new Purchase
     * @return Purchase Purchase stored
     * @return string "exist" if the Purchase already exist
     * @return false if the Purchase couldn't created
     */
    function create($purchase){
        $created=false;
        if(!$this->exist($purchase->getId())){    
            $stmt = $this->handler->prepare("INSERT INTO Purchase 
                (`id`,`date`,`totalAprox`,`totalReal`,`paid`,`provider`) VALUES 
                (:id,:date,:totalAprox,:totalReal,:paid,:provider)");
            $stmt->bindParam(':id',$purchase->getId());
            $stmt->bindParam(':date',$purchase->getDate());
            $stmt->bindParam(':totalAprox',$purchase->getTotalAprox());
            $stmt->bindParam(':totalReal',$purchase->getTotalReal());
            $stmt->bindParam(':paid',$purchase->getPaid());
            $stmt->bindParam(':provider',$purchase->getProvider());
            if($stmt->execute()){
                $purchase->setId(intval($this->handler->lastInsertID()));
                $created=$purchase;
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
     * Read a Purchase from the database
     * @param int Purchase identificator
     * @return Purchase Purchase loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $stmt = $this->handler->prepare("SELECT * FROM Purchase WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $purchase=new Purchase();
                $purchase->setId(intval($row["id"]));
                $purchase->setDate($row["date"]);
                $purchase->setTotalAprox(intval($row["totalAprox"]));
                $purchase->setTotalReal(intval($row["totalReal"]));
                $purchase->setPaid(intval($row["paid"]));
                $purchase->setProvider(intval($row["provider"]));
                $response=$purchase;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Purchase in the database
     * @param Purchase Purchase object
     * @return false if could'nt update it
     * @return true if the Purchase was updated
     */
    function update($purchase){
        $updated=false;
        if($this->exist($purchase->getId())){
            $stmt = $this->handler->prepare("UPDATE Purchase SET 
                `date`=:date,
                `totalAprox`=:totalAprox,
                `totalReal`=:totalReal,
                `paid`=:paid,
                `provider`=:provider,
                WHERE id=:id");
            $stmt->bindParam(':id',$purchase->getId());
            $stmt->bindParam(':date',$purchase->getDate());
            $stmt->bindParam(':totalAprox',$purchase->getTotalAprox());
            $stmt->bindParam(':totalReal',$purchase->getTotalReal());
            $stmt->bindParam(':paid',$purchase->getPaid());
            $stmt->bindParam(':provider',$purchase->getProvider());
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
     * Delete an Purchase from the database
     * @param Purchase Purchase object
     * @return false if could'nt delete it
     * @return true if the Purchase was deleted
     */
    function delete($purchase){
        $deleted=false;
        if($this->exist($purchase->getId())){
            $stmt = $this->handler->prepare("DELETE Purchase WHERE id=:id");
            $stmt->bindParam(':id',$purchase->getId());
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
     * Return if a Purchase exist in the database
     * @param int Purchase identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT id FROM Purchase WHERE id=:id");
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
     * Get the list of Purchase
     * @return Purchase[] List of Purchase
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT id FROM Purchase");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $purchase=$this->read($row["id"]);
                array_push($list,$purchase);
            }
        }
        return $list;
    }
}