<?php
///////////////////////////////////////////////////////////////////////
//Componente controller que verifica la opcion seleccionada
//por el usuario, ejecuta el modelo y enruta la navegacion de paginas.
///////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////
//////////////////////////////Clientes/////////////////////////////////
///////////////////////////////////////////////////////////////////////
require_once '../model/YantexModel.php';
require_once '../model/factModel.php';
session_start();
$yantexsModel = new YantexModel();
$factModel=new factModel();
//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];

switch($opcion){
     case "nueva_factura":
        unset($_SESSION['listadopedido']);
        header('Location: ../view/index.php');
        break;
    
        case "guardarpedido":
        //obtenemos los parametros del formulario:
        $ci=$_REQUEST['ci'];
        $fechaEntrega=['fechaentrega'];
        if(isset($_SESSION['listadopedido'])){
            $listadopedido=unserialize($_SESSION['listadopedido']);
            try {
                $pedido=$factModel->guardarPedido($listadopedido, $ci, $fechaEntrega);
                $_SESSION['pedido']=$pedido;
                header('Location: ../view/index.php');
                break;
            } catch (Exception $e) {
                $mensajeError=$e->getMessage();
                $_SESSION['mensajeError']=$mensajeError;
            }
        }
        //actualizamos lista de facturas:
        //$listado = $gastosModel->getFacturas();
        //$_SESSION['listado'] = serialize($listado);
        header('Location: ../view/factura.php');
        break;
        
         case "listar":
        //obtenemos la lista de facturas:
        $listado = $gastosModel->getFacturas();
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../view/index.php');
        break;
        
        
        
    case "listarpedido":
        //obtenemos la lista de facturas y subimos a sesion:
        $_SESSION['listado']=serialize($factModel->getPedidos());
        header('Location: ../view/reporte.php');
        break;
    
    
      case "adicionar_detalle":
          $aux=0;
          $aux++;
        //obtenemos los parametros del formulario:
          
        $idModelo=$_REQUEST['idmodelo'];
        $idColor=$_REQUEST['idcolor'];
        $idTalla=$_REQUEST['idtalla'];
        $cantidad=$_REQUEST['cantidad'];
        if(!isset($_SESSION['listadopedido'])){
            $listadopedidot=array();
        }else{
            $listadopedido=unserialize($_SESSION['listadopedido']);
        }
        try{
            $listadopedido=$factModel->adicionarDetalle($listadopedido, $idModelo, $idColor, $idTalla, $cantidad);
            $_SESSION['listadopedido']=serialize($listadopedido);
        }catch(Exception $e){
            $mensajeError=$e->getMessage();
            $_SESSION['mensajeError']=$mensajeError;
        }
        header('Location: ../view/index.php');
        break;
        
        
        case "eliminar_detalle":
        //obtenemos los parametros del formulario:
        $idModelo=$_REQUEST['idmodelo'];
        $listadopedido=unserialize($_SESSION['listadopedido']);
        $listadopedido=$factModel->eliminarDetalle($listadopedido, $idModelo);
        $_SESSION['listadopedido']=serialize($listadopedido);
        header('Location: ../view/index.php');
        break;
        
       case "limpiar":
        //obtenemos los parametros del formulario:
        $listadopedido=null;
        $listadopedido=unserialize($_SESSION['listadopedido']);
       
        $_SESSION['listadopedido']=serialize($listadopedido);
        header('Location: ../view/index.php');
        break;
    
    
    case "listarcliente":
        //obtenemos la lista de facturas:
        $listadocliente = $yantexsModel->getClientes();
        //y los guardamos en sesion:
        $_SESSION['listadocliente'] = serialize($listadocliente);
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../view/cliente.php');
        break;
    
      
    case "insertarcliente":
        //obtenemos los parametros del formulario:
        $ci=$_REQUEST['ci'];
        $nombres=$_REQUEST['nombres'];
        $apellidos=$_REQUEST['apellidos'];
        $telefono=$_REQUEST['telefono'];
        $celular=$_REQUEST['celular'];
        $direccion=$_REQUEST['direccion'];
        $yantexsModel->insertarCliente($ci, $nombres, $apellidos, $telefono, $celular, $direccion);
        //actualizamos lista de facturas:
        $listadocliente = $yantexsModel->getClientes();
        $_SESSION['listadocliente'] = serialize($listadocliente);
        $_SESSION['error'] = serialize($error);
        header('Location: ../view/cliente.php');
        break;
    
    
    case"eliminarcliente" :
        //obtenemos el codigo del priducto a elimiar
        $ci=$_REQUEST['ci'];
        //eliminamos el prducto
        $yantexsModel->eliminarCliente($ci);
        //actualizamos la lista de productos para  grabar en session
        $listadocliente = $yantexsModel->getClientes();
        $_SESSION['listadocliente'] = serialize($listadocliente);
        header('Location: ../view/cliente.php');
        break;

    
    case "editarcliente":
        //obtenemos los parametros del formulario:
        $ci=$_REQUEST['ci'];
        //Buscamos los datos
        $cliente=$yantexsModel->getCliente($ci);
        //guardamos en sesion para edicion posterior:
        $_SESSION['cliente'] = serialize($cliente);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/editarCliente.php');
        break;
  
      case "clientes":
        //obtenemos los parametros del formulario:
        $ci=$_REQUEST['ci'];
        //Buscamos los datos
        $cliente=$yantexsModel->getCliente($ci);
        //guardamos en sesion para edicion posterior:
        $_SESSION['cliente'] = serialize($cliente);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/index.php');
        break;
  
     case "actualizarcli":
        //obtenemos los parametros del formulario:
        $ci=$_REQUEST['ci'];
        $nombres=$_REQUEST['nombres'];
        $apellidos=$_REQUEST['apellidos'];
        $telefono=$_REQUEST['telefono'];
        $celular=$_REQUEST['celular'];
        $direccion=$_REQUEST['direccion'];
        $yantexsModel->actualizarCliente($ci, $nombres, $apellidos, $telefono, $celular, $direccion);
        //actualizamos lista de facturas:
        $listadocliente = $yantexsModel->getClientes();
        $_SESSION['listadocliente'] = serialize($listadocliente);
        header('Location: ../view/cliente.php');
        break;

    
    ///////////////////////////////////////////////////////////////////////
    //////////////////////////////Modelo/////////////////////////////////
    ///////////////////////////////////////////////////////////////////////
    
    case "listarmodelo":
        //obtenemos la lista de facturas:
        $listadomodelo = $yantexsModel->getModelos();
        //y los guardamos en sesion:
        $_SESSION['listadomodelo'] = serialize($listadomodelo);
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../view/modeloss.php');
        break;
    
      
    case "insertarmodelo":
        $uploaddir = 'D:/xamp/htdocs/YantexProyecto/view/modelos/';
        $uploadfile = $uploaddir . basename($_FILES['imagen']['name']);
        
        print '<pre>';
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadfile)) {
            echo "El archivo es válido y fue cargado exitosamente.\n";
        } else {
            echo "¡Posible ataque de carga de archivos!\n";
        }

        print_r($_FILES);

        //obtenemos los parametros del formulario:
        $modelo=$_REQUEST['modelo'];
        $precio=$_REQUEST['precio'];
        $descripcion=$_REQUEST['descripcion'];
        $imagen=basename($_FILES['imagen']['name']);
        
        $yantexsModel->insertarModelo($modelo, $precio, $descripcion, $imagen);
        //actualizamos lista de facturas:
        $listadomodelo = $yantexsModel->getModelos();
        $_SESSION['listadomodelo'] = serialize($listadomodelo);
        $_SESSION['error'] = serialize($error);
        header('Location: ../view/modeloss.php');
        break;
    
    
    case"eliminarmodelo" :
        //obtenemos el codigo del priducto a elimiar
        $modelo=$_REQUEST['modelo'];
        //eliminamos el prducto
        $yantexsModel->eliminarModelo($modelo);
        //actualizamos la lista de productos para  grabar en session
        $listadomodelo = $yantexsModel->getModelos();
        $_SESSION['listadomodelo'] = serialize($listadomodelo);
        header('Location: ../view/modeloss.php');
        break;

    
    case "editarmodelo":
        //obtenemos los parametros del formulario:
        $modelo=$_REQUEST['modelo'];
        //Buscamos los datos
        $mod=$yantexsModel->getModelo($modelo);
        //guardamos en sesion para edicion posterior:
        $_SESSION['mod'] = serialize($mod);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/editarModelo.php');
        break;
    
      
  
     case "actualizarmodelo":
        //obtenemos los parametros del formulario:
        $uploaddir = 'D:/xamp/htdocs/YantexProyecto/view/modelos/';
        $uploadfile = $uploaddir . basename($_FILES['imagen']['name']);
        
        print '<pre>';
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadfile)) {
            echo "El archivo es válido y fue cargado exitosamente.\n";
        } else {
            echo "¡Posible ataque de carga de archivos!\n";
        }

        print_r($_FILES);

        //obtenemos los parametros del formulario:
        $modelo=$_REQUEST['modelo'];
        $precio=$_REQUEST['precio'];
        $descripcion=$_REQUEST['descripcion'];
        $imagen=basename($_FILES['imagen']['name']);
        
        $yantexsModel->actualizarModelo($modelo, $precio, $descripcion, $imagen); //actualizamos lista de facturas:
        $listadomodelo = $yantexsModel->getModelos();
        $_SESSION['listadomodelo'] = serialize($listadomodelo);
        header('Location: ../view/modeloss.php');
        break;
 //////////////////////////////Modelo/////////////////////////////////
    ///////////////////////////////////////////////////////////////////////
    
    case "listarcolor":
        //obtenemos la lista de facturas:
        $listadocolor = $yantexsModel->getColores();
        //y los guardamos en sesion:
        $_SESSION['listadocolor'] = serialize($listadocolor);
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../view/colores.php');
        break;
    
      
    case "insertarcolor":
        
        $uploaddir = 'D:/xamp/htdocs/YantexProyecto/view/colores/';
        $uploadcolor = $uploaddir . basename($_FILES['imagen']['name']);
        
        print '<pre>';
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadcolor)) {
            echo "El archivo es válido y fue cargado exitosamente.\n";
        } else {
            echo "¡Posible ataque de carga de archivos!\n";
        }

        print_r($_FILES);
        
        //obtenemos los parametros del formulario:
        $color=$_REQUEST['color'];
        $nombre=$_REQUEST['nombre'];
        $imagen=basename($_FILES['imagen']['name']);
        
        $yantexsModel->insertarColor($color, $nombre, $imagen);
        //actualizamos lista de facturas:
        $listadocolor = $yantexsModel->getColores();
        $_SESSION['listadocolor'] = serialize($listadocolor);
        $_SESSION['error'] = serialize($error);
        header('Location: ../view/colores.php');
        break;
    
    
    case"eliminarcolor" :
        //obtenemos el codigo del priducto a elimiar
        $color=$_REQUEST['color'];
        //eliminamos el prducto
        $yantexsModel->eliminarColor($color);
        //actualizamos la lista de productos para  grabar en session
        $listadocolor = $yantexsModel->getColores();
        $_SESSION['listadocolor'] = serialize($listadocolor);
        header('Location: ../view/colores.php');
        break;

    
    case "editarcolor":
        //obtenemos los parametros del formulario:
        $color=$_REQUEST['color'];
        //Buscamos los datos
        $colores=$yantexsModel->getColor($color);
        //guardamos en sesion para edicion posterior:
        $_SESSION['colores'] = serialize($colores);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/editarColor.php');
        break;
    
      
  
     case "actualizarcolor":
        //obtenemos los parametros del formulario:
         $color=$_REQUEST['color'];
        $nombre=$_REQUEST['nombre'];
        $imagen=$_REQUEST['imagen'];
        
        $yantexsModel->actualizarColor($color, $nombre, $imagen);
        $listadocolor = $yantexsModel->getColores();
        $_SESSION['listadocolor'] = serialize($listadocolor);
        header('Location: ../view/colores.php');
        break;

    
    
    
    
    ///////////////////////////////////////////////////////////////////////
    //////////////////////////////Talla/////////////////////////////////
    ///////////////////////////////////////////////////////////////////////
    
    case "listartalla":
        //obtenemos la lista de facturas:
        $listadotalla = $yantexsModel->getTallas();
        //y los guardamos en sesion:
        $_SESSION['listadotalla'] = serialize($listadotalla);
        //redireccionamos a la pagina index para visualizar:
        header('Location: ../view/tallass.php');
        break;
    
      
    case "insertartalla":
        //obtenemos los parametros del formulario:
        $talla=$_REQUEST['talla'];
        $valorTalla=$_REQUEST['valortalla'];
        $descripcion=$_REQUEST['descripcion'];
        
        $yantexsModel->insertarTalla($talla, $valorTalla, $descripcion);
        //actualizamos lista de facturas:
        $listadotalla = $yantexsModel->getTallas();
        $_SESSION['listadotalla'] = serialize($listadotalla);
        $_SESSION['error'] = serialize($error);
        header('Location: ../view/tallass.php');
        break;
    
    
    case"eliminartalla" :
        //obtenemos el codigo del priducto a elimiar
        $talla=$_REQUEST['talla'];
        //eliminamos el prducto
        $yantexsModel->eliminarTalla($talla);
        //actualizamos la lista de productos para  grabar en session
        $listadotalla = $yantexsModel->getTallas();
        $_SESSION['listadotalla'] = serialize($listadotalla);
        header('Location: ../view/tallass.php');
        break;

    
    case "editartalla":
        //obtenemos los parametros del formulario:
        $talla=$_REQUEST['talla'];
        //Buscamos los datos
        $tallasres=$yantexsModel->getTalla($talla);
        //guardamos en sesion para edicion posterior:
        $_SESSION['tallasres'] = serialize($tallasres);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/editartalla.php');
        break;
    
      
  
     case "actualizartalla":
        //obtenemos los parametros del formulario:
         $talla=$_REQUEST['talla'];
        $valorTalla=$_REQUEST['valortalla'];
        $descripcion=$_REQUEST['descripcion'];
        
        $yantexsModel->actualizartalla($talla, $valorTalla, $descripcion);
        $listadotalla = $yantexsModel->getTallas();
        $_SESSION['listadotalla'] = serialize($listadotalla);
        header('Location: ../view/tallass.php');
        break;

        default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina index:
        header('Location: ../view/index.php');
}
