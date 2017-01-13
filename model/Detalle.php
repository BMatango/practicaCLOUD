<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Detalle
 *
 * @author Mauro
 */
class Detalle {
    private $codigoDetalle;
    private $codigoPedido;
    private $modelo;
    private $talla;
    private $color;
    private $cantidad;
    private $precio;
    private $subtotal;
    private $total;
    
    
    function __construct($codigoDetalle, $codigoPedido, $modelo, $talla, $color, $cantidad, $precio, $subtotal, $total) {
        $this->codigoDetalle = $codigoDetalle;
        $this->codigoPedido = $codigoPedido;
        $this->modelo = $modelo;
        $this->talla = $talla;
        $this->color = $color;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->subtotal = $subtotal;
        $this->total = $total;
    }

    
    function getSubtotal() {
        return $this->subtotal;
    }

    function getTotal() {
        return $this->total;
    }

    function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    function setTotal($total) {
        $this->total = $total;
    }

        
    function getCodigoDetalle() {
        return $this->codigoDetalle;
    }

    function getCodigoPedido() {
        return $this->codigoPedido;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getTalla() {
        return $this->talla;
    }

    function getColor() {
        return $this->color;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setCodigoDetalle($codigoDetalle) {
        $this->codigoDetalle = $codigoDetalle;
    }

    function setCodigoPedido($codigoPedido) {
        $this->codigoPedido = $codigoPedido;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setTalla($talla) {
        $this->talla = $talla;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }


}
