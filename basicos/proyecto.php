<?php
/**
 * 
 * Implementa la clase proyecto que representa la tabla correspondiente en la BD
 * 
 *
 * @author Curro Ruiz
 * @since december 2014
 */
class proyecto {
    private $nproyecto; //campo unico en la base de datos que identifica al proyecto
    private $nombre; 
    private $descripcion; //campo descriptivo
    private $cliente; //cliente que encarga el proyecto
    private $jefeproyecto; //empleado jefe de proyecto asignado
    /*$estado
     *Campo que indica el estado de un proyecto. 4 estados posibles
     * 0=terminado
     * 1=en proceso
     * 2=aplazado
     * 3=cancelado
     */
    private $estado;

  
    function __construct($nproyecto,$nombre,$descripcion,$cliente,$jefeproyecto,$estado) {
        $this->nproyecto=$nproyecto;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->cliente=$cliente;
        $this->jefeproyecto=$jefeproyecto;
        $this->estado=$estado;
    }
    
    //------------geters y seters-----------------
    function setNproyecto($entrada){
        $this->nproyecto=$entrada;
    }
    function setNombre($entrada){
        $this->nombre=$entrada;
    }
    function setDescripcion($entrada){
        $this->descripcion=$entrada;
    }
    function setCliente($entrada){
        $this->cliente=$entrada;
    }
    function setJefeProyecto($entrada){
        $this->jefeproyecto=$entrada;
    }
    function setEstado($entrada){
        $this->estado=$entrada;
    }
            
    function getNproyecto(){
        return $this->nproyecto;
    }

    function getNombre(){
        return $this->nombre;
    }
    function getDescripcion(){
        return $this->descripcion;
    }
    function getCliente(){
        return $this->cliente;
    }
    
    function getJefeProyecto(){
        return $this->jefeproyecto;
    }
    function getEstado(){
        $cadenaretorno="";
        switch ($this->estado){
            case 0:
                $cadenaretorno= "Terminado";
            break;
            case 1:
                $cadenaretorno = "En proceso";
            break; 
            case 2:
                $cadenaretorno = "Aplazado";
            break; 
            case 3:
                $cadenaretorno = "Cancelado";
            break; 
        }
        return $cadenaretorno;
    }
    
    function getEstadoNumerico(){
        return $this->estado;
    }
}
?>

