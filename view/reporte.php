<!DOCTYPE html>
<?php

include '../model/factModel.php';

session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Facturación - lista de Pedidos</title>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-table.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <img src="images/banner-facturacion.jpg">
            <div class="row">
                <h3>Lista de Pedidos</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="../view/index.php">Inicio</a>
            </div>

            <form action="../controller/controller.php">
                        <input type="hidden" name="opcion" value="listarpedido">
                        <br>
                        <input type="submit" class="btn btn-success" value="Consultar Pedidoss">
            </form>
            <table data-toggle="table" data-pagination="true">
                <thead>
                    <tr>
                        <th>Codigo Pedido</th>
                        <th>Cedula</th>
                        <th>Cliente</th>
                        <th>Fecha Pedido/th>
                        <th>Fecha Entrega</th>
                        <th>SubtotaE</th>
                        <th>Iva</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //verificamos si existe en sesion el listado de facturas:
                    if (isset($_SESSION['lsitado'])) {
                        $listado = unserialize($_SESSION['listado']);
                        print_r($listado);
                        foreach ($listado as $factura) {
                            echo "<tr>";
                            echo "<td>" . $factura->getCodigoPedido() . "</td>";
                            echo "<td>" . $factura->getCi() . "</td>";
                            echo "<td>" . $factura->getCliente() . "</td>";
                            echo "<td>" . $factura->getFechaPedido() . "</td>";
                            echo "<td>" . $factura->getFechaEntrega() . "</td>";
                            echo "<td>" . $factura->getSubtotal() . "</td>";
                            echo "<td>" . $factura->getIva() . "</td>";
                            echo "<td>" . $factura->getTotal() . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "No se han cargado datos.";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
