<?php
/** DaoTest File
 * @package models @subpackage dal */
/**
 * DaoTest Class
 *
 * Class data layer for the Test class
 * 
 * @author https://github.com/maparrar/maqinato
 * @author Alejandro Parra <maparrar@gmail.com>
 * @package models
 * @subpackage dal
 */
class DaoTest extends Dao{
    /**
     * Constructor: sets the database Object and the PDO handler
     * @param string Type of connection string to use
     */
    function DaoTest(){
        parent::Dao();
    }
    /**
     * Create an Test in the database
     * @param Test new Test
     * @return Test Test stored
     * @return string "exist" if the Test already exist
     * @return false if the Test couldn't created
     */
    function create($test){
        $created=false;
        if(!$this->exist($test->getId())){    
            $stmt = $this->handler->prepare("INSERT INTO tests 
                (`id`,`content`,`page`,`element`,`position`,`arrowPosition`,`height`,`width`,`image`) VALUES 
                (:id,:content,:page,:element,:position,:arrowPosition,:height,:width,:image)");
            $stmt->bindParam(':id',$test->getId());
            $stmt->bindParam(':content',$test->getContent());
            $stmt->bindParam(':page',$test->getPage());
            $stmt->bindParam(':element',$test->getElement());
            $stmt->bindParam(':position',$test->getPosition());
            $stmt->bindParam(':arrowPosition',$test->getArrowPosition());
            $stmt->bindParam(':height',$test->getHeight());
            $stmt->bindParam(':width',$test->getWidth());
            $stmt->bindParam(':image',$test->getImage());
            if($stmt->execute()){
                $test->setId(intval($this->handler->lastInsertID()));
                $created=$test;
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
     * Read a Test from the database
     * @param int Test identificator
     * @return Test Test loaded
     */
    function read($id){
        $response=null;
        if($this->exist($id)){
            $stmt = $this->handler->prepare("SELECT * FROM tests WHERE id= ?");
            if ($stmt->execute(array($id))) {
                $row=$stmt->fetch();
                $test=new Test();
                $test->setId(intval($row["id"]));
                $test->setContent($row["content"]);
                $test->setPage($row["page"]);
                $test->setElement($row["element"]);
                $test->setPosition($row["position"]);
                $test->setArrowPosition(intval($row["arrowPosition"]));
                $test->setHeight(intval($row["height"]));
                $test->setWidth(intval($row["width"]));
                $test->setImage($row["image"]);
                $response=$test;
            }else{
                $error=$stmt->errorInfo();
                error_log("[".__FILE__.":".__LINE__."]"."Mysql: ".$error[2]);
            }
        }
        return $response;
    }
    /**
     * Update a Test in the database
     * @param Test Test object
     * @return false if could'nt update it
     * @return true if the Test was updated
     */
    function update($test){
        $updated=false;
        if($this->exist($test->getId())){
            $stmt = $this->handler->prepare("UPDATE tests SET 
                `content`=:content,
                `page`=:page,
                `element`=:element,
                `position`=:position,
                `arrowPosition`=:arrowPosition,
                `height`=:height,
                `width`=:width,
                `image`=:image,
                WHERE id=:id");
            $stmt->bindParam(':id',$test->getId());
            $stmt->bindParam(':content',$test->getContent());
            $stmt->bindParam(':page',$test->getPage());
            $stmt->bindParam(':element',$test->getElement());
            $stmt->bindParam(':position',$test->getPosition());
            $stmt->bindParam(':arrowPosition',$test->getArrowPosition());
            $stmt->bindParam(':height',$test->getHeight());
            $stmt->bindParam(':width',$test->getWidth());
            $stmt->bindParam(':image',$test->getImage());
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
     * Delete an Test from the database
     * @param Test Test object
     * @return false if could'nt delete it
     * @return true if the Test was deleted
     */
    function delete($test){
        $deleted=false;
        if($this->exist($test->getId())){
            $stmt = $this->handler->prepare("DELETE tests WHERE id=:id");
            $stmt->bindParam(':id',$test->getId());
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
     * Return if a Test exist in the database
     * @param int Test identificator
     * @return false if doesn't exist
     * @return true if exist
     */
    function exist($id){
        $exist=false;
        $stmt = $this->handler->prepare("SELECT id FROM tests WHERE id=:id");
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
     * Get the list of Test
     * @return Test[] List of Test
     */
    function listing(){
        $list=array();
        $stmt = $this->handler->prepare("SELECT id FROM tests");
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()){
                $test=$this->read($row["id"]);
                array_push($list,$test);
            }
        }
        return $list;
    }
}
?>