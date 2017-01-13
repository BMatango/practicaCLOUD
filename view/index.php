<!DOCTYPE html>
<?php
require_once '../model/YantexModel.php';
include '../model/factModel.php';;
//include '../model/Detalle.php';


session_start();
    $yantexsModel=new YantexModel();
    $factModel=new factModel();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Facturación - factura</title>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="css/cssaux.css" type="text/css" media="all" />
        <link href="css/bootstrap-table.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <img id="logfoto "  width="700px" height="150px"src="Recursos/log.png">
            <div class="row">
                <h3>Nueva factura</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../view/index.html">Inicio</a>
                <a class="btn btn-success" href="../controller/controller.php?opcion=nueva_factura">Nueva factura</a>
                <?php
                if (isset($_SESSION['mensajeError'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['mensajeError'] . "</div>";
                }
                ?>
            </div>
           
<!--               <form action="../controller/controller.php">
                        <input type="hidden" name="opcion" value="reportepedios">
                        <br>
                        <input type="submit" class="btn btn-success" value="Reporte Facturas">
            </form>-->
            <p>
            <form action="../controller/controller.php">
                <input type="hidden" name="opcion" value="guardarpedido">
                Seleccione el cliente:
                <select name="ci">
                    <?php
                    
                    $listadocliente = $yantexsModel->getClientes();
                    foreach ($listadocliente as $cliente) {
                        echo "<option value='" . $cliente->getCi() . "'>" . $cliente->getApellidos() . " " . $cliente->getNombres() . "</option>";
                    }
                    ?>
                </select>
                Fecha:<input type="date" name="fechaentrega" required="true"  required="" value="<?php echo date('Y-m-d'); ?>">
                <input type="submit" value="Guardar Pedido">
            </form>
        </p>
        <p>
        <form action="../controller/controller.php">
            <input type="hidden" name="opcion" value="adicionar_detalle">
            <table id="">
                
             <tr>
                 
                 <td>
            Seleccione el Modelo:
            <select name="idmodelo">
                <?php
                $listadomodelo = $yantexsModel->getModelos();
                foreach ($listadomodelo as $prod) {
                    echo "<option value='" . $prod->getModelo() . "'>" . $prod->getModelo() . "</option>";
                }
                ?>
            </select>
            </td>
            <td>
            Seleccione un Color:
            <select name="idcolor">
                <?php
                $listadocolor = $yantexsModel->getColores();
                foreach ($listadocolor as $prod) {
                    echo "<option value='" . $prod->getColor() . "'>" . $prod->getNombre() . "</option>";
                }
                ?>
            </select>
            </td>
            <td>
            Seleccione la Talla:
            <select name="idtalla">
                <?php
                $listadotalla = $yantexsModel->getTallas()
;                foreach ($listadotalla as $prod) {
                    echo "<option value='" . $prod->getTalla() . "'>" . $prod->getDescripcion() . "</option>";
                }
                ?>
            </select>
            </td>
            <td>
             
            Cantidad:<input type="text" name="cantidad" maxlength="10" required="true" value="1">
            </td>
            </tr>
           
                
           
           
            
            </table>
             <input type="submit" value="Adicionar">
        </form>
    </p>
    <table data-toggle="table">
        <thead>
            <tr>
                <th>Nro Detalle</th>
                <th>Modelo</th>
                <th>Talla</th>
                <th>Color</th>
                <th>Cantidad</th>
                <th>Precio</th>
              
                <th>Eliminar</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            //verificamos si existe en sesion el listado de clientes:
            if (isset($_SESSION['listadopedido'])) {
                $listadopedido = unserialize($_SESSION['listadopedido']);
                foreach ($listadopedido as $facturaDet) {
                //    var_dump($facturaDet);die();
                    echo "<tr>";
                      
                    //echo "<td>" . $facturaDet->getCodigoPedido() . "</td>";
                    echo "<td>" . $facturaDet->getCodigoDetalle() . "</td>";
                    echo "<td>" . $facturaDet->getModelo() . "</td>";
                    echo "<td>" . $facturaDet->getTalla() . "</td>";
                    echo "<td>" . $facturaDet->getColor() . "</td>";
                    echo "<td>" . $facturaDet->getCantidad() . "</td>";
                    echo "<td>" . $facturaDet->getPrecio() . "</td>";
                    echo "<td><a href='../controller/controller.php?opcion=eliminar_detalle&idmodelo=" . $facturaDet->getModelo() . "'>Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "<tr>";
                echo "<td> </td>";
                echo "<td>Subtotal</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>" . $factModel->calcularSubtotal($listadopedido)."</td>";
                echo "<td></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> </td>";
                echo "<td>Iva</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
               echo "<td>" . $factModel->calcularIva($listadopedido) . "</td>";
                echo "<td></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> </td>";
                echo "<td>Total</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                 echo "<td>" . $factModel->calcularTotal($listadopedido) . "</td>";
               
           
                echo "<td></td>";
                echo "</tr>";
            } else {
                echo "No se han cargado datos.";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
