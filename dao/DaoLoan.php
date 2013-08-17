<?php
/** DaoLoan File
 * @package models @subpackage dal */
/**
 * DaoLoan Class
 *
 * Class data layer for the Loan class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoLoan extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoLoan(){
        parent::Dao();
    }
    /**
     * Create an Loan in the database
     * @param Loan new Loan
     * @return Loan Loan stored
     * @return string "exist" if the Loan already exist
     * @return false if the Loan couldn't created
     */
    function create($loan){
        $created=false;
        if(!$this->exist($loan->getId())){    
            $stmt = $this->handler->prepare("INSERT INTO Loan 
                (`id`,`date`,`interest`,`paid`,`from`,`to`) VALUES 
                (:id,:date,:interest,:paid,:from,:to)");
            $stmt->bindParam(':id',$loan->getId());
            $stmt->bindParam(':date',$loan->getDate());
            $stmt->bindParam(':interest',$loan->getInterest());
            $stmt->bindParam(':paid',$loan->getPaid());
            $stmt->bindParam(':from',$loan->getFrom());
            $stmt->bindParam(':to',$loan->getTo());
            if($stmt->execute()){
                $loan->setId(intval($this->handler->lastInsertID()));
                $created=$loan;
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
     * Read a Loan from the database
     * @param int Loan identificator
     * @return Loan Loan loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $stmt = $this->handler->prepare("SELECT * FROM Loan WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $loan=new Loan();
                $loan->setId(intval($row["id"]));
                $loan->setDate($row["date"]);
                $loan->setInterest(floatval($row["interest"]));
                $loan->setPaid(intval($row["paid"]));
                $loan->setFrom(intval($row["from"]));
                $loan->setTo(intval($row["to"]));
                $response=$loan;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Loan in the database
     * @param Loan Loan object
     * @return false if could'nt update it
     * @return true if the Loan was updated
     */
    function update($loan){
        $updated=false;
        if($this->exist($loan->getId())){
            $stmt = $this->handler->prepare("UPDATE Loan SET 
                `date`=:date,
                `interest`=:interest,
                `paid`=:paid,
                `from`=:from,
                `to`=:to,
                WHERE id=:id");
            $stmt->bindParam(':id',$loan->getId());
            $stmt->bindParam(':date',$loan->getDate());
            $stmt->bindParam(':interest',$loan->getInterest());
            $stmt->bindParam(':paid',$loan->getPaid());
            $stmt->bindParam(':from',$loan->getFrom());
            $stmt->bindParam(':to',$loan->getTo());
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
     * Delete an Loan from the database
     * @param Loan Loan object
     * @return false if could'nt delete it
     * @return true if the Loan was deleted
     */
    function delete($loan){
        $deleted=false;
        if($this->exist($loan->getId())){
            $stmt = $this->handler->prepare("DELETE Loan WHERE id=:id");
            $stmt->bindParam(':id',$loan->getId());
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
     * Return if a Loan exist in the database
     * @param int Loan identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT id FROM Loan WHERE id=:id");
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
     * Get the list of Loan
     * @return Loan[] List of Loan
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT id FROM Loan");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $loan=$this->read($row["id"]);
                array_push($list,$loan);
            }
        }
        return $list;
    }
}