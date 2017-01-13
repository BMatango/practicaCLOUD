<!DOCTYPE html>
<?php
    session_start();
     include_once '../model/YantexModel.php';
?>

<html>
    <head>
       
        <meta charset="UTF-8">
        <title>Clientes</title>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-table.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="Recursos/icono.ico" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
        
    </head>
   
    <body id="bodycliente">
         <nav class="navlog2">
                  <a><img id="log3" src="Recursos/log3.png" alt="Log wwe" id="log"></a>
                    </nav>
        <nav class="top-nav">
            <a><img src="Recursos/log.png" alt="Log Yantex" onclick="location.href='index.html'"  id="log"></a>
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
            <h2 id="titulo">Clientes</h2>

        <form action="../controller/controller.php">
            <input type="hidden" name="opcion" value="insertarcliente" >
            <table id="tablaingreso">
                
                <tr>
                    <td>Ci</td>
                    <td><input id="ingreso" onkeypress="return justNumbers(event);" required title="CI" type="text" name="ci" size="17" maxlength="10"></td>
                </tr>
                
                <tr>
                    <td>Nombres</td>
                    <td><input id="ingreso" required title="Nombres" type="text" name="nombres" size="17" maxlength="20"></td>
                </tr>
                <tr>
                    <td>Apellidos</td>
                    <td><input id="ingreso" required  title="Apellidos" type="text" name="apellidos"size="17" maxlength="20"></td>
                </tr> 
                 <tr>
                    <td>Telefono</td>
                    <td><input id="ingreso" required title="Telefono" onkeypress="return justNumbers(event);" type="text" name="telefono" size="10" maxlength="10"></td>
                </tr>
                
                <tr>
                    <td>Celular</td>
                    <td><input id="ingreso"  title="Celular" V type="text" name="celular" size="10" maxlength="10"></td>
                </tr>
                <tr>
                    <td>Direccion</td>
                    <td><input id="ingreso" required  title="Direccion" type="text" name="direccion" size="20" maxlength="50"></td>
                </tr> 
                

                <tr><td><input type="submit" class="btn btn-success" value="Insertar nuevo Cliente"></td></tr>
            </table>
        </form>

        </nav>
        <table>
            <tr><td><form action="../controller/controller.php">
                        <input type="hidden" name="opcion" value="listarcliente">
                        <br>
                        <input type="submit" class="btn btn-success" value="Consultar Clientes">
            </form></td>
            
           
            
            </tr>
        </table>
        <table id="res" data-toggle="table">
            <thead>

            <tr>
                <th>Ci</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Telefono</th>
                <th>Celular</th>
                <th>Direccion</th>
                <th>Eliminar</th>
                <th>Editar</th>
            </tr>
            </thead>
            <tbody>

            <?php
            //verificamos si existe en sesion el listado de facturas:
            if (isset($_SESSION['listadocliente'])) {
                $listadocliente = unserialize($_SESSION['listadocliente']);
                foreach ($listadocliente as $client) {
                    echo "<tr>";
                    echo "<td>" . $client->getCi() . "</td>";
                    echo "<td>" . $client->getNombres() . "</td>";
                    echo "<td>" . $client->getApellidos() . "</td>";
                    echo "<td>" . $client->getTelefono() . "</td>";
                    echo "<td>" . $client->getCelular() ."</td>";
                    echo "<td>" . $client->getDireccion() ."</td>";
                    echo"<td><a onclick=\"if(confirm('¿Est&aacute; seguro de eliminar al Cliente ".$client->getApellidos()." ".$client->getNombres()." ?')){ location.href='../controller/controller.php?opcion=eliminarcliente&ci=".$client->getCi()."';} else {return false;}\">eliminar</a></td>";
                    
                    echo "<td><a href='../controller/controller.php?opcion=editarcliente&ci=".$client->getCi()."'><span class='glyphicon glyphicon-pencil'> Editar </span></a></td>";
                    echo "</tr>";
         
                }
            } else {
                echo "No se encontraron Clientes en la Base de Datos";
            }
             
            ?>
            </tbody
        </table>
              <script>
 function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }
        
</script>
    </body>
</html>
