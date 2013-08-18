<?php
/** DaoConnection File
 * @package models @subpackage dal */
/**
 * DaoConnection Class
 *
 * Class data layer for the Connection class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoConnection extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoConnection(){
        parent::Dao();
    }
    /**
     * Create an Connection in the database
     * @param Connection $connection new Connection
     * @return Connection Connection stored
     * @return string "exist" if the Connection already exist
     * @return false if the Connection couldn't created
     */
    function create($connection){
        $created=false;
        if(!$this->exist($connection->getName())){    
            $stmt = $this->handler->prepare("INSERT INTO Connection 
                (`name`,`login`,`password`) VALUES 
                (:name,:login,:password)");
            $stmt->bindParam(':name',$connection->getName());
            $stmt->bindParam(':login',$connection->getLogin());
            $stmt->bindParam(':password',$connection->getPassword());
            if($stmt->execute()){
                $connection->setName(intval($this->handler->lastInsertID()));
                $created=$connection;
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
     * Read a Connection from the database
     * @param int $name Connection identificator
     * @return Connection Connection loaded
     */
    function read($name){
        $response=null;
        if($this->exist($name)){
            $stmt = $this->handler->prepare("SELECT * FROM Connection WHERE name= ?");
            if ($stmt->execute(array($name))) {
                $row=$stmt->fetch();
                $connection=new Connection();
                $connection->setName($row["name"]);
                $connection->setLogin($row["login"]);
                $connection->setPassword($row["password"]);
                $response=$connection;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Connection in the database
     * @param Connection $connection Connection object
     * @return false if could'nt update it
     * @return true if the Connection was updated
     */
    function update($connection){
        $updated=false;
        if($this->exist($connection->getName())){
            $stmt = $this->handler->prepare("UPDATE Connection SET 
                `login`=:login,
                `password`=:password,
                WHERE name=:name");
            $stmt->bindParam(':name',$connection->getName());
            $stmt->bindParam(':login',$connection->getLogin());
            $stmt->bindParam(':password',$connection->getPassword());
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
     * Delete an Connection from the database
     * @param Connection $connection Connection object
     * @return false if could'nt delete it
     * @return true if the Connection was deleted
     */
    function delete($connection){
        $deleted=false;
        if($this->exist($connection->getName())){
            $stmt = $this->handler->prepare("DELETE Connection WHERE name=:name");
            $stmt->bindParam(':name',$connection->getName());
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
     * Return if a Connection exist in the database
     * @param int $name Connection identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($name){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT name FROM Connection WHERE name=:name");
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
     * Get the list of Connection
     * @return Connection[] List of Connection
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT name FROM Connection");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $connection=$this->read($row["name"]);
                array_push($list,$connection);
            }
        }
        return $list;
    }
}