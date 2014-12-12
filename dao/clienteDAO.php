<?php
/**
 * Objeto que controla el acceso a base de datos para la tabla cliente 
 * para creacion,modificacion, borrado de filas y acciones intermedias
 *
 * @author Curro Ruiz
 * @since December 2014
 */
class clienteDao {
   
    /**
     * Metodo para acceso a base de datos para seleccionar elementos de la tabla cliente
     * @param int $modo modo de acceso al metodo
     *  0=consulta para loging
     * @param type $usuario usuario del cliente a consultar
     * @param type $password contraseña del cliente a consultar
     * @return array array de instancias de la clase basicos/cliente.php
     */
    
    function selectCliente($modo,$usuario,$password){
        include 'dbdatos.php';//carga parametros de la base de datos
        $clientes = array();
        mysql_pconnect($dbhost, $dbuname, $dbpass);
        @mysql_select_db("$dbname") or die ("Imposible acceder a la BD en selectCliente");
        $query = "";
        if(is_nan($modo)){
            $modo=0;
        }
        switch ($modo){
            case 0:
                $query = " where usuario='".$usuario."' and password='".$password."'";
            break;
        }
        $sel=mysql_query("SELECT cif,nombre,password,usuario FROM cliente".$query) or die("Error en selectCliente");
        while( list( $cif, $nombre,$pass,$usuario) = mysql_fetch_row($sel) ){
            $clientes[] = new cliente($cif,$nombre);
        }
        mysql_close();
        return $clientes;
    }
    
    /**
    *Funcion que borra un cliente de la base de datos
    * @param <campo.php> $cliente instacia de la clase basicos/cliente.php
    */
    function deleteCliente($campo){
        //no implementado por no requerimiento del proyecto
    }
    /**
    * Funcion que introduce un nuevo cliente en la base de datos
    * @param <campo.php> $cliente instacia de la clase basicos/cliente.php
    */
    function crearCliente($cliente){
        //no implementado por no requerimiento del proyecto
    }
    /**
     *Funcion que modifica un cliente en la base de datos
     * @param <cliente.php> $cliente instacia de la clase basicos/cliente.php
     */
    function modificaCliente($cliente){
        //no implementado por no requerimiento del proyecto
    }
}
?>

