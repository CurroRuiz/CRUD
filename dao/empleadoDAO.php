<?php
/**
 * Objeto que controla el acceso a base de datos para la tabla empleado 
 * para creacion,modificacion, borrado de filas y acciones intermedias
 *
 * @author Curro Ruiz
 * @since December 2014
 */
class empleadoDao {
    /**
     * Metodo de seleccion de registros de la tabla de empleados
     * @param int $modo modo de acceso al metodo
     *  0=consulta para loging
     *  1=consulta todos los empleados no jefes
     * @param type $usuario usuario del empleado a consultar
     * @param type $password contraseña del empleado a consultar
     * @return array array de instancias de la clase basicos/empleado.php
     */
    
   function selectEmpleado($modo,$usuario,$password){
        include 'dbdatos.php';//carga parametros de la base de datos
        $empleados = array();
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en selectEmpleado");
        $query = "";
        if(is_nan($modo)){
            $modo=0;
        }
        switch ($modo){
            case 0:
                $query = " where usuario='".$usuario."' and password='".$password."'";
            break;
            case 1:
                $query = " where jefe=0";
            break;
        }
        $sel=mysql_query("SELECT dni,nombre,password,usuario,jefe FROM empleado".$query) or die("Error en selectEmpleado");
        while( list( $dni, $nombre,$pass,$usuario,$jefe) = mysql_fetch_row($sel) ){
            //nos e carga ni $pass ni $usuario porque no hay requerimientos posteriores de estas variables
            $empleados[] = new empleado($dni,$nombre,'','',$jefe);
        }
        mysql_close();
        return $empleados;
    }
    
     /**
     * Metodo de seleccion de empleados asignados a un proyectos
     * @param type $proyecto nproyecto a consultar
     * @return array de instancias de la clase basicos/material.php
     */
    function selectEmpleadoAsignado($proyecto){
        include 'dbdatos.php';//carga parametros de la base de datos
        $empleados = array();
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en selectEmpleadoAsignado");
        $sel=mysql_query("SELECT dni,nombre "
                . "FROM recursoasignado,empleado where dni=nrecurso AND recursoasignado.tipo=1 AND nproyecto='".$proyecto."'") or die("Error en selectEmpleadoAsignado");       
        while( list( $dni, $nombre) = mysql_fetch_row($sel) ){
            //nos e carga ni $pass ni $usuario porque no hay requerimientos posteriores de estas variables
            $empleados[] = new empleado($dni,$nombre,'','','');
        }
        mysql_close();
        return $empleados;
    }
    
    
    
 /**
 *Funcion que borra un cliente de la base de datos
 * @param <empleado.php> $empleado instacia de la clase basicos/empleado.php
 */
    function deleteEmpleado($empleado){
        //no implementado por no requerimiento del proyecto
    }
  /**
  * Funcion que introduce un nuevo cliente en la base de datos
  * @param <empleado.php> $empleado instacia de la clase basicos/empleado.php
  */
    function crearEmpleado($empleado){
        //no implementado por no requerimiento del proyecto
    }
    /**
     *Funcion que modifica un cliente en la base de datos
     * @param <empleado.php> $empleado instacia de la clase basicos/empleado.php
     */
    function modificaEmpleado($empleado){
        //no implementado por no requerimiento del proyecto
    }
    
       /**
     *Funcion que asigna un empleado a un proyecto
     * @param <empleado.php> $empleado instacia de la clase basicos/empleado.php
     * @param <proyecto.php> $proyecto instacia de la clase basicos/proyecto.php
     */
    function asignaEmpleado($empleado,$proyecto){
        include 'dbdatos.php';
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en asignaMaterial"); 
        $query = "INSERT INTO recursoasignado(nrecurso,nproyecto,tipo) VALUES
        ('".$empleado->getDni()."','".$proyecto->getNproyecto()."',1)";
        $sel=mysql_query($query);
         mysql_close();
    }
    
    /**
     *Funcion que quita signacion de un empleado a un proyecto
     * @param <empleado.php> $empleado instacia de la clase basicos/empleado.php
     * @param <proyecto.php> $proyecto instacia de la clase basicos/proyecto.php
     */
    function quitaEmpleado($empleado,$proyecto){
     include 'dbdatos.php';
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en quitaMaterial materialDAo");
        $query = "delete from recursoasignado where nrecurso='".$empleado->getDni()."' AND nproyecto='".$proyecto->getNproyecto()."'";
        $sel=mysql_query($query) or die("Error en quitaMaterial materialDAo");
        mysql_close();
    }
}
?>

