<?php
/** DaoEnvironment File
 * @package models @subpackage dal */
/**
 * DaoEnvironment Class
 *
 * Class data layer for the Environment class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoEnvironment extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoEnvironment(){
        parent::Dao();
    }
    /**
     * Create an Environment in the database
     * @param Environment $environment new Environment
     * @return Environment Environment stored
     * @return string "exist" if the Environment already exist
     * @return false if the Environment couldn't created
     */
    function create($environment){
        $created=false;
        if(!$this->exist($environment->getName())){    
            $stmt = $this->handler->prepare("INSERT INTO Environment 
                (`name`,`urls`,`database`) VALUES 
                (:name,:urls,:database)");
            $stmt->bindParam(':name',$environment->getName());
            $stmt->bindParam(':urls',$environment->getUrls());
            $stmt->bindParam(':database',$environment->getDatabase());
            if($stmt->execute()){
                $environment->setName(intval($this->handler->lastInsertID()));
                $created=$environment;
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
     * Read a Environment from the database
     * @param int $name Environment identificator
     * @return Environment Environment loaded
     */
    function read($name){
        $response=null;
        if($this->exist($name)){
            $stmt = $this->handler->prepare("SELECT * FROM Environment WHERE name= ?");
            if ($stmt->execute(array($name))) {
                $row=$stmt->fetch();
                $environment=new Environment();
                $environment->setName($row["name"]);
                $environment->setUrls($row["urls"]);
                $environment->setDatabase($row["database"]);
                $response=$environment;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Environment in the database
     * @param Environment $environment Environment object
     * @return false if could'nt update it
     * @return true if the Environment was updated
     */
    function update($environment){
        $updated=false;
        if($this->exist($environment->getName())){
            $stmt = $this->handler->prepare("UPDATE Environment SET 
                `urls`=:urls,
                `database`=:database,
                WHERE name=:name");
            $stmt->bindParam(':name',$environment->getName());
            $stmt->bindParam(':urls',$environment->getUrls());
            $stmt->bindParam(':database',$environment->getDatabase());
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
     * Delete an Environment from the database
     * @param Environment $environment Environment object
     * @return false if could'nt delete it
     * @return true if the Environment was deleted
     */
    function delete($environment){
        $deleted=false;
        if($this->exist($environment->getName())){
            $stmt = $this->handler->prepare("DELETE Environment WHERE name=:name");
            $stmt->bindParam(':name',$environment->getName());
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
     * Return if a Environment exist in the database
     * @param int $name Environment identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($name){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT name FROM Environment WHERE name=:name");
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
     * Get the list of Environment
     * @return Environment[] List of Environment
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT name FROM Environment");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $environment=$this->read($row["name"]);
                array_push($list,$environment);
            }
        }
        return $list;
    }
}