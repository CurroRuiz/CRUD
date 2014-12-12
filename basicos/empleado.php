<?php
/**
 * 
 * Implementa la clase empleado que representa la tabla correspondiente en la BD
 * 
 *
 * @author Curro Ruiz
 * @since december 2014
 */
class empleado {
    private $dni; //campo unico en la base de datos que identifica al empleado
    private $nombre;
    //datos de acceso al sistema password y usuario
    private $password; // seguridad MD-5
    private $usuario;
    private $jefe; // indica si es jefe de proyectos o no 0=no jefe 1=jefe de proyectos
  
    function __construct($dni,$nombre,$password,$usuario,$jefe) {
        $this->dni=$dni;
        $this->nombre=$nombre;
        $this->password=$password;
        $this->usuario=$usuario;
        $this->jefe=$jefe;
    }
    
    //------------geters y seters-----------------
    function setDni($entrada){
        $this->dni=$entrada;
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
    function setJefe($entrada){
        $this->jefe=$entrada;
    }
    function getDni(){
        return $this->dni;
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
    function getJefe(){
        return $this->jefe;
    }
    
}

