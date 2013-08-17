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
class DaoProvider extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoProvider(){
        parent::Dao();
    }
    /**
     * Create an Provider in the database
     * @param Provider new Provider
     * @return Provider Provider stored
     * @return string "exist" if the Provider already exist
     * @return false if the Provider couldn't created
     */
    function create($provider){
        $created=false;
        if(!$this->exist($provider->getId())){    
            $stmt = $this->handler->prepare("INSERT INTO Provider 
                (`id`) VALUES 
                (:id)");
            $stmt->bindParam(':id',$provider->getId());
            if($stmt->execute()){
                $provider->setId(intval($this->handler->lastInsertID()));
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
     * @param int Provider identificator
     * @return Provider Provider loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $stmt = $this->handler->prepare("SELECT * FROM Provider WHERE id= ?");
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
     * @param Provider Provider object
     * @return false if could'nt update it
     * @return true if the Provider was updated
     */
    function update($provider){
        $updated=false;
        if($this->exist($provider->getId())){
            $stmt = $this->handler->prepare("UPDATE Provider SET 
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
     * @param Provider Provider object
     * @return false if could'nt delete it
     * @return true if the Provider was deleted
     */
    function delete($provider){
        $deleted=false;
        if($this->exist($provider->getId())){
            $stmt = $this->handler->prepare("DELETE Provider WHERE id=:id");
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
     * @param int Provider identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT id FROM Provider WHERE id=:id");
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
     * Get the list of Provider
     * @return Provider[] List of Provider
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT id FROM Provider");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $provider=$this->read($row["id"]);
                array_push($list,$provider);
            }
        }
        return $list;
    }
}