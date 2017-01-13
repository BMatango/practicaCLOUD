<?php

include 'Detalle.php';
include 'Pedido.php';
include_once '../model/YantexModel.php';
class factModel {
    
    
     public function getPedidos(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from pedido order by  codigo_pedido";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Factura:
        $listado = array();
        foreach ($resultado as $res){
            $factura = new Pedido($res['codigo_pedido'],$res['ci'],$res['clientes'],$res['fecha_pedido'],$res['fecha_entrega'], $res['subtotal'],$res['iva'], $res['total']);
            array_push($listado, $factura);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    
    
    
    
    
    
    public function adicionarDetalle($listadopedido, $idModelo, $idColor, $idTalla, $cantidad){
        $cont=0;
        if($cantidad<=0){
            throw new Exception ("La cantidad debe ser mayor a cero.");
        }
        //buscamos el producto:
        $yantexModel=new YantexModel();
         $detalle=new Detalle();
         $cont++;
        $color=$yantexModel->getColor($idColor);
        $modelo=$yantexModel->getModelo($idModelo);
        $talla=$yantexModel->getTalla($idTalla);
        //creamos un nuevo detalle FacturaDet:
        $detalle->setCodigoPedido($this->ultimoNumeroPedido());
        $detalle->setCodigoDetalle($this->ultimoNumeroDetalle());
        $detalle->setModelo($modelo->getModelo());
        $detalle->setColor($color->getColor()."---".$color->getNombre());
        $detalle->setTalla($talla->getTalla());
        $detalle->setCantidad($cantidad);
        $detalle->setPrecio((($modelo->getPrecio())+($talla->getValorTalla()))*($detalle->getCantidad()));
        
        
        //adicionamos el nuevo detalle al array en memoria:
        if(!isset($listadopedido)){
            $listadopedido=array();
        }
        array_push($listadopedido,$detalle);
        return $listadopedido;
    }
      public function guardarPedido($listadopedido,$ci,$fechaEntrega){
        if(!isset($listadopedido)){
            throw new Exception("Debe por lo menos registrar un producto.");
        }
        if(count($listadopedido)==0){
            throw new Exception("Debe por lo menos registrar un producto.");
        }
        if(!isset($ci)){
            throw new Exception("Debe seleccionar el cliente.");
        }
        //obtenemos los datos completos del cliente:
        $yantexModel=new YantexModel();
        $cliente=$yantexModel->getCliente($ci);
        //creamos la nueva factura:
        $pedido=new Pedido();
        
        $pedido->setCodigoPedido($this->ultimoNumeroPedido()+1);
        $pedido->setCi($ci);
        $pedido->setCliente($cliente->getApellidos()."  ".$cliente->getNombres());
        $mañana   = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
        $pedido->setFechaPedido($mañana);
        $pedido->setFechaEntrega($fechaEntrega);
        $pedido->setSubtotal($this->calcularSubtotal($listadopedido));
        $pedido->setIva($this->calcularIva($listadopedido));
        $pedido->setTotal($this->calcularTotal($listadopedido));
         //obtenemos el siguiente numero de factura:
       
        //guardar la cabecera:
        $pdo = Database::connect();
        $sql = "insert into pedido(codigo_pedido, ci,cliente, fecha_pedido, fecha_entrega,subtotal,iva,total) values(?,?,?,?,?,?,?,?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($pedido->getCodigoPedido(),
                $pedido->getCi(),
                $pedido->getCliente(),
                $pedido->getFechaPedido(),
                $pedido->getFechaEntrega(),
              
                $pedido->getSubtotal(),
                  $pedido->getIva(),
                $pedido->getTotal()));
                
            //guardamos los detalles:
         //guardamos los detalles:
            foreach ($listadopedido as $det){
                $sql = "insert into detalle(codigo_pedido,codigo_detalle,modelo, talla, color, precio, cantidad) values(?,?,?,?,?,?,?)";
                $consulta = $pdo->prepare($sql);
    $det->setCodigoPedido($pedido->getCodigoPedido());
    $det->setCodigoDetalle($this->ultimoNumeroDetalle()+1);
                //en cada detalle asignamos el numero de factura padre:
                $consulta->execute(array($det->getCodigoPedido(),
                                     $det->getCodigoDetalle(),
                                     $det->getModelo(),
                                     $det->getTalla(),
                                     $det->getColor(),
                                     $det->getPrecio(),
                                     $det->getCantidad())
                                    
                        ); 
            }
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
        return $pedido;
    } 
    
        public function ultimoNumeroDetalle(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select max(codigo_detalle) numero from detalle";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        //obtenemos el registro especifico:
        $res=$consulta->fetch(PDO::FETCH_ASSOC);
        $numero=$res['numero'];
        Database::disconnect();
        //retornamos el numero encontrado:
        if(!isset($numero))
            return 0;
        return $numero;
    }
    
    
        public function ultimoNumeroPedido(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select max(codigo_pedido) numero from pedido";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        //obtenemos el registro especifico:
        $res=$consulta->fetch(PDO::FETCH_ASSOC);
        $numero=$res['numero'];
        Database::disconnect();
        //retornamos el numero encontrado:
        if(!isset($numero))
            return 0;
        return $numero;
    }
     public function eliminarDetalle($listadopedido,$idModelo){
        //buscamos el producto:
        $cont=0;
        foreach ($listadopedido as $det) {
            if($det->getModelo()==$idModelo){
                unset($listadopedido[$cont]);
                //reindexamos el array para eliminar el lugar vacio:
                $listadopedido=  array_values($listadopedido);
                break;
            }
            $cont++;
        }
        return $listadopedido;
    }
    
       public function calcularSubtotal($listadopedido){
        if(!isset($listadopedido)){
            return 0;
        }
        $subtotal=0;
        foreach ($listadopedido as $facturaDet) {
          
                $subtotal+=$facturaDet->getPrecio();
            
        }
        return $subtotal;
    }
     public function calcularIva($listadopedido){
        if(!isset($listadopedido)){
            return 0;
        }
        $iva=0;
        foreach ($listadopedido as $facturaDet) {
          
                $iva+=(($facturaDet->getPrecio()*0.12));
            
        }
        return $iva;
    } 
   public function calcularTotal($listadopedido){
        if(!isset($listadopedido)){
            return 0;
        }
        $total=0;
        foreach ($listadopedido as $facturaDet) {
          
                $total+=(($facturaDet->getPrecio()*0.12)+ $facturaDet->getPrecio());
            
        }
        return $total;
    } 
}