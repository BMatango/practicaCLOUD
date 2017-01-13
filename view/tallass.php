<!DOCTYPE html>
<?php
    session_start();
     include_once '../model/YantexModel.php';
?>

<html>
    <head>
       
        <meta charset="UTF-8">
        <title>Tallas</title>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-table.css" rel="stylesheet">
 <link rel="shortcut icon" type="image/x-icon" href="Recursos/icono.ico" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    </head>
    <body>
         <script>
 function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }
        
</script>
       <nav class="navlog2">
                  <a><img id="log3" src="Recursos/log3.png" onclick="location.href='index.html'" alt="Log wwe" id="log"></a>
                    </nav>
            <nav class="top-nav">
                <a><img src="Recursos/log.png" onclick="location.href='index.html'" alt="Log wwe" id="log" ></a>
			<div class="shell">
				<a href="#" class="nav-btn">INICIO<span></span></a>
				<span class="top-nav-shadow"></span>
				<ul>
                                    
					<li><span><a href="cliente.php">Clientes</a></span></li>
					<li><span><a href="modeloss.php">Modelos</a></span></li>
                                        <li><span><a href="tallass.php">Tallas</a></span></li>
                                        <li><span><a href="colores.php">Colores</a></span></li>
					
					
				</ul>
			</div>
                    
		</nav>
        
        <nav id="navcliente">
            <nav class="navlog2">
                  
                    </nav>
           
            <h2 id="titulo"> Ingreso de Tallas</h2>

        <form action="../controller/controller.php">
            <input type="hidden" name="opcion" value="insertartalla" >
            <table id="tablaingreso">
                
                <tr>
                    <td>Talla</td>
                    <td id="ingreso"><input required title="Ingrese una Talla" type="text" name="talla" size="20" maxlength="5"></td>
                </tr>
                
                <tr>
                    <td>Valor de Talla</td>
                    <td id="ingreso"><input onkeypress="return justNumbers(event);" required title="Valor de la Talla" type="text" name="valortalla" size="20" maxlength="5"></td>
                </tr>
                <tr>
                    <td>Descripcion</td>
                    <td id="ingreso"><input required  title="Descripcion" type="text" name="descripcion"size="30" maxlength="50"></td>
                </tr> 
                 <tr>
                 
                

                <tr><td><input type="submit" class="btn btn-info" value="Insertar nueva Talla"></td></tr>
            </table>
        </form>

        
            <table>
            <tr><td><form action="../controller/controller.php">
                        <input type="hidden" name="opcion" value="listartalla">
                        <br>
                        <input type="submit" class="btn btn-info" value="Consultar Tallas">
            </form></td>
            
           
            
            </tr>
        </table>
        <table  id="res" data-toggle="table">
            <thead>

            <tr>
                <th>Talla</th>
                <th>Valor de Talla</th>
                <th>Descripcion</th>
               
                <th>Eliminar</th>
                <th>Editar</th>
            </tr>
            </thead>
            <tbody>

            <?php
            //verificamos si existe en sesion el listado de facturas:
            if (isset($_SESSION['listadotalla'])) {
                $listadotalla = unserialize($_SESSION['listadotalla']);
                foreach ($listadotalla as $tal) {
                    echo "<tr>";
                    echo "<td>" . $tal->getTalla() . "</td>";
                    echo "<td>" . $tal->getValorTalla() . "</td>";
                    echo "<td>" . $tal->getDescripcion() . "</td>";
                    
                    echo"<td><a href='../controller/controller.php?opcion=eliminartalla&talla=".$tal->getTalla()."'>eliminar</a></td>";
                    echo "<td><a href='../controller/controller.php?opcion=editartalla&talla=".$tal->getTalla()."'><span class='glyphicon glyphicon-pencil'> Editar </span></a></td>";
                    echo "</tr>";
         
                }
            } else {
                echo "No se encontraron Clientes en la Base de Datos";
            }
             
            ?>
            </tbody
        </table>
    </body>
</html>
