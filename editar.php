<?php
session_start();
/*
 * Controlador de la vista de la ventana de edicion donde se edita un proyecto 
 * y se asignan nuevos recursos.
 * El tipo de vista esta controlado por la variable de sesion "interface"
 * interface=0 cliente
 * interface=1 empleado
 * interface=2 jefe
 * 
 * Si es cliente no dejamos acceder y volvemos a principal.php por seguridad
 * si es empleado o jefe permitimos las correspondientes acciones
 * 
 */
//librerias
include 'basicos/proyecto.php';
include 'dao/proyectoDAO.php';
include 'basicos/material.php';
include 'dao/materialDAO.php';
include 'basicos/empleado.php';
include 'dao/empleadoDAO.php';
// load Smarty library
require('libs/Smarty.class.php');
$smarty = new Smarty;
$smarty->template_dir = 'templates/';
$smarty->compile_dir = 'templates_c/';
$smarty->config_dir = 'configs/';
$smarty->cache_dir = 'cache/';

//variables y objetos
$proyectoDAO = new proyectoDao(); //objeto de acceso a tabla proyecto
$arrayProyecto= array(); //array de ojetos proyecto
$materialDAO = new materialDao(); //objeto de acceso a tabla material
$arrayMateriales= array(); //array de ojetos material
$arrayMaterialesAsig= array(); //array de ojetos 
$empleadoDAO = new empleadoDao(); //objeto de acceso a tabla empleado
$arrayEmpleado= array(); //array de ojetos empleado
$arrayEmpleadoAsig = array();//array de objetos empleado
//
///si la sesion no esta iniciada o esta caducada volvemos al login
if($_SESSION["id"]=="" && $_SESSION["id"]==NULL){
    header('Location: index.php');
}

//cargamos el proyecto a editar
$arrayProyecto=$proyectoDAO->selectProyecto(3, '', $_REQUEST['id']); //seleccionamos el proyecto requerido para editar
//el proyecto seleccionado siempre sera $arrayProyecto[0] porque es el primero y unico con ese ID

//Comprobamos parametros por si la carga es una manipulacion de materiales asignados
$material=$_REQUEST["asg"];  //cargamos por si es asignacion de material 
if($material!="" && $material!=NULL) { //si esta variable esta cargada es una asignaciond e recursos al proyecto
    $nuevoMaterial = new material($material,'','','');
    $materialDAO->asignaMaterial($nuevoMaterial, $arrayProyecto[0]);
}   
$material=$_REQUEST["dasg"]; //cargamos el partametro por si es quitar un material
if($material!="" && $material!=NULL) { //si esta variable esta cargada es qitar asignacion de recursos al proyecto
    $nuevoMaterial = new material($material,'','','');
    $materialDAO->quitaMaterial($nuevoMaterial, $arrayProyecto[0]);
}  
$material=$_REQUEST["asgEmpl"]; //cargamos el partametro por si es asignar empleado
if($material!="" && $material!=NULL) { //si esta variable esta cargada es asignar empleado al proyecto
    $nuevoEmpleado = new empleado($material,'','','','');
    $empleadoDAO->asignaEmpleado($nuevoEmpleado, $arrayProyecto[0]);
}
$material=$_REQUEST["dasgEmpl"]; //cargamos el partametro por si es quitar un empleado del proyecto
if($material!="" && $material!=NULL) { //si esta variable esta cargada es quitar un empleado al proyecto
    $nuevoEmpleado = new empleado($material,'','','','');
    $empleadoDAO->quitaEmpleado($nuevoEmpleado, $arrayProyecto[0]);
}
//en caso de cambio de estado del proyecto
$nuevoEstado=$_REQUEST["estado"];

if($nuevoEstado!="" && $nuevoEstado!=NULL) { //si esta variable esta cargada es modificar el estado de un proyecto
    $arrayProyecto[0]->setEstado($nuevoEstado);
    $proyectoDAO->modificaProyecto($arrayProyecto[0]);
}

switch ($_SESSION["interface"]) { //controlamos el tipo de interface
    case 0://caso de clienteventana principal del cliente
        header('Location: princpal.php');
    break;

   case 1://ventana principal del empleado      
        $smarty->assign("cadenaSuper","Proyectos asignados al empleado ".$_SESSION["nombre"],true);
    break;

   case 2://ventana principal del jefe
        $arrayMateriales=$materialDAO->selectMaterial(0, '', '');//materiales disponibles
        $arrayEmpleado=$empleadoDAO->selectEmpleado(1, '', '');//empleados disponibles
        $arrayMaterialesAsig= $materialDAO->selectMaterialAsignado($arrayProyecto[0]->getNproyecto());//material asignados al proyecto
        $arrayEmpleadoAsig= $empleadoDAO->selectEmpleadoAsignado($arrayProyecto[0]->getNproyecto());//material asignados al proyecto
        $smarty->assign("cadenaSuper","Proyectos asignados al jefe ".$_SESSION["nombre"],true);
    break;
}

$smarty->assign("interfaceTipo",$_SESSION["interface"],true);
//cargando el select de estado
$arrayCadenasEstado = array();
$arrayValoresEstado = array();
for ($i = 0; $i < 4; $i++) {//cargamos las distintas cadenas segun el objeto
    $nuevoProyecto = new proyecto('','','','','',$i);
    $arrayCadenasEstado[] = $nuevoProyecto->getEstado(); //la cadena
    $arrayValoresEstado[] = $i; //su valor
}
$smarty->assign("estadosCadena",$arrayCadenasEstado,true);
$smarty->assign("estadosValores",$arrayValoresEstado,true);

//arrays que solo van cargados en caso de jefe que es cuando se muestra
$smarty->assign("empleadosAsignados",$arrayEmpleadoAsig,true);
$smarty->assign("datosEmpleados",$arrayEmpleado,true);
$smarty->assign("materialesAsignados",$arrayMaterialesAsig,true);
$smarty->assign("datosMateriales",$arrayMateriales,true);
$smarty->assign("datosProyecto",$arrayProyecto[0],true);
$smarty->display('editar.tpl');
?>