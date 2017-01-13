<!DOCTYPE html>
<?php
    
    session_start();
   
    include_once '../model/YantexModel.php';
?>

<html>
    <head>
       
        <meta charset="UTF-8">
        <title>Modelos</title>
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
                  <a><img id="log3" src="Recursos/log3.png" alt="Log wwe" id="log"></a>
                    </nav>
            <nav class="top-nav">
                <a><img src="Recursos/log.png"  onclick="location.href='index.html'" alt="Log wwe" id="log" ></a>
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
           
            <h2 id="titulo">Modelos</h2>

            <form enctype="multipart/form-data" method="POST" action="../controller/controller.php" >
            <input type="hidden" name="opcion" value="insertarmodelo" >
            <table id="tablaingreso">
                
                
                
                <tr>
                    <td>Nombre Modelo</td>
                    <td id="ingreso"><input required title="Nombre Modelo" type="text" name="modelo" size="17" maxlength="17"></td>
                </tr>
                <tr>
                    <td>Precio</td>
                    <td id="ingreso"><input onkeypress="return justNumbers(event)"  required  title="Precio" type="text" name="precio"size="10" maxlength="10"></td>
                </tr> 
                 <tr>
                    <td>Descripcion</td>
                    <td id="ingreso"><input required title="Descripcion" type="text" name="descripcion" size="10" maxlength="50"></td>
                </tr>
                
                <tr>
                    <td>Imagen </td>
                   
                    <td><input type="file" id="imagen" name="imagen"></td>
                </tr>
                
                

                <tr><td><input type="submit" class="btn btn-info" value="Insertar nuevo Modelo"></td></tr>
            </table>
        </form>

        
        <table>
            <tr><td><form action="../controller/controller.php">
                        <input type="hidden" name="opcion" value="listarmodelo">
                        <br>
                        <input type="submit" class="btn btn-info" value="Consultar Modelos">
            </form></td>
            
           
            
            </tr>
        </table>
            <table id="res"data-toggle="table">
            <thead>

            <tr>
                
                <th>Nombre Modelo</th>
                <th>Precio</th>
                <th>Descripcion</th>
                <th>Imagen</th>
                <th>Eliminar</th> 
                <th>Editar</th>
            </tr>
            </thead>
            <tbody>

            <?php
            
            //verificamos si existe en sesion el listado de facturas:
            if (isset($_SESSION['listadomodelo'])) {
              
                $listadomodelo = unserialize($_SESSION['listadomodelo']);
               
                foreach ($listadomodelo as $modelo) {
                    echo "<tr>";
                    echo "<td>" . $modelo->getModelo() . "</td>";
                    echo "<td>" . $modelo->getPrecio() . "</td>";
                    echo "<td>" . $modelo->getDescripcion() . "</td>";
                    
                    echo "<td>"."<img width='200px' height='180px' src='../view/modelos/".$modelo->getImagen() ."'></td>";
                 
                    echo"<td><a onclick=\"if(confirm('¿Est&aacute; seguro de eliminar al modelo ".$modelo->getModelo()." ?')){ location.href='../controller/controller.php?opcion=eliminarmodelo&modelo=".$modelo->getModelo()."';} else {return false;}\">eliminar</a></td>";
                    echo "<td><a href='../controller/controller.php?opcion=editarmodelo&modelo=".$modelo->getModelo()."'><span class='glyphicon glyphicon-pencil'> Editar </span></a></td>";
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
