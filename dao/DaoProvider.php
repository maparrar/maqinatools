<?php
/** DaoProvider File
 * @package models @subpackage dal */
/**
 * DaoProvider Class
 *
 * Class data layer for the Provider class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoProvider{
    /**
     * Create an Provider in the database
     * @param Provider $provider new Provider
     * @return Provider Provider stored
     * @return string "exist" if the Provider already exist
     * @return false if the Provider couldn't created
     */
    function create($provider){
        $created=false;
        if(!$this->exist($provider->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO Provider 
                (`id`) VALUES 
                (:id)");
            $stmt->bindParam(':id',$provider->getId());
            if($stmt->execute()){
                $provider->setId(intval($handler->lastInsertID()));
                $created=$provider;
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
     * Read a Provider from the database
     * @param int $id Provider identificator
     * @return Provider Provider loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM Provider WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $provider=new Provider();
                $provider->setId(intval($row["id"]));
                $response=$provider;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Provider in the database
     * @param Provider $provider Provider object
     * @return false if could'nt update it
     * @return true if the Provider was updated
     */
    function update($provider){
        $updated=false;
        if($this->exist($provider->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE Provider SET 
                WHERE id=:id");
            $stmt->bindParam(':id',$provider->getId());
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
     * Delete an Provider from the database
     * @param Provider $provider Provider object
     * @return false if could'nt delete it
     * @return true if the Provider was deleted
     */
    function delete($provider){
        $deleted=false;
        if($this->exist($provider->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE Provider WHERE id=:id");
            $stmt->bindParam(':id',$provider->getId());
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
     * Return if a Provider exist in the database
     * @param int $id Provider identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM Provider WHERE id=:id");
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
     * Get the list of Provider
     * @return Provider[] List of Provider
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM Provider");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $provider=$this->read($row["id"]);
                array_push($list,$provider);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}