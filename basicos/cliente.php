<?php
/**
 * 
 * Implementa la clase cliente que representa la tabla correspondiente en la BD
 * 
 *
 * @author Curro Ruiz
 * @since december 2014
 */
class cliente {
    private $cif; //campo unico en la base de datos que identifica al cliente
    private $nombre;
    private $password; //seguridad MD-5
    private $usuario;
  
    function __construct($cif,$nombre,$password,$usuario) {
        $this->cif=$cif;
        $this->nombre=$nombre;
        $this->password=$password;
        $this->usuario=$usuario;
    }
    
    //------------geters y seters-----------------
    function setCif($entrada){
        $this->cif=$entrada;
    }
    function setNombre($entrada){
        $this->nombre=$entrada;
    }
    function setUsuario($entrada){
        $this->usuario=$entrada;
    }
    function setPassword($entrada){
        $this->password=$entrada;
    }
    
    function getCif(){
        return $this->cif;
    }
    function getNombre(){
        return $this->nombre;
    }
    function getUsuario(){
        return $this->usuario;
    }
    function getPassword(){
        return $this->password;
    }
    
    
}
?>