<!DOCTYPE html>
<?php
session_start();
   include_once '../model/YantexModel.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Talla</title>
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
                    <a><img src="Recursos/log.png" alt="Log wwe" onclick="location.href='index.html'" id="log"></a>
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
            <h2 id="titulo">Editar Talla</h2>
        <?php
            $tallasres=unserialize($_SESSION['tallasres']);
      

        ?>
        <form action="../controller/controller.php">
            <input type="hidden" name="opcion" value="actualizartalla">
            <table id="tablaingreso">
                <tr>
                    <td>Talla</td>
                    <td>
                        <?php echo $tallasres->getTalla(); ?>
                        <input type="hidden" name="talla" value="<?php echo $tallasres->getTalla(); ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Valor de Talla</td>
                    <td>
                        <input id="ingreso" value="<?php echo $tallasres->getValorTalla(); ?>" type="text" name="valortalla" size="17" maxlength="20" required="true">
                       
                    </td>
                </tr>
                <tr>
                    <td>Descripcion</td>
                    <td><input  id="ingreso"value="<?php echo $tallasres->getDescripcion(); ?>" type="text" name="descripcion" size="20" maxlength="50" required></td>
                </tr>
                
                <tr>
                    <td><input type="submit" value="Actualizar Color" class="btn btn-info"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
