<?php
/** Daowhos File
 * @package models @subpackage dal */
/**
 * Daowhos Class
 *
 * Class data layer for the whos class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class Daowhos{
    /**
     * Create an whos in the database
     * @param whos $whos new whos
     * @return whos whos stored
     * @return string "exist" if the whos already exist
     * @return false if the whos couldn't created
     */
    function create($whos){
        $created=false;
        if(!$this->exist($whos->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO whos 
                (`id`,`name`) VALUES 
                (:id,:name)");
            $stmt->bindParam(':id',$whos->getId());
            $stmt->bindParam(':name',$whos->getName());
            if($stmt->execute()){
                $whos->setId(intval($handler->lastInsertID()));
                $created=$whos;
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
     * Read a whos from the database
     * @param int $id whos identificator
     * @return whos whos loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM whos WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $whos=new whos();
                $whos->setId($row["id"]);
                $whos->setName($row["name"]);
                $response=$whos;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a whos in the database
     * @param whos $whos whos object
     * @return false if could'nt update it
     * @return true if the whos was updated
     */
    function update($whos){
        $updated=false;
        if($this->exist($whos->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE whos SET 
                `name`=:name,
                WHERE id=:id");
            $stmt->bindParam(':id',$whos->getId());
            $stmt->bindParam(':name',$whos->getName());
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
     * Delete an whos from the database
     * @param whos $whos whos object
     * @return false if could'nt delete it
     * @return true if the whos was deleted
     */
    function delete($whos){
        $deleted=false;
        if($this->exist($whos->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE whos WHERE id=:id");
            $stmt->bindParam(':id',$whos->getId());
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
     * Return if a whos exist in the database
     * @param int $id whos identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM whos WHERE id=:id");
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
     * Get the list of whos
     * @return whos[] List of whos
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM whos");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $whos=$this->read($row["id"]);
                array_push($list,$whos);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}