<?php
/** Daoquantities File
 * @package models @subpackage dal */
/**
 * Daoquantities Class
 *
 * Class data layer for the quantities class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class Daoquantities{
    /**
     * Create an quantities in the database
     * @param quantities $quantities new quantities
     * @return quantities quantities stored
     * @return string "exist" if the quantities already exist
     * @return false if the quantities couldn't created
     */
    function create($quantities){
        $created=false;
        if(!$this->exist($quantities->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO quantities 
                (`id`,`name`) VALUES 
                (:id,:name)");
            $stmt->bindParam(':id',$quantities->getId());
            $stmt->bindParam(':name',$quantities->getName());
            if($stmt->execute()){
                $quantities->setId(intval($handler->lastInsertID()));
                $created=$quantities;
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
     * Read a quantities from the database
     * @param int $id quantities identificator
     * @return quantities quantities loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM quantities WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $quantities=new quantities();
                $quantities->setId($row["id"]);
                $quantities->setName($row["name"]);
                $response=$quantities;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a quantities in the database
     * @param quantities $quantities quantities object
     * @return false if could'nt update it
     * @return true if the quantities was updated
     */
    function update($quantities){
        $updated=false;
        if($this->exist($quantities->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE quantities SET 
                `name`=:name,
                WHERE id=:id");
            $stmt->bindParam(':id',$quantities->getId());
            $stmt->bindParam(':name',$quantities->getName());
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
     * Delete an quantities from the database
     * @param quantities $quantities quantities object
     * @return false if could'nt delete it
     * @return true if the quantities was deleted
     */
    function delete($quantities){
        $deleted=false;
        if($this->exist($quantities->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE quantities WHERE id=:id");
            $stmt->bindParam(':id',$quantities->getId());
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
     * Return if a quantities exist in the database
     * @param int $id quantities identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM quantities WHERE id=:id");
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
     * Get the list of quantities
     * @return quantities[] List of quantities
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM quantities");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $quantities=$this->read($row["id"]);
                array_push($list,$quantities);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}