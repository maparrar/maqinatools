<?php
/** Test File
 * @models models @social social */
/**
 * Test Class
 *
 * @author https://github.com/maparrar/maqinato
 * @author Alejandro Parra <maparrar@gmail.com>
 * @package models
 * @subpackage social
 */
class Test extends Object{
    /** 
     * Suggestion id 
     * 
     * @var int
     */
    protected $id;
    /** 
     * Suggestion content 
     * 
     * @var string
     */
    protected $content;
    /** 
     * Página en la que debe aparecer [home|profile|folio|...] 
     * 
     * @var string
     */
    protected $page;
    /** 
     * Elemento de la página al que estará referenciado [.divClase|#divConId|...] 
     * 
     * @var string
     */
    protected $element;
    /** 
     * Posición respecto al elemento [north|south|east|west] 
     * 
     * @var string
     */
    protected $position;
    /** 
     * Posición de la flecha en el lado especificado, si es north, la $arrowPosition=0
        *    indica que está a cero pixeles de la parte izquierda de abajo, si $arrowPosition=100
        *    indica que está a 100 pixeles de la parte izquierda de abajo 
     * 
     * @var int
     */
    protected $arrowPosition;
    /** 
     * Alto de la sugerencia en pixeles, si es 0 se calculará automáticamente 
     * 
     * @var int
     */
    protected $height;
    /** 
     * Ancho de la sugerencia en pixeles, si es 0 se calculará automáticamente 
     * 
     * @var int
     */
    protected $width;
    /** 
     * Si tiene alguna imagen, almacena la ruta respecto a la carpteta data 
     * 
     * @var string
     */
    protected $image;
    /**
    * Constructor
    * @param int Suggestion id        
    * @param string Suggestion content        
    * @param string Página en la que debe aparecer [home|profile|folio|...]        
    * @param string Elemento de la página al que estará referenciado [.divClase|#divConId|...]        
    * @param string Posición respecto al elemento [north|south|east|west]        
    * @param int Posición de la flecha en el lado especificado, si es north, la $arrowPosition=0
        *    indica que está a cero pixeles de la parte izquierda de abajo, si $arrowPosition=100
        *    indica que está a 100 pixeles de la parte izquierda de abajo        
    * @param int Alto de la sugerencia en pixeles, si es 0 se calculará automáticamente        
    * @param int Ancho de la sugerencia en pixeles, si es 0 se calculará automáticamente        
    * @param string Si tiene alguna imagen, almacena la ruta respecto a la carpteta data        
    */
    function Test($id=0,$content="",$page="",$element="",$position="",$arrowPosition=0,$height=0,$width=0,$image=""){        
        $this->id=$id;
        $this->content=$content;
        $this->page=$page;
        $this->element=$element;
        $this->position=$position;
        $this->arrowPosition=$arrowPosition;
        $this->height=$height;
        $this->width=$width;
        $this->image=$image;
    }
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   SETTERS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    /**
    * Setter id
    * @param int $value Suggestion id
    * @return void
    */
    public function setId($value) {
        $this->id=$value;
    }        
    /**
    * Setter content
    * @param string $value Suggestion content
    * @return void
    */
    public function setContent($value) {
        $this->content=$value;
    }        
    /**
    * Setter page
    * @param string $value Página en la que debe aparecer [home|profile|folio|...]
    * @return void
    */
    public function setPage($value) {
        $this->page=$value;
    }        
    /**
    * Setter element
    * @param string $value Elemento de la página al que estará referenciado [.divClase|#divConId|...]
    * @return void
    */
    public function setElement($value) {
        $this->element=$value;
    }        
    /**
    * Setter position
    * @param string $value Posición respecto al elemento [north|south|east|west]
    * @return void
    */
    public function setPosition($value) {
        $this->position=$value;
    }        
    /**
    * Setter arrowPosition
    * @param int $value Posición de la flecha en el lado especificado, si es north, la $arrowPosition=0
        *    indica que está a cero pixeles de la parte izquierda de abajo, si $arrowPosition=100
        *    indica que está a 100 pixeles de la parte izquierda de abajo
    * @return void
    */
    public function setArrowPosition($value) {
        $this->arrowPosition=$value;
    }        
    /**
    * Setter height
    * @param int $value Alto de la sugerencia en pixeles, si es 0 se calculará automáticamente
    * @return void
    */
    public function setHeight($value) {
        $this->height=$value;
    }        
    /**
    * Setter width
    * @param int $value Ancho de la sugerencia en pixeles, si es 0 se calculará automáticamente
    * @return void
    */
    public function setWidth($value) {
        $this->width=$value;
    }        
    /**
    * Setter image
    * @param string $value Si tiene alguna imagen, almacena la ruta respecto a la carpteta data
    * @return void
    */
    public function setImage($value) {
        $this->image=$value;
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
    * Getter: content
    * @return string
    */
    public function getContent() {
        return $this->content;
    }        
    /**
    * Getter: page
    * @return string
    */
    public function getPage() {
        return $this->page;
    }        
    /**
    * Getter: element
    * @return string
    */
    public function getElement() {
        return $this->element;
    }        
    /**
    * Getter: position
    * @return string
    */
    public function getPosition() {
        return $this->position;
    }        
    /**
    * Getter: arrowPosition
    * @return int
    */
    public function getArrowPosition() {
        return $this->arrowPosition;
    }        
    /**
    * Getter: height
    * @return int
    */
    public function getHeight() {
        return $this->height;
    }        
    /**
    * Getter: width
    * @return int
    */
    public function getWidth() {
        return $this->width;
    }        
    /**
    * Getter: image
    * @return string
    */
    public function getImage() {
        return $this->image;
    }            
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>   METHODS   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}
?>