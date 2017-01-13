<?php
include 'Database.php';
include 'Color.php';
include 'Clientes.php';
include 'Modelos.php';
include 'Tallas.php';
/**
 * Objeto de negocio GastosModel. Implementa funciones CRUD
 * y varias funciones de negocio de la aplicacion Anexo de
 * gastos personales.
 *
 * @author mrea
 */
class YantexModel {
    
   

    //////////////////////////////////////////////////////////////////////
    ///////////////////////////////Clientes///////////////////////////////
    //////////////////////////////////////////////////////////////////////
    public function getClientes(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from clientes order by ci";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Factura:
        $listadocliente = array();
        foreach ($resultado as $res){
            $cliente = new Clientes($res["ci"], $res["nombre"], $res["apellido"], $res["telefono"], $res["celular"], $res["direccion"]);
            array_push($listadocliente, $cliente);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listadocliente;
    }
    
    
    public function insertarCliente($ci, $nombres, $apellidos, $telefono, $celular, $direccion){
        $estado=TRUE;
        $pdo = Database::connect();
         $sql = "select * from clientes";
        $resultado = $pdo->query($sql);
         foreach ($resultado as $res){
           
            $cliente = new Clientes($res["ci"], $res["nombre"], $res["apellido"], $res["telefono"], $res["celular"], $res["direccion"]);
            if (($res['ci']==$ci)) {
                $estado= false;
                $error="Numero de Factura Repetido"; 
                
           }
           
        }
        
        if($estado==TRUE){
        $sql = "insert into clientes(ci, nombre, apellido, telefono, celular, direccion) values(?,?,?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($ci, $nombres, $apellidos, $telefono, $celular, $direccion));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
        $error="Ingresado Correctamente";
    }
     
  
    return  $_SESSION['error']= serialize($error);
    }


    
      public function eliminarCliente($ci){
        //preparamos la conexion a la BDD
        $pdo=  Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from clientes where ci=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la  sentencia incluyendo a los parametros
      $consulta->execute(array($ci));
      Database::disconnect();
                
    }
  
    public function getCliente($ci) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from clientes where ci=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($ci));
        //obtenemos la factura especifica:
        $res=$consulta->fetch(PDO::FETCH_ASSOC);
        $cliente = new Clientes($res["ci"], $res["nombre"], $res["apellido"], $res["telefono"], $res["celular"], $res["direccion"]);
        Database::disconnect();
        //retornamos la factura encontrada:
        return $cliente;
    }

   
  
  public function actualizarCliente($ci, $nombres, $apellidos, $telefono, $celular, $direccion){
        $pdo = Database::connect();
        $sql = "update clientes set nombre=?,apellido=?,telefono=?,celular=?, direccion=? where ci=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($nombres, $apellidos, $telefono, $celular, $direccion,$ci));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();

}


    //////////////////////////////////////////////////////////////////////
    ///////////////////////////////Modelos////////////////////////////////
    //////////////////////////////////////////////////////////////////////

 public function getModelos(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from modelos order by modelo";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Factura:
        $listadomodelo = array();
        foreach ($resultado as $res){
            $modelo = new Modelos($res["modelo"],$res["precio"],$res["descripcion"],$res["imagen"]);
            array_push($listadomodelo, $modelo);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listadomodelo;
    }
    
    
    public function insertarModelo($modelo, $precio, $descripcion, $imagen){
        $estado=TRUE;
        $pdo = Database::connect();
         $sql = "select * from modelos";
        $resultado = $pdo->query($sql);
         foreach ($resultado as $res){
           
            $modelos = new Modelos($res["modelo"],$res["precio"],$res["descripcion"],$res["imagen"]);
            if (($res['modelo']==$Modelo)) {
                $estado= false;
                $error="Numero de Factura Repetido"; 
                
           }
           
        }
        
        if($estado==TRUE){
        $sql = "insert into modelos(modelo, precio, descripcion, imagen) values(?,?,?,?)";
        $consulta=$pdo->prepare($sql);
        
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($modelo, $precio, $descripcion, $imagen));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
        $error="Ingresado Correctamente";
    }
     
  
    return  $_SESSION['error']= serialize($error);
    }


    
      public function eliminarModelo($modelo){
        //preparamos la conexion a la BDD
        $pdo=  Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from modelos where modelo=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la  sentencia incluyendo a los parametros
         $consulta->execute(array($modelo));
        Database::disconnect();
                
    }
  
    public function getModelo($modelo) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from modelos where modelo=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($modelo));
        //obtenemos la factura especifica:
        $res=$consulta->fetch(PDO::FETCH_ASSOC);
          $mod = new Modelos($res["modelo"],$res["precio"],$res["descripcion"],$res["imagen"]);
        Database::disconnect();
        //retornamos la factura encontrada:
        return $mod;
    }

   
  
  public function actualizarModelo($modelo, $precio, $descripcion, $imagen){
        $pdo = Database::connect();
        $sql = "update modelos set  precio=?, descripcion=?, imagen=? where modelo=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($precio, $descripcion, $imagen, $modelo));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();

}

    //////////////////////////////////////////////////////////////////////
    ///////////////////////////////Colores///////////////////////////////
    //////////////////////////////////////////////////////////////////////


public function getColores(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from color order by color";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Factura:
        $listadocolor = array();
        foreach ($resultado as $res){
            $colores = new Color($res["color"],$res["nombre"],$res["imagen"]);
            array_push($listadocolor, $colores);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listadocolor;
    }
    
    
    public function insertarColor($color, $nombre, $imagen){
        $estado=TRUE;
        $pdo = Database::connect();
         $sql = "select * from color";
        $resultado = $pdo->query($sql);
         foreach ($resultado as $res){
           
            $colores = new Color($res["color"],$res["nombre"],$res["imagen"]);
            if (($res['color']==$color)) {
                $estado= false;
                $error="Numero de Factura Repetido"; 
                
           }
           
        }
        
        if($estado==TRUE){
        $sql = "insert into color(color, nombre, imagen) values(?,?,?)";
        $consulta=$pdo->prepare($sql);
        
        //Ejecutamos y pasamos los parametros:
        try{
        $consulta->execute(array($color,$nombre, $imagen));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
        $error="Ingresado Correctamente";
    }
     
  
    return  $_SESSION['error']= serialize($error);
    }


    
      public function eliminarColor($color){
        //preparamos la conexion a la BDD
        $pdo=  Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from color where color=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la  sentencia incluyendo a los parametros
         $consulta->execute(array($color));
        Database::disconnect();
                
    }
  
    public function getColor($color) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from color where color=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($color));
        //obtenemos la factura especifica:
        $res=$consulta->fetch(PDO::FETCH_ASSOC);
          $colores = new Color($res["color"],$res["nombre"],$res["imagen"]);
        Database::disconnect();
        //retornamos la factura encontrada:
        return $colores;
    }

   
  
  public function actualizarColor($color, $nombre, $imagen){
        $pdo = Database::connect();
        $sql = "update color set  nombre=?, imagen=? where color=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($nombre,  $imagen, $color));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();

}

  //////////////////////////////////////////////////////////////////////
    ///////////////////////////////Tallas///////////////////////////////
    //////////////////////////////////////////////////////////////////////


public function getTallas(){
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from tallas order by valor_talla asc";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Factura:
        $listadotalla = array();
        foreach ($resultado as $res){
            $tallascon = new Tallas($res["talla"],$res["valor_talla"],$res["descripcion"]);
            array_push($listadotalla, $tallascon);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listadotalla;
    }
    
    
    public function insertarTalla($talla, $valorTalla, $descripcion){
        $estado=TRUE;
        $pdo = Database::connect();
         $sql = "select * from tallas";
        $resultado = $pdo->query($sql);
         foreach ($resultado as $res){
           
            $tallascon = new Tallas($res["talla"],$res["valor_talla"],$res["descripcion"]);
            if (($res['talla']==$talla)) {
                $estado= false;
                $error="Numero de Factura Repetido"; 
                
           }
           
        }
        
        if($estado==TRUE){
        $sql = "insert into tallas(talla, valor_talla, descripcion) values(?,?,?)";
        $consulta=$pdo->prepare($sql);
        
        //Ejecutamos y pasamos los parametros:
        try{
        $consulta->execute(array($talla,$valorTalla, $descripcion));
        }  catch (PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
        $error="Ingresado Correctamente";
    }
     
  
    return  $_SESSION['error']= serialize($error);
    }


    
      public function eliminarTalla($talla){
        //preparamos la conexion a la BDD
        $pdo=  Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="delete from tallas where talla=?";
        $consulta=$pdo->prepare($sql);
        //Ejecutamos la  sentencia incluyendo a los parametros
         $consulta->execute(array($talla));
        Database::disconnect();
                
    }
  
    public function getTalla($talla) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from tallas where talla=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($talla));
        //obtenemos la factura especifica:
        $res=$consulta->fetch(PDO::FETCH_ASSOC);
          $tallasres = new Tallas($res["talla"],$res["valor_talla"],$res["descripcion"]);
        Database::disconnect();
        //retornamos la factura encontrada:
        return $tallasres;
    }

   
  
  public function actualizartalla($talla, $valorTalla, $descripcion){
        $pdo = Database::connect();
        $sql = "update tallas set  valor_talla=?, descripcion=? where talla=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($valorTalla,  $descripcion, $talla));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();

}
}