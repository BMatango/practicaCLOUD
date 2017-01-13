<!DOCTYPE html>
<?php
    session_start();
     include_once '../model/YantexModel.php';
?>

<html>
    <head>
       
        <meta charset="UTF-8">
        <title>Color</title>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-table.css" rel="stylesheet">
         <link rel="shortcut icon" type="image/x-icon" href="Recursos/icono.ico" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

    </head>
    <body>
          <nav class="navlog2">
                  <a><img id="log3" src="Recursos/log3.png" alt="Log yantex"  id="log"></a>
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
           
            <h2 id="titulo"> Ingreso de Colores</h2>

        <form enctype="multipart/form-data" method="POST" action="../controller/controller.php">
            <input type="hidden" name="opcion" value="insertarcolor" >
            <table id="tablaingreso">
                
                <tr>
                    <td>Codigo color</td>
                    <td><input  id="ingreso" required title="Cod Color" type="text" name="color" size="17" maxlength="10"></td>
                </tr>
                
                <tr>
                    <td>Nombre</td>
                    <td><input id="ingreso" required title="Nombre" type="text" name="nombre" size="20" maxlength="30"></td>
                </tr>
                <tr>
                    <td>Url Imagen</td>
                     <td><input type="file" id="imagen" name="imagen"></td>
                </tr> 
                 <tr>
                 
                

                <tr><td><input type="submit" class="btn btn-info" value="Insertar nuevo Color"></td></tr>
            </table>
        </form>

        
        <table>
            <tr><td><form action="../controller/controller.php">
                        <input type="hidden" name="opcion" value="listarcolor">
                        <br>
                        <input type="submit" class="btn btn-info" value="Consultar Colores">
            </form></td>
            
           
            
            </tr>
        </table>
        <table id="res" data-toggle="table">
            <thead>

            <tr>
                <th>Codigo Color</th>
                <th>Nombre</th>
                <th>Imagen</th>
               
                <th>Eliminar</th>
                <th>Editar</th>
            </tr>
            </thead>
            <tbody>

            <?php
            //verificamos si existe en sesion el listado de facturas:
            if (isset($_SESSION['listadocolor'])) {
                $listadocolor = unserialize($_SESSION['listadocolor']);
                foreach ($listadocolor as $col) {
                    echo "<tr>";
                    echo "<td>" . $col->getColor() . "</td>";
                    echo "<td>" . $col->getNombre() . "</td>";
                      echo "<td>"."<img width='200px' height='180px' src='../view/colores/".$col->getImagen() ."'></td>";
                  
                    echo"<td><a onclick=\"if(confirm('¿Est&aacute; seguro de eliminar el Color ".$col->getColor()." ?')){ location.href='../controller/controller.php?opcion=eliminarcolor&color=".$col->getColor()."';} else {return false;}\">eliminar</a></td>";
                    echo "<td><a href='../controller/controller.php?opcion=editarcolor&color=".$col->getColor()."'><span class='glyphicon glyphicon-pencil'> Editar </span></a></td>";
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
