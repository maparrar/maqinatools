<?php
/** DaoProduct File
 * @package models @subpackage dal */
/**
 * DaoProduct Class
 *
 * Class data layer for the Product class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author maparrar <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoProduct{
    /**
     * Create an Product in the database
     * @param Product $product new Product
     * @return Product Product stored
     * @return string "exist" if the Product already exist
     * @return false if the Product couldn't created
     */
    function create($product){
        $created=false;
        if(!$this->exist($product->getId())){    
            $handler=Maqinato::connect("write");
            $stmt = $handler->prepare("INSERT INTO Product 
                (`id`,`name`) VALUES 
                (:id,:name)");
            $stmt->bindParam(':id',$product->getId());
            $stmt->bindParam(':name',$product->getName());
            if($stmt->execute()){
                $product->setId(intval($handler->lastInsertID()));
                $created=$product;
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
     * Read a Product from the database
     * @param int $id Product identificator
     * @return Product Product loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $handler=Maqinato::connect("read");
            $stmt = $handler->prepare("SELECT * FROM Product WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $product=new Product();
                $product->setId(intval($row["id"]));
                $product->setName($row["name"]);
                $response=$product;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Product in the database
     * @param Product $product Product object
     * @return false if could'nt update it
     * @return true if the Product was updated
     */
    function update($product){
        $updated=false;
        if($this->exist($product->getId())){
            $handler=Maqinato::connect();
            $stmt = $handler->prepare("UPDATE Product SET 
                `name`=:name,
                WHERE id=:id");
            $stmt->bindParam(':id',$product->getId());
            $stmt->bindParam(':name',$product->getName());
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
     * Delete an Product from the database
     * @param Product $product Product object
     * @return false if could'nt delete it
     * @return true if the Product was deleted
     */
    function delete($product){
        $deleted=false;
        if($this->exist($product->getId())){
            $handler=Maqinato::connect("delete");
            $stmt = $handler->prepare("DELETE Product WHERE id=:id");
            $stmt->bindParam(':id',$product->getId());
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
     * Return if a Product exist in the database
     * @param int $id Product identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM Product WHERE id=:id");
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
     * Get the list of Product
     * @return Product[] List of Product
     */
    function listing(){
        $list=array();
        $handler=Maqinato::connect("read");
        $stmt = $handler->prepare("SELECT id FROM Product");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $product=$this->read($row["id"]);
                array_push($list,$product);
            }
        }else{
            $error=$stmt->errorInfo();
            error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
        }
        return $list;
    }
}