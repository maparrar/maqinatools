<?php
/** DaoStruct File
 * @package models @subpackage dal */
/**
 * DaoStruct Class
 *
 * Class data layer for the Struct class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author Alejandro Parra <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoStruct extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoStruct(){
        parent::Dao();
    }
    /**
     * Create an Struct in the database
     * @param Struct new Struct
     * @return Struct Struct stored
     * @return string "exist" if the Struct already exist
     * @return false if the Struct couldn't created
     */
    function create($struct){
        $created=false;
        if(!$this->exist($struct->getId())){    
            $stmt = $this->handler->prepare("INSERT INTO structs 
                (`package`,`subpackage`,`class`,`atributes`,`pk`) VALUES 
                (:package,:subpackage,:class,:atributes,:pk)");
            $stmt->bindParam(':package',$struct->getPackage());
            $stmt->bindParam(':subpackage',$struct->getSubpackage());
            $stmt->bindParam(':class',$struct->getClass());
            $stmt->bindParam(':atributes',$struct->getAtributes());
            $stmt->bindParam(':pk',$struct->getPk());
            if($stmt->execute()){
                $struct->setId(intval($this->handler->lastInsertID()));
                $created=$struct;
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
     * Read a Struct from the database
     * @param int Struct identificator
     * @return Struct Struct loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $stmt = $this->handler->prepare("SELECT * FROM structs WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $struct=new Struct();
                $struct->setPackage($row["package"]);
                $struct->setSubpackage($row["subpackage"]);
                $struct->setClass($row["class"]);
                $struct->setAtributes($row["atributes"]);
                $struct->setPk($row["pk"]);
                $response=$struct;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Struct in the database
     * @param Struct Struct object
     * @return false if could'nt update it
     * @return true if the Struct was updated
     */
    function update($struct){
        $updated=false;
        if($this->exist($struct->getId())){
            $stmt = $this->handler->prepare("UPDATE structs SET 
                `package`=:package,
                `subpackage`=:subpackage,
                `class`=:class,
                `atributes`=:atributes,
                `pk`=:pk,
                WHERE id=:id");
            $stmt->bindParam(':package',$struct->getPackage());
            $stmt->bindParam(':subpackage',$struct->getSubpackage());
            $stmt->bindParam(':class',$struct->getClass());
            $stmt->bindParam(':atributes',$struct->getAtributes());
            $stmt->bindParam(':pk',$struct->getPk());
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
     * Delete an Struct from the database
     * @param Struct Struct object
     * @return false if could'nt delete it
     * @return true if the Struct was deleted
     */
    function delete($struct){
        $deleted=false;
        if($this->exist($struct->getId())){
            $stmt = $this->handler->prepare("DELETE structs WHERE id=:id");
            $stmt->bindParam(':id',$struct->getId());
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
     * Return if a Struct exist in the database
     * @param int Struct identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT id FROM structs WHERE id=:id");
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
     * Get the list of Struct
     * @return Struct[] List of Struct
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT id FROM structs");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $struct=$this->read($row["id"]);
                array_push($list,$struct);
            }
        }
        return $list;
    }
}
