<?php
/** User File
* @package  @subpackage  */
/**
* User Class
*
* @author https://github.com/maparrar/maqinato
* @author maparrar <maparrar@gmail.com>
* @package 
* @subpackage 
*/
class User extends Object{
    /** 
     *  
     * 
     * @var int
     */
    protected $id;
    /** 
     *  
     * 
     * @var string
     */
    protected $username;
    /** 
     *  
     * 
     * @var string
     */
    protected $password;
    /** 
     *  
     * 
     * @var string
     */
    protected $salt;
    /**
    * Constructor
    * @param int $id         
    * @param string $username         
    * @param string $password         
    * @param string $salt         
    */
    function __construct($id=0,$username="",$password="",$salt=""){        
        $this->id=$id;
        $this->username=$username;
        $this->password=$password;
        $this->salt=$salt;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter id
    * @param int $value 
    * @return void
    */
    public function setId($value) {
        $this->id=$value;
    }
    /**
    * Setter username
    * @param string $value 
    * @return void
    */
    public function setUsername($value) {
        $this->username=$value;
    }
    /**
    * Setter password
    * @param string $value 
    * @return void
    */
    public function setPassword($value) {
        $this->password=$value;
    }
    /**
    * Setter salt
    * @param string $value 
    * @return void
    */
    public function setSalt($value) {
        $this->salt=$value;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Getter: id
    * @return int
    */
    public function getId() {
        return $this->id;
    }
    /**
    * Getter: username
    * @return string
    */
    public function getUsername() {
        return $this->username;
    }
    /**
    * Getter: password
    * @return string
    */
    public function getPassword() {
        return $this->password;
    }
    /**
    * Getter: salt
    * @return string
    */
    public function getSalt() {
        return $this->salt;
    }    
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}