<?php
/** DaoGenerator File
 * @package models @subpackage dal */
/**
 * DaoGenerator Class
 *
 * Class data layer for the Generator class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author Alejandro Parra <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoGenerator extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoGenerator(){
        parent::Dao();
    }
    /**
     * Create an Generator in the database
     * @param Generator new Generator
     * @return Generator Generator stored
     * @return string "exist" if the Generator already exist
     * @return false if the Generator couldn't created
     */
    function create($generator){
        $created=false;
        if(!$this->exist($generator->getId())){    
            $stmt = $this->handler->prepare("INSERT INTO generators 
                (`project`,`author`,`web`,`structs`,`extends`) VALUES 
                (:project,:author,:web,:structs,:extends)");
            $stmt->bindParam(':project',$generator->getProject());
            $stmt->bindParam(':author',$generator->getAuthor());
            $stmt->bindParam(':web',$generator->getWeb());
            $stmt->bindParam(':structs',$generator->getStructs());
            $stmt->bindParam(':extends',$generator->getExtends());
            if($stmt->execute()){
                $generator->setId(intval($this->handler->lastInsertID()));
                $created=$generator;
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
     * Read a Generator from the database
     * @param int Generator identificator
     * @return Generator Generator loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $stmt = $this->handler->prepare("SELECT * FROM generators WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $generator=new Generator();
                $generator->setProject($row["project"]);
                $generator->setAuthor($row["author"]);
                $generator->setWeb($row["web"]);
                $generator->setStructs($row["structs"]);
                $generator->setExtends($row["extends"]);
                $response=$generator;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Generator in the database
     * @param Generator Generator object
     * @return false if could'nt update it
     * @return true if the Generator was updated
     */
    function update($generator){
        $updated=false;
        if($this->exist($generator->getId())){
            $stmt = $this->handler->prepare("UPDATE generators SET 
                `project`=:project,
                `author`=:author,
                `web`=:web,
                `structs`=:structs,
                `extends`=:extends,
                WHERE id=:id");
            $stmt->bindParam(':project',$generator->getProject());
            $stmt->bindParam(':author',$generator->getAuthor());
            $stmt->bindParam(':web',$generator->getWeb());
            $stmt->bindParam(':structs',$generator->getStructs());
            $stmt->bindParam(':extends',$generator->getExtends());
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
     * Delete an Generator from the database
     * @param Generator Generator object
     * @return false if could'nt delete it
     * @return true if the Generator was deleted
     */
    function delete($generator){
        $deleted=false;
        if($this->exist($generator->getId())){
            $stmt = $this->handler->prepare("DELETE generators WHERE id=:id");
            $stmt->bindParam(':id',$generator->getId());
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
     * Return if a Generator exist in the database
     * @param int Generator identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT id FROM generators WHERE id=:id");
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
     * Get the list of Generator
     * @return Generator[] List of Generator
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT id FROM generators");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $generator=$this->read($row["id"]);
                array_push($list,$generator);
            }
        }
        return $list;
    }
}
