<?php
/** DaoDatabase File
 * @package models @subpackage dal */
/**
 * DaoDatabase Class
 *
 * Class data layer for the Database class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoDatabase extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoDatabase(){
        parent::Dao();
    }
    /**
     * Create an Database in the database
     * @param Database $database new Database
     * @return Database Database stored
     * @return string "exist" if the Database already exist
     * @return false if the Database couldn't created
     */
    function create($database){
        $created=false;
        if(!$this->exist($database->getName())){    
            $stmt = $this->handler->prepare("INSERT INTO Database 
                (`name`,`driver`,`persistent`,`host`,`connections`) VALUES 
                (:name,:driver,:persistent,:host,:connections)");
            $stmt->bindParam(':name',$database->getName());
            $stmt->bindParam(':driver',$database->getDriver());
            $stmt->bindParam(':persistent',$database->getPersistent());
            $stmt->bindParam(':host',$database->getHost());
            $stmt->bindParam(':connections',$database->getConnections());
            if($stmt->execute()){
                $database->setName(intval($this->handler->lastInsertID()));
                $created=$database;
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
     * Read a Database from the database
     * @param int $name Database identificator
     * @return Database Database loaded
     */
    function read($name){
        $response=null;
        if($this->exist($name)){
            $stmt = $this->handler->prepare("SELECT * FROM Database WHERE name= ?");
            if ($stmt->execute(array($name))) {
                $row=$stmt->fetch();
                $database=new Database();
                $database->setName($row["name"]);
                $database->setDriver($row["driver"]);
                $database->setPersistent($row["persistent"]);
                $database->setHost($row["host"]);
                $database->setConnections($row["connections"]);
                $response=$database;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Database in the database
     * @param Database $database Database object
     * @return false if could'nt update it
     * @return true if the Database was updated
     */
    function update($database){
        $updated=false;
        if($this->exist($database->getName())){
            $stmt = $this->handler->prepare("UPDATE Database SET 
                `driver`=:driver,
                `persistent`=:persistent,
                `host`=:host,
                `connections`=:connections,
                WHERE name=:name");
            $stmt->bindParam(':name',$database->getName());
            $stmt->bindParam(':driver',$database->getDriver());
            $stmt->bindParam(':persistent',$database->getPersistent());
            $stmt->bindParam(':host',$database->getHost());
            $stmt->bindParam(':connections',$database->getConnections());
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
     * Delete an Database from the database
     * @param Database $database Database object
     * @return false if could'nt delete it
     * @return true if the Database was deleted
     */
    function delete($database){
        $deleted=false;
        if($this->exist($database->getName())){
            $stmt = $this->handler->prepare("DELETE Database WHERE name=:name");
            $stmt->bindParam(':name',$database->getName());
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
     * Return if a Database exist in the database
     * @param int $name Database identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($name){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT name FROM Database WHERE name=:name");
        $stmt->bindParam(':name',$name);
        if ($stmt->execute()) {
            $list=$stmt->fetch();
            if($list){
                if(intval($list["name"])===intval($name)){
                    $exist=true;
                }else{
                    $exist=false;
                }
            }
        }
        return $exist;
    }
    /**
     * Get the list of Database
     * @return Database[] List of Database
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT name FROM Database");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $database=$this->read($row["name"]);
                array_push($list,$database);
            }
        }
        return $list;
    }
}