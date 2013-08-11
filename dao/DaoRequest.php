<?php
/** DaoRequest File
 * @package models @subpackage dal */
/**
 * DaoRequest Class
 *
 * Class data layer for the Request class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author Alejandro Parra <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoRequest extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoRequest(){
        parent::Dao();
    }
    /**
     * Create an Request in the database
     * @param Request new Request
     * @return Request Request stored
     * @return string "exist" if the Request already exist
     * @return false if the Request couldn't created
     */
    function create($request){
        $created=false;
        if(!$this->exist($request->getId())){    
            $stmt = $this->handler->prepare("INSERT INTO requests 
                (`controller`,`function`,`parameters`) VALUES 
                (:controller,:function,:parameters)");
            $stmt->bindParam(':controller',$request->getController());
            $stmt->bindParam(':function',$request->getFunction());
            $stmt->bindParam(':parameters',$request->getParameters());
            if($stmt->execute()){
                $request->setId(intval($this->handler->lastInsertID()));
                $created=$request;
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
     * Read a Request from the database
     * @param int Request identificator
     * @return Request Request loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $stmt = $this->handler->prepare("SELECT * FROM requests WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $request=new Request();
                $request->setController($row["controller"]);
                $request->setFunction($row["function"]);
                $request->setParameters($row["parameters"]);
                $response=$request;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Request in the database
     * @param Request Request object
     * @return false if could'nt update it
     * @return true if the Request was updated
     */
    function update($request){
        $updated=false;
        if($this->exist($request->getId())){
            $stmt = $this->handler->prepare("UPDATE requests SET 
                `controller`=:controller,
                `function`=:function,
                `parameters`=:parameters,
                WHERE id=:id");
            $stmt->bindParam(':controller',$request->getController());
            $stmt->bindParam(':function',$request->getFunction());
            $stmt->bindParam(':parameters',$request->getParameters());
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
     * Delete an Request from the database
     * @param Request Request object
     * @return false if could'nt delete it
     * @return true if the Request was deleted
     */
    function delete($request){
        $deleted=false;
        if($this->exist($request->getId())){
            $stmt = $this->handler->prepare("DELETE requests WHERE id=:id");
            $stmt->bindParam(':id',$request->getId());
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
     * Return if a Request exist in the database
     * @param int Request identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT id FROM requests WHERE id=:id");
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
     * Get the list of Request
     * @return Request[] List of Request
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT id FROM requests");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $request=$this->read($row["id"]);
                array_push($list,$request);
            }
        }
        return $list;
    }
}
