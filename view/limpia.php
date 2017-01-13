<?php
include '../model/factModel.php';

 $listadopedido=NULL;
 $_SESSION['listadopedido']=$listadopedido;
 header('Location: ../view/index.php');
