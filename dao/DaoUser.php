<?php
/** DaoUser File
 * @package models @subpackage dal */
/**
 * DaoUser Class
 *
 * Class data layer for the User class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoUser extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoUser(){
        parent::Dao();
    }
    /**
     * Create an User in the database
     * @param User new User
     * @return User User stored
     * @return string "exist" if the User already exist
     * @return false if the User couldn't created
     */
    function create($user){
        $created=false;
        if(!$this->exist($user->getCode())){    
            $stmt = $this->handler->prepare("INSERT INTO User 
                (`code`,`name`,`lastname`) VALUES 
                (:code,:name,:lastname)");
            $stmt->bindParam(':code',$user->getCode());
            $stmt->bindParam(':name',$user->getName());
            $stmt->bindParam(':lastname',$user->getLastname());
            if($stmt->execute()){
                $user->setCode(intval($this->handler->lastInsertID()));
                $created=$user;
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
     * Read a User from the database
     * @param int User identificator
     * @return User User loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $stmt = $this->handler->prepare("SELECT * FROM User WHERE code= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $user=new User();
                $user->setCode(intval($row["code"]));
                $user->setName($row["name"]);
                $user->setLastname($row["lastname"]);
                $response=$user;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a User in the database
     * @param User User object
     * @return false if could'nt update it
     * @return true if the User was updated
     */
    function update($user){
        $updated=false;
        if($this->exist($user->getCode())){
            $stmt = $this->handler->prepare("UPDATE User SET 
                `name`=:name,
                `lastname`=:lastname,
                WHERE code=:code");
            $stmt->bindParam(':code',$user->getCode());
            $stmt->bindParam(':name',$user->getName());
            $stmt->bindParam(':lastname',$user->getLastname());
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
     * Delete an User from the database
     * @param User User object
     * @return false if could'nt delete it
     * @return true if the User was deleted
     */
    function delete($user){
        $deleted=false;
        if($this->exist($user->getCode())){
            $stmt = $this->handler->prepare("DELETE User WHERE code=:code");
            $stmt->bindParam(':code',$user->getCode());
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
     * Return if a User exist in the database
     * @param int User identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT code FROM User WHERE code=:code");
        $stmt->bindParam(':code',$id);
        if ($stmt->execute()) {
            $list=$stmt->fetch();
            if($list){
                if(intval($list["code"])===intval($id)){
                    $exist=true;
                }else{
                    $exist=false;
                }
            }
        }
        return $exist;
    }
    /**
     * Get the list of User
     * @return User[] List of User
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT code FROM User");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $user=$this->read($row["code"]);
                array_push($list,$user);
            }
        }
        return $list;
    }
}