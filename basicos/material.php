<?php
/**
 * 
 * Implementa la clase material que representa la tabla correspondiente en la BD
 * 
 *
 * @author Curro Ruiz
 * @since december 2014
 */
class material {
    private $nserie; //campo unico en la base de datos que identifica al material
    /*$tipo
     * campo que indica el tipo de material restringido a 
     *0=ordenador
     *1=impresora
     * 
     * Se escoje un valor numerico en lugar de una cadena porque ocupa menos tamaño en 
     * BD, su indexación es mas rapida y es mucho mas flexible que usar cadenas del tipo
     * "impresora"  u "ordenador" directamente en la base de datos.
    */
    private $tipo; 
    private $marca; //campo descriptivo 
    private $nombre; //campo descriptivo 
  
    function __construct($nserie,$tipo,$marca,$nombre) {
        $this->nserie=$nserie;
        $this->tipo=$tipo;
        $this->marca=$marca;
        $this->nombre=$nombre;
    }
    
    //------------geters y seters-----------------
    function setNserie($entrada){
        $this->nserie=$entrada;
    }
    function setTipo($entrada){
        $this->tipo=$entrada;
    }
    function setMarca($entrada){
        $this->marca=$entrada;
    }
    function setNombre($entrada){
        $this->nombre=$entrada;
    }
    
    function getNserie(){
        return $this->nserie;
    }
    function getTipo(){
        $cadenaretorno="";
        switch ($this->tipo){
            case 0:
                $cadenaretorno= "Ordenador";
            break;
            case 1:
                $cadenaretorno = "Impresora";
            break; 
        }
        return $cadenaretorno;
    }
    function getMarca(){
        return $this->marca;
    }
    function getNombre(){
        return $this->nombre;
    }
    
}
?>


