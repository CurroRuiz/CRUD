<?php
session_start();
/*
 * Controlador de la vista del login
 * corrobora en base de datos si el usuario introducido
 * y su contraseña es correcta y en caso que asi sea pasa 
 * al menu de proyectos proyectos.php.
 */
//librerias
include 'basicos/cliente.php';
include 'dao/clienteDAO.php';
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
$usuario=$_REQUEST['usuario']; 
$password=md5($_REQUEST['pswrd']); //trasformacion a MD5 de la cadena pasada como pswrd
$clienteDAO = new clienteDao(); //objeto de acceso a tabla cliente
$arrayClientes= array();
$empleadoDAO=new empleadoDao();//objeto de acceso a tabla empleado
$arrayEmpleado= array();
if($usuario!=""){ //si usuario esta vacio no comprobamos en base de datos
      //consultamos el usuario introducido en la base de clientes
      $arrayClientes = $clienteDAO->selectCliente(0, $usuario, $password); 
      //consultamos el usuario introducido en la base de empleados
      $arrayEmpleado = $empleadoDAO->selectEmpleado(0, $usuario, $password);
      //si ambos arrays estan vacios quiere decir que no hubo coincidencias
      if(sizeof($arrayClientes)==0 && sizeof($arrayEmpleado)==0){
          $smarty->assign("CadenaError",'Usuario incorrecto',true);
      }else{//hubo coincidencias seleccionamos interfacce principal
          if(sizeof($arrayClientes)>0){//interface de cliente
              $_SESSION["id"] = $arrayClientes[0]->getCif();//propagamos por sesion el usuario logado
              $_SESSION["nombre"] = $arrayClientes[0]->getNombre(); //propagamos por session algunos datos
              $_SESSION["interface"]=0; //variable de session indica el usuario logado es un cliente
              header('Location:principal.php');
              
          }
          if(sizeof($arrayEmpleado)>0 && $arrayEmpleado[0]->getJefe()==0){//interface de empleado
              $_SESSION["id"] = $arrayEmpleado[0]->getDni();//propagamos por sesion el usuario logado
              $_SESSION["nombre"] = $arrayEmpleado[0]->getNombre(); //propagamos por session algunos datos
              $_SESSION["interface"]=1; //variable de session indica el usuario logado es un empleado
              header('Location: principal.php');
              
          }
          if(sizeof($arrayEmpleado)>0 && $arrayEmpleado[0]->getJefe()==1){//interface de jefe
              $_SESSION["id"] = $arrayEmpleado[0]->getDni();//propagamos por sesion el usuario logado
              $_SESSION["nombre"] = $arrayEmpleado[0]->getNombre(); //propagamos por session algunos datos
              $_SESSION["interface"]=2; //variable de session indica el usuario logado es un jefe
              header('Location: principal.php');
          }
      }
}
//carga de la plantilla de Smarty
$smarty->display('login.tpl');
?>
