<?php
/** Daocauses File
 * @package models @subpackage dal */
/**
 * Daocauses Class
 *
 * Class data layer for the causes class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class Daocauses{
    /**
     * Create an causes in the database
     * @param causes $causes new causes
     * @return causes causes stored
     * @return string "exist" if the causes already exist
     * @return false if the causes couldn't created
     */
    function create($causes){
        $created=false;
        if(!$this->exist($causes->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO causes 
                (`id`,`what`,`where`,`who`) VALUES 
                (:id,:what,:where,:who)");
            $stmt->bindParam(':id',$causes->getId());
            $stmt->bindParam(':what',$causes->getWhat());
            $stmt->bindParam(':where',$causes->getWhere());
            $stmt->bindParam(':who',$causes->getWho());
            if($stmt->execute()){
                $causes->setId(intval($handler->lastInsertID()));
                $created=$causes;
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
     * Read a causes from the database
     * @param int $id causes identificator
     * @return causes causes loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM causes WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $causes=new causes();
                $causes->setId($row["id"]);
                $causes->setWhat($row["what"]);
                $causes->setWhere(intval($row["where"]));
                $causes->setWho($row["who"]);
                $response=$causes;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a causes in the database
     * @param causes $causes causes object
     * @return false if could'nt update it
     * @return true if the causes was updated
     */
    function update($causes){
        $updated=false;
        if($this->exist($causes->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE causes SET 
                `what`=:what,
                `where`=:where,
                `who`=:who,
                WHERE id=:id");
            $stmt->bindParam(':id',$causes->getId());
            $stmt->bindParam(':what',$causes->getWhat());
            $stmt->bindParam(':where',$causes->getWhere());
            $stmt->bindParam(':who',$causes->getWho());
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
     * Delete an causes from the database
     * @param causes $causes causes object
     * @return false if could'nt delete it
     * @return true if the causes was deleted
     */
    function delete($causes){
        $deleted=false;
        if($this->exist($causes->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE causes WHERE id=:id");
            $stmt->bindParam(':id',$causes->getId());
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
     * Return if a causes exist in the database
     * @param int $id causes identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM causes WHERE id=:id");
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
     * Get the list of causes
     * @return causes[] List of causes
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM causes");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $causes=$this->read($row["id"]);
                array_push($list,$causes);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}