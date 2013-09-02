<?php
/** Daoimpacts File
 * @package models @subpackage dal */
/**
 * Daoimpacts Class
 *
 * Class data layer for the impacts class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class Daoimpacts{
    /**
     * Create an impacts in the database
     * @param impacts $impacts new impacts
     * @return impacts impacts stored
     * @return string "exist" if the impacts already exist
     * @return false if the impacts couldn't created
     */
    function create($impacts){
        $created=false;
        if(!$this->exist($impacts->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO impacts 
                (`id`,`name`) VALUES 
                (:id,:name)");
            $stmt->bindParam(':id',$impacts->getId());
            $stmt->bindParam(':name',$impacts->getName());
            if($stmt->execute()){
                $impacts->setId(intval($handler->lastInsertID()));
                $created=$impacts;
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
     * Read a impacts from the database
     * @param int $id impacts identificator
     * @return impacts impacts loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM impacts WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $impacts=new impacts();
                $impacts->setId($row["id"]);
                $impacts->setName($row["name"]);
                $response=$impacts;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a impacts in the database
     * @param impacts $impacts impacts object
     * @return false if could'nt update it
     * @return true if the impacts was updated
     */
    function update($impacts){
        $updated=false;
        if($this->exist($impacts->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE impacts SET 
                `name`=:name,
                WHERE id=:id");
            $stmt->bindParam(':id',$impacts->getId());
            $stmt->bindParam(':name',$impacts->getName());
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
     * Delete an impacts from the database
     * @param impacts $impacts impacts object
     * @return false if could'nt delete it
     * @return true if the impacts was deleted
     */
    function delete($impacts){
        $deleted=false;
        if($this->exist($impacts->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE impacts WHERE id=:id");
            $stmt->bindParam(':id',$impacts->getId());
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
     * Return if a impacts exist in the database
     * @param int $id impacts identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM impacts WHERE id=:id");
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
     * Get the list of impacts
     * @return impacts[] List of impacts
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM impacts");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $impacts=$this->read($row["id"]);
                array_push($list,$impacts);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}