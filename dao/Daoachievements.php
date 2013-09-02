<?php
/** Daoachievements File
 * @package models @subpackage dal */
/**
 * Daoachievements Class
 *
 * Class data layer for the achievements class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class Daoachievements{
    /**
     * Create an achievements in the database
     * @param achievements $achievements new achievements
     * @return achievements achievements stored
     * @return string "exist" if the achievements already exist
     * @return false if the achievements couldn't created
     */
    function create($achievements){
        $created=false;
        if(!$this->exist($achievements->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO achievements 
                (`id`,`name`) VALUES 
                (:id,:name)");
            $stmt->bindParam(':id',$achievements->getId());
            $stmt->bindParam(':name',$achievements->getName());
            if($stmt->execute()){
                $achievements->setId(intval($handler->lastInsertID()));
                $created=$achievements;
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
     * Read a achievements from the database
     * @param int $id achievements identificator
     * @return achievements achievements loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM achievements WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $achievements=new achievements();
                $achievements->setId($row["id"]);
                $achievements->setName($row["name"]);
                $response=$achievements;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a achievements in the database
     * @param achievements $achievements achievements object
     * @return false if could'nt update it
     * @return true if the achievements was updated
     */
    function update($achievements){
        $updated=false;
        if($this->exist($achievements->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE achievements SET 
                `name`=:name,
                WHERE id=:id");
            $stmt->bindParam(':id',$achievements->getId());
            $stmt->bindParam(':name',$achievements->getName());
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
     * Delete an achievements from the database
     * @param achievements $achievements achievements object
     * @return false if could'nt delete it
     * @return true if the achievements was deleted
     */
    function delete($achievements){
        $deleted=false;
        if($this->exist($achievements->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE achievements WHERE id=:id");
            $stmt->bindParam(':id',$achievements->getId());
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
     * Return if a achievements exist in the database
     * @param int $id achievements identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM achievements WHERE id=:id");
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
     * Get the list of achievements
     * @return achievements[] List of achievements
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM achievements");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $achievements=$this->read($row["id"]);
                array_push($list,$achievements);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}