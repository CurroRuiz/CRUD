<?php
/**
 * Objeto que controla el acceso a base de datos para la tabla material 
 * para creacion,modificacion, borrado de filas y acciones intermedias
 *
 * @author Curro Ruiz
 * @since December 2014
 */
class materialDao {
    /**
     * Metodo de seleccion de registros de la tabla de material
     * @param int $modo modo de acceso al metodo
     *  0=consulta todos materiales
     *  1=consulta materiales de un proyecto
     * @param type $material material del que se queiren consultar individualmente
     * @param type $proyecto nproyecto a consultar
     * @return array de instancias de la clase basicos/material.php
     */
    
   function selectMaterial($modo,$material,$proyecto){
        include 'dbdatos.php';//carga parametros de la base de datos
        $materiales = array();
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en selectMaterial");
        $query = "";
        if(is_nan($modo)){
            $modo=0;
        }
        switch ($modo){
            case 0:
                $query = "";
            break;
            case 1:
                $query = " AND jefeproyecto='".$usuario."'";
            break;
        }
        $sel=mysql_query("SELECT nserie,tipo,nombre,marca "
                . "FROM material".$query) or die("Error en selectMaterial");       
        while( list( $nserie, $tipo,$nombre,$marca) = mysql_fetch_row($sel) ){
            //nos e carga ni $pass ni $usuario porque no hay requerimientos posteriores de estas variables
            $materiales[] = new material($nserie,$tipo,$marca,$nombre);
        }
        mysql_close();
        return $materiales;
    }
    
    /**
     * Metodo de seleccion de materiales asignados a un proyectos
     * @param type $proyecto nproyecto a consultar
     * @return array de instancias de la clase basicos/material.php
     */
    function selectMaterialAsignado($proyecto){
        include 'dbdatos.php';//carga parametros de la base de datos
        $materiales = array();
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en selectMaterialAsignado");
        $sel=mysql_query("SELECT nserie,material.tipo,nombre,marca "
                . "FROM recursoasignado,material where nserie=nrecurso AND recursoasignado.tipo=0 AND nproyecto='".$proyecto."'") or die("Error en selectMaterialAsignado");       
        while( list( $nserie, $tipo,$nombre,$marca) = mysql_fetch_row($sel) ){
            //nos e carga ni $pass ni $usuario porque no hay requerimientos posteriores de estas variables
            $materiales[] = new material($nserie,$tipo,$marca,$nombre);
        }
        mysql_close();
        return $materiales;
    }
    
 /**
 *Funcion que borra un proyecto de la base de datos
 * @param <material.php> $proyecto instacia de la clase basicos/material.php
 */
    function deleteMaterial($material){
        //no implementado por no requerimiento del proyecto
    }
  /**
  * Funcion que introduce un nuevo material en la base de datos
  * @param <material.php> $proyecto instacia de la clase basicos/material.php
  */
    function crearMaterial($material){
        //no implementado por no requerimiento del proyecto
    }
    /**
     *Funcion que asigna un material a un proyecto
     * @param <material.php> $material instacia de la clase basicos/material.php
     * @param <proyecto.php> $proyecto instacia de la clase basicos/proyecto.php
     */
    function asignaMaterial($material,$proyecto){
        include 'dbdatos.php';
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en asignaMaterial"); 
        $query = "INSERT INTO recursoasignado(nrecurso,nproyecto,tipo) VALUES
        ('".$material->getNserie()."','".$proyecto->getNproyecto()."',0)";
        $sel=mysql_query($query);
         mysql_close();
    }
    
    /**
     *Funcion que quita signacion de un material a un proyecto
     * @param <material.php> $material instacia de la clase basicos/material.php
     * @param <proyecto.php> $proyecto instacia de la clase basicos/proyecto.php
     */
    function quitaMaterial($material,$proyecto){
     include 'dbdatos.php';
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en quitaMaterial materialDAo");
        $query = "delete from recursoasignado where nrecurso='".$material->getNserie()."' AND nproyecto='".$proyecto->getNproyecto()."'";
        $sel=mysql_query($query) or die("Error en quitaMaterial materialDAo");
        mysql_close();
    }
}
?>



