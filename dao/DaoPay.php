<?php
/** DaoPay File
 * @package models @subpackage dal */
/**
 * DaoPay Class
 *
 * Class data layer for the Pay class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoPay{
    /**
     * Create an Pay in the database
     * @param Pay $pay new Pay
     * @return Pay Pay stored
     * @return string "exist" if the Pay already exist
     * @return false if the Pay couldn't created
     */
    function create($pay){
        $created=false;
        if(!$this->exist($pay->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO Pay 
                (`id`,`date`,`amount`,`from`,`to`) VALUES 
                (:id,:date,:amount,:from,:to)");
            $stmt->bindParam(':id',$pay->getId());
            $stmt->bindParam(':date',$pay->getDate());
            $stmt->bindParam(':amount',$pay->getAmount());
            $stmt->bindParam(':from',$pay->getFrom());
            $stmt->bindParam(':to',$pay->getTo());
            if($stmt->execute()){
                $pay->setId(intval($handler->lastInsertID()));
                $created=$pay;
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
     * Read a Pay from the database
     * @param int $id Pay identificator
     * @return Pay Pay loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM Pay WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $pay=new Pay();
                $pay->setId(intval($row["id"]));
                $pay->setDate($row["date"]);
                $pay->setAmount(intval($row["amount"]));
                $pay->setFrom(intval($row["from"]));
                $pay->setTo(intval($row["to"]));
                $response=$pay;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Pay in the database
     * @param Pay $pay Pay object
     * @return false if could'nt update it
     * @return true if the Pay was updated
     */
    function update($pay){
        $updated=false;
        if($this->exist($pay->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE Pay SET 
                `date`=:date,
                `amount`=:amount,
                `from`=:from,
                `to`=:to,
                WHERE id=:id");
            $stmt->bindParam(':id',$pay->getId());
            $stmt->bindParam(':date',$pay->getDate());
            $stmt->bindParam(':amount',$pay->getAmount());
            $stmt->bindParam(':from',$pay->getFrom());
            $stmt->bindParam(':to',$pay->getTo());
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
     * Delete an Pay from the database
     * @param Pay $pay Pay object
     * @return false if could'nt delete it
     * @return true if the Pay was deleted
     */
    function delete($pay){
        $deleted=false;
        if($this->exist($pay->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE Pay WHERE id=:id");
            $stmt->bindParam(':id',$pay->getId());
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
     * Return if a Pay exist in the database
     * @param int $id Pay identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM Pay WHERE id=:id");
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
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $exist;
    }
    /**
     * Get the list of Pay
     * @return Pay[] List of Pay
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM Pay");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $pay=$this->read($row["id"]);
                array_push($list,$pay);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}