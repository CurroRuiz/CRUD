<?php
session_start();
/*
 * Controlador de la vista del panel central donde se muestra el listado de 
 * proyectos segun el logado sea un cliente, jefe o empleado.
 * El tipo de vista esta controlado por la variable de sesion "interface"
 * interface=0 cliente
 * interface=1 empleado
 * interface=2 jefe
 */
//librerias
include 'basicos/proyecto.php';
include 'dao/proyectoDAO.php';
// load Smarty library
require('libs/Smarty.class.php');
$smarty = new Smarty;
$smarty->template_dir = 'templates/';
$smarty->compile_dir = 'templates_c/';
$smarty->config_dir = 'configs/';
$smarty->cache_dir = 'cache/';

//variables y objetos
$proyectoDAO = new proyectoDao(); //objeto de acceso a tabla cliente
$arrayProyecto= array(); //array de ojetos proyecto
$arrayTablaSalida=array(); //array de cadenas para cosntruir la tabla

///si la sesion no esta iniciada o esta caducada volvemos al login
if($_SESSION["id"]=="" && $_SESSION["id"]==NULL){
    header('Location: index.php');
}

switch ($_SESSION["interface"]) {
    case 0://ventana principal del cliente
        $arrayProyecto=$proyectoDAO->selectProyecto(0, $_SESSION["id"], ''); //select en modo cliente
        $smarty->assign("cadenaSuper","Proyectos del cliente ".$_SESSION["nombre"],true);
    break;

   case 1://ventana principal del empleado
        $arrayProyecto=$proyectoDAO->selectProyecto(2, $_SESSION["id"], ''); //select en modo empleado
        $smarty->assign("cadenaSuper","Proyectos asignados al empleado ".$_SESSION["nombre"],true);
    break;

   case 2://ventana principal del jefe
        $arrayProyecto=$proyectoDAO->selectProyecto(1, $_SESSION["id"], ''); //select en modo jefe
        $smarty->assign("cadenaSuper","Proyectos asignados al jefe ".$_SESSION["nombre"],true);
    break;
}

$smarty->assign("interfaceTipo",$_SESSION["interface"],true);
$smarty->assign("datosTabla",$arrayProyecto,true);
$smarty->display('principal.tpl');
?>