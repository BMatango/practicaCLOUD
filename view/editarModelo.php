<!DOCTYPE html>
<?php
session_start();
   include_once '../model/YantexModel.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Modelo</title>
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
                  <a><img id="log3" src="Recursos/log3.png"  onclick="location.href='index.html'" alt="Log wwe" id="log"></a>
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
                                        <li><span><a href="colores.php">Colores</a></span></li>
					
					
				</ul>
			</div>
                    
		</nav>
        
        <nav id="navcliente">
        
         <nav class="navlog2">
                  
                    </nav>
         <h2 id="titulo">Editar Modelos</h2>
        <?php
          
            $mod=unserialize($_SESSION['mod']);
     
        ?>
        <form enctype="multipart/form-data" method="POST" action="../controller/controller.php">
            <input type="hidden" name="opcion" value="actualizarmodelo">
            <table id="tablaingreso" >
                
                <tr>
                    <td>Nombre Modelo</td>
                    <td>
                         <?php echo $mod->getModelo(); ?>
                        <input  type="hidden" name="modelo" value="<?php echo $mod->getModelo(); ?>" />
                       
                    </td>
                </tr>
                <tr>
                    <td>Precio</td>
                    <td>
                        <input id="ingreso" onkeypress="return justNumbers(event)" value="<?php echo $mod->getPrecio(); ?>" type="text" name="precio" size="17" maxlength="20" required="true">
                         
                    </td>
                </tr>
                <tr>
                    <td>Descripcion</td>
                    <td><input  id="ingreso"value="<?php echo $mod->getDescripcion(); ?>" type="text" name="descripcion" ize="10" maxlength="10" required></td>
                </tr>
                <tr>
                    <td>Imagen</td>
                     <td><input type="file" id="imagen" name="imagen"></td>
                    
                </tr>
               
                
                <tr>
                    <td><input type="submit" value="Actualizar Modelo" class="btn btn-info"></td>
                </tr>
            </table>
        </form>
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
