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
class DaoClient{
    /**
     * Create an Client in the database
     * @param Client $client new Client
     * @return Client Client stored
     * @return string "exist" if the Client already exist
     * @return false if the Client couldn't created
     */
    function create($client){
        $created=false;
        if(!$this->exist($client->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO Client 
                (`id`) VALUES 
                (:id)");
            $stmt->bindParam(':id',$client->getId());
            if($stmt->execute()){
                $client->setId(intval($handler->lastInsertID()));
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
     * @param int $id Client identificator
     * @return Client Client loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM Client WHERE id= ?");
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
     * @param Client $client Client object
     * @return false if could'nt update it
     * @return true if the Client was updated
     */
    function update($client){
        $updated=false;
        if($this->exist($client->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE Client SET 
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
     * @param Client $client Client object
     * @return false if could'nt delete it
     * @return true if the Client was deleted
     */
    function delete($client){
        $deleted=false;
        if($this->exist($client->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE Client WHERE id=:id");
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
     * @param int $id Client identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM Client WHERE id=:id");
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
     * Get the list of Client
     * @return Client[] List of Client
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM Client");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $client=$this->read($row["id"]);
                array_push($list,$client);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}