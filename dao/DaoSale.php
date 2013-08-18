<?php
/** DaoSale File
 * @package models @subpackage dal */
/**
 * DaoSale Class
 *
 * Class data layer for the Sale class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoSale{
    /**
     * Create an Sale in the database
     * @param Sale $sale new Sale
     * @return Sale Sale stored
     * @return string "exist" if the Sale already exist
     * @return false if the Sale couldn't created
     */
    function create($sale){
        $created=false;
        if(!$this->exist($sale->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO Sale 
                (`id`,`date`,`totalReal`,`paid`,`client`) VALUES 
                (:id,:date,:totalReal,:paid,:client)");
            $stmt->bindParam(':id',$sale->getId());
            $stmt->bindParam(':date',$sale->getDate());
            $stmt->bindParam(':totalReal',$sale->getTotalReal());
            $stmt->bindParam(':paid',$sale->getPaid());
            $stmt->bindParam(':client',$sale->getClient());
            if($stmt->execute()){
                $sale->setId(intval($handler->lastInsertID()));
                $created=$sale;
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
     * Read a Sale from the database
     * @param int $id Sale identificator
     * @return Sale Sale loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM Sale WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $sale=new Sale();
                $sale->setId(intval($row["id"]));
                $sale->setDate($row["date"]);
                $sale->setTotalReal(intval($row["totalReal"]));
                $sale->setPaid(intval($row["paid"]));
                $sale->setClient(intval($row["client"]));
                $response=$sale;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Sale in the database
     * @param Sale $sale Sale object
     * @return false if could'nt update it
     * @return true if the Sale was updated
     */
    function update($sale){
        $updated=false;
        if($this->exist($sale->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE Sale SET 
                `date`=:date,
                `totalReal`=:totalReal,
                `paid`=:paid,
                `client`=:client,
                WHERE id=:id");
            $stmt->bindParam(':id',$sale->getId());
            $stmt->bindParam(':date',$sale->getDate());
            $stmt->bindParam(':totalReal',$sale->getTotalReal());
            $stmt->bindParam(':paid',$sale->getPaid());
            $stmt->bindParam(':client',$sale->getClient());
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
     * Delete an Sale from the database
     * @param Sale $sale Sale object
     * @return false if could'nt delete it
     * @return true if the Sale was deleted
     */
    function delete($sale){
        $deleted=false;
        if($this->exist($sale->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE Sale WHERE id=:id");
            $stmt->bindParam(':id',$sale->getId());
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
     * Return if a Sale exist in the database
     * @param int $id Sale identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM Sale WHERE id=:id");
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
     * Get the list of Sale
     * @return Sale[] List of Sale
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM Sale");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $sale=$this->read($row["id"]);
                array_push($list,$sale);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}