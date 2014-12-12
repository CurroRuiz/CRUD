<?php
/**
 * Objeto que controla el acceso a base de datos para la tabla proyecto 
 * para creacion,modificacion, borrado de filas y acciones intermedias
 *
 * @author Curro Ruiz
 * @since December 2014
 */
class proyectoDao {
    /**
     * Metodo de seleccion de registros de la tabla de proyecto
     * @param int $modo modo de acceso al metodo
     *  0=consulta para clientes
     *  1=consulta para jefes
     *  2=consulta para empleados
     *  3=consulta de un proyecto 
     * @param type $usuario usuario del que se queiren consultar los proyectos
     * @param type $proyecto nproyecto a consultar
     * @return array de instancias de la clase basicos/proyecto.php
     */
    
   function selectProyecto($modo,$usuario,$proyecto){
        include 'dbdatos.php';//carga parametros de la base de datos
        $proyectos = array();
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en selectProyecto");
        $query = "";
        if(is_nan($modo)){
            $modo=0;
        }
        switch ($modo){
            case 0:
                $query = " AND cliente='".$usuario."'";
            break;
            case 1:
                $query = " AND jefeproyecto='".$usuario."'";
            break;
            case 2:
                $query = " AND nproyecto=ANY(Select nproyecto from recursoasignado where nrecurso='".$usuario."')";
            break;
            case 3:
                $query = " AND nproyecto='".$proyecto."'";
            break;
        
        }
        if($modo!=2){//distingomos con la consulta de empleados porque se basa en otra tabla de asignacion de recursos
            $sel=mysql_query("SELECT nproyecto,descripcion,proyecto.nombre,cliente.nombre as cliente,empleado.nombre,estado "
                . "FROM proyecto,cliente,empleado where cliente=cif AND jefeproyecto=dni".$query) or die("Error en selectProyecto");       
        }else{
            $sel=mysql_query("SELECT nproyecto,descripcion,proyecto.nombre,cliente.nombre as cliente,empleado.nombre,estado "
                . "FROM proyecto,cliente,empleado where cliente=cif AND jefeproyecto=dni".$query) or die("Error en selectProyecto");       
        }    
        while( list( $nproyecto, $descripcion,$nombre,$cliente,$jefe,$estado) = mysql_fetch_row($sel) ){
            //nos e carga ni $pass ni $usuario porque no hay requerimientos posteriores de estas variables
            $proyectos[] = new proyecto($nproyecto,$nombre,$descripcion,$cliente,$jefe,$estado);
        }
        mysql_close();
        return $proyectos;
    }
    
 /**
 *Funcion que borra un proyecto de la base de datos
 * @param <proyecto.php> $proyecto instacia de la clase basicos/proyecto.php
 */
    function deleteProyecto($proyecto){
        //no implementado por no requerimiento del proyecto
    }
  /**
  * Funcion que introduce un nuevo proyecto en la base de datos
  * @param <proyecto.php> $proyecto instacia de la clase basicos/proyecto.php
  */
    function crearProyecto($proyecto){
        //no implementado por no requerimiento del proyecto
    }
    /**
     *Funcion que modifica un proyecto en la base de datos
     * aqui usada solo para actualizar el estado
     * @param <proyecto.php> $proyecto instacia de la clase basicos/proyecto.php
     */
    function modificaProyecto($proyecto){
        include 'dbdatos.php';
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en modificaProyecto");
        $query= "update proyecto set
            estado='".$proyecto->getEstadoNumerico()."' where
            nproyecto='".$proyecto->getNproyecto()."'";
        $sel=mysql_query($query) or die("Error en modificaProyecto proyectoDao");
        mysql_close();
    }
}
?>



