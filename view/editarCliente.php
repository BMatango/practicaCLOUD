<!DOCTYPE html>
<?php
session_start();
   include_once '../model/YantexModel.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Cliente</title>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-table.css" rel="stylesheet">
         <link rel="shortcut icon" type="image/x-icon" href="Recursos/icono.ico" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    </head>
    <body>
        
        <?php
            $cliente=unserialize($_SESSION['cliente']);

        ?>
          <nav class="navlog2">
                  <a><img id="log3" src="Recursos/log3.png"  alt="Log wwe" id="log"></a>
                    </nav>
        
        
          <nav class="top-nav">
                    <a><img src="Recursos/log.png" onclick="location.href='index.html'" alt="Log wwe" id="log"></a>
			<div class="shell">
				<a href="#" class="nav-btn">INICIO<span></span></a>
				<span class="top-nav-shadow"></span>
				<ul>
                                    
					<li><span><a href="cliente.php">Clientes</a></span></li>
					<li><span><a href="modeloss.php">Modelos</a></span></li>
                                        <li><span><a href="tallass.php">Tallas</a></span></li>
                                        <li><span><a href="colores.php#">Colores</a></span></li>
					
					
				</ul>
			</div>
                    
		</nav>
        
        <nav id="navcliente">
        
         <nav class="navlog2">
                  
                    </nav>
            <h2 id="titulo">Editar Clientes</h2>
        <form action="../controller/controller.php">
            <input type="hidden" name="opcion" value="actualizarcli">
            <table  id="tablaingreso">
                <tr>
                    <td>Ci</td>
                    <td id="ingreso">
                        <?php echo $cliente->getCi(); ?>
                        <input type="hidden" name="ci" value="<?php echo $cliente->getCi(); ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Nombres</td>
                    <td id="ingreso" >
                        <input value="<?php echo $cliente->getNombres(); ?>" type="text" name="nombres" size="17" maxlength="20" required="true">
                       
                    </td>
                </tr>
                <tr>
                    <td>Apellidos</td>
                    <td id="ingreso" >
                        <input value="<?php echo $cliente->getApellidos(); ?>" type="text" name="apellidos" size="17" maxlength="20" required="true">
                      
                    </td>
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td id="ingreso" ><input onkeypress="return justNumbers(event);" value="<?php echo $cliente->getTelefono(); ?>" type="text" name="telefono" ize="10" maxlength="10" required></td>
                </tr>
                <tr>
                    <td>Celular</td>
                    <td id="ingreso" ><input onkeypress="return justNumbers(event);" value="<?php echo $cliente->getCelular(); ?>" type="text" name="celular" ize="10" maxlength="10" required></td>
                    
                </tr>
                <tr>
                    <td>Direccion</td>
                    <td id="ingreso" ><input value="<?php echo $cliente->getDireccion(); ?>" type="text" name="direccion" size="20" maxlength="50" required></td>
                </tr>
                
                <tr>
                    <td id="ingreso" ><input type="submit" value="Actualizar Cliente" class="btn btn-info"></td>
                </tr>
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
        </form>
        </nav>
    </body>
</html>
