<?php
/** Daoinfluences File
 * @package models @subpackage dal */
/**
 * Daoinfluences Class
 *
 * Class data layer for the influences class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class Daoinfluences{
    /**
     * Create an influences in the database
     * @param influences $influences new influences
     * @return influences influences stored
     * @return string "exist" if the influences already exist
     * @return false if the influences couldn't created
     */
    function create($influences){
        $created=false;
        if(!$this->exist($influences->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO influences 
                (`id`,`achievement`,`impact`,`quantity`,`minCost`,`maxCost`) VALUES 
                (:id,:achievement,:impact,:quantity,:minCost,:maxCost)");
            $stmt->bindParam(':id',$influences->getId());
            $stmt->bindParam(':achievement',$influences->getAchievement());
            $stmt->bindParam(':impact',$influences->getImpact());
            $stmt->bindParam(':quantity',$influences->getQuantity());
            $stmt->bindParam(':minCost',$influences->getMinCost());
            $stmt->bindParam(':maxCost',$influences->getMaxCost());
            if($stmt->execute()){
                $influences->setId(intval($handler->lastInsertID()));
                $created=$influences;
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
     * Read a influences from the database
     * @param int $id influences identificator
     * @return influences influences loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM influences WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $influences=new influences();
                $influences->setId($row["id"]);
                $influences->setAchievement(intval($row["achievement"]));
                $influences->setImpact($row["impact"]);
                $influences->setQuantity($row["quantity"]);
                $influences->setMinCost($row["minCost"]);
                $influences->setMaxCost($row["maxCost"]);
                $response=$influences;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a influences in the database
     * @param influences $influences influences object
     * @return false if could'nt update it
     * @return true if the influences was updated
     */
    function update($influences){
        $updated=false;
        if($this->exist($influences->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE influences SET 
                `achievement`=:achievement,
                `impact`=:impact,
                `quantity`=:quantity,
                `minCost`=:minCost,
                `maxCost`=:maxCost,
                WHERE id=:id");
            $stmt->bindParam(':id',$influences->getId());
            $stmt->bindParam(':achievement',$influences->getAchievement());
            $stmt->bindParam(':impact',$influences->getImpact());
            $stmt->bindParam(':quantity',$influences->getQuantity());
            $stmt->bindParam(':minCost',$influences->getMinCost());
            $stmt->bindParam(':maxCost',$influences->getMaxCost());
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
     * Delete an influences from the database
     * @param influences $influences influences object
     * @return false if could'nt delete it
     * @return true if the influences was deleted
     */
    function delete($influences){
        $deleted=false;
        if($this->exist($influences->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE influences WHERE id=:id");
            $stmt->bindParam(':id',$influences->getId());
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
     * Return if a influences exist in the database
     * @param int $id influences identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM influences WHERE id=:id");
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
     * Get the list of influences
     * @return influences[] List of influences
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM influences");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $influences=$this->read($row["id"]);
                array_push($list,$influences);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}