<?php
/** DaoClient File
 * @package models @subpackage dal */
/**
 * DaoClient Class
 *
 * Class data layer for the Client class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoClient extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoClient(){
        parent::Dao();
    }
    /**
     * Create an Client in the database
     * @param Client new Client
     * @return Client Client stored
     * @return string "exist" if the Client already exist
     * @return false if the Client couldn't created
     */
    function create($client){
        $created=false;
        if(!$this->exist($client->getId())){    
            $stmt = $this->handler->prepare("INSERT INTO Client 
                (`id`) VALUES 
                (:id)");
            $stmt->bindParam(':id',$client->getId());
            if($stmt->execute()){
                $client->setId(intval($this->handler->lastInsertID()));
                $created=$client;
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
     * Read a Client from the database
     * @param int Client identificator
     * @return Client Client loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $stmt = $this->handler->prepare("SELECT * FROM Client WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $client=new Client();
                $client->setId(intval($row["id"]));
                $response=$client;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Client in the database
     * @param Client Client object
     * @return false if could'nt update it
     * @return true if the Client was updated
     */
    function update($client){
        $updated=false;
        if($this->exist($client->getId())){
            $stmt = $this->handler->prepare("UPDATE Client SET 
                WHERE id=:id");
            $stmt->bindParam(':id',$client->getId());
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
     * Delete an Client from the database
     * @param Client Client object
     * @return false if could'nt delete it
     * @return true if the Client was deleted
     */
    function delete($client){
        $deleted=false;
        if($this->exist($client->getId())){
            $stmt = $this->handler->prepare("DELETE Client WHERE id=:id");
            $stmt->bindParam(':id',$client->getId());
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
     * Return if a Client exist in the database
     * @param int Client identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT id FROM Client WHERE id=:id");
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
        }
        return $exist;
    }
    /**
     * Get the list of Client
     * @return Client[] List of Client
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT id FROM Client");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $client=$this->read($row["id"]);
                array_push($list,$client);
            }
        }
        return $list;
    }
}