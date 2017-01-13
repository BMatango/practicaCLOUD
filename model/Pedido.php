<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pedido
 *
 * @author Mauro
 */
class Pedido {
    private $codigoPedido;
    private $ci;
    private $cliente;
    private $fechaPedido;
    private $fechaEntrega;
    private $subtotal;
    private $iva;
    private $total;

    function __construct($codigoPedido, $ci, $cliente, $fechaPedido, $fechaEntrega, $subtotal, $iva, $total) {
        $this->codigoPedido = $codigoPedido;
        $this->ci = $ci;
        $this->cliente = $cliente;
        $this->fechaPedido = $fechaPedido;
        $this->fechaEntrega = $fechaEntrega;
        $this->subtotal = $subtotal;
        $this->iva = $iva;
        $this->total = $total;
    }

    
    function getCodigoPedido() {
        return $this->codigoPedido;
    }

    function getCi() {
        return $this->ci;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getFechaPedido() {
        return $this->fechaPedido;
    }

    function getFechaEntrega() {
        return $this->fechaEntrega;
    }

    function getSubtotal() {
        return $this->subtotal;
    }

    function getIva() {
        return $this->iva;
    }

    function getTotal() {
        return $this->total;
    }

    function setCodigoPedido($codigoPedido) {
        $this->codigoPedido = $codigoPedido;
    }

    function setCi($ci) {
        $this->ci = $ci;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function setFechaPedido($fechaPedido) {
        $this->fechaPedido = $fechaPedido;
    }

    function setFechaEntrega($fechaEntrega) {
        $this->fechaEntrega = $fechaEntrega;
    }

    function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    function setIva($iva) {
        $this->iva = $iva;
    }

    function setTotal($total) {
        $this->total = $total;
    }


  
}
