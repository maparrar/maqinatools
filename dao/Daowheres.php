<?php
/** Daowheres File
 * @package models @subpackage dal */
/**
 * Daowheres Class
 *
 * Class data layer for the wheres class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class Daowheres{
    /**
     * Create an wheres in the database
     * @param wheres $wheres new wheres
     * @return wheres wheres stored
     * @return string "exist" if the wheres already exist
     * @return false if the wheres couldn't created
     */
    function create($wheres){
        $created=false;
        if(!$this->exist($wheres->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO wheres 
                (`id`,`country`) VALUES 
                (:id,:country)");
            $stmt->bindParam(':id',$wheres->getId());
            $stmt->bindParam(':country',$wheres->getCountry());
            if($stmt->execute()){
                $wheres->setId(intval($handler->lastInsertID()));
                $created=$wheres;
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
     * Read a wheres from the database
     * @param int $id wheres identificator
     * @return wheres wheres loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM wheres WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $wheres=new wheres();
                $wheres->setId($row["id"]);
                $wheres->setCountry($row["country"]);
                $response=$wheres;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a wheres in the database
     * @param wheres $wheres wheres object
     * @return false if could'nt update it
     * @return true if the wheres was updated
     */
    function update($wheres){
        $updated=false;
        if($this->exist($wheres->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE wheres SET 
                `country`=:country,
                WHERE id=:id");
            $stmt->bindParam(':id',$wheres->getId());
            $stmt->bindParam(':country',$wheres->getCountry());
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
     * Delete an wheres from the database
     * @param wheres $wheres wheres object
     * @return false if could'nt delete it
     * @return true if the wheres was deleted
     */
    function delete($wheres){
        $deleted=false;
        if($this->exist($wheres->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE wheres WHERE id=:id");
            $stmt->bindParam(':id',$wheres->getId());
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
     * Return if a wheres exist in the database
     * @param int $id wheres identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM wheres WHERE id=:id");
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
     * Get the list of wheres
     * @return wheres[] List of wheres
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM wheres");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $wheres=$this->read($row["id"]);
                array_push($list,$wheres);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}