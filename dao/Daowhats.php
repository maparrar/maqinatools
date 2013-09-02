<?php
/** Daowhats File
 * @package models @subpackage dal */
/**
 * Daowhats Class
 *
 * Class data layer for the whats class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class Daowhats{
    /**
     * Create an whats in the database
     * @param whats $whats new whats
     * @return whats whats stored
     * @return string "exist" if the whats already exist
     * @return false if the whats couldn't created
     */
    function create($whats){
        $created=false;
        if(!$this->exist($whats->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO whats 
                (`id`,`tag`) VALUES 
                (:id,:tag)");
            $stmt->bindParam(':id',$whats->getId());
            $stmt->bindParam(':tag',$whats->getTag());
            if($stmt->execute()){
                $whats->setId(intval($handler->lastInsertID()));
                $created=$whats;
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
     * Read a whats from the database
     * @param int $id whats identificator
     * @return whats whats loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM whats WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $whats=new whats();
                $whats->setId($row["id"]);
                $whats->setTag(intval($row["tag"]));
                $response=$whats;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a whats in the database
     * @param whats $whats whats object
     * @return false if could'nt update it
     * @return true if the whats was updated
     */
    function update($whats){
        $updated=false;
        if($this->exist($whats->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE whats SET 
                `tag`=:tag,
                WHERE id=:id");
            $stmt->bindParam(':id',$whats->getId());
            $stmt->bindParam(':tag',$whats->getTag());
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
     * Delete an whats from the database
     * @param whats $whats whats object
     * @return false if could'nt delete it
     * @return true if the whats was deleted
     */
    function delete($whats){
        $deleted=false;
        if($this->exist($whats->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE whats WHERE id=:id");
            $stmt->bindParam(':id',$whats->getId());
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
     * Return if a whats exist in the database
     * @param int $id whats identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM whats WHERE id=:id");
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
     * Get the list of whats
     * @return whats[] List of whats
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM whats");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $whats=$this->read($row["id"]);
                array_push($list,$whats);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}