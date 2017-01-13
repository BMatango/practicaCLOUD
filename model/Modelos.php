<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modelos
 *
 * @author Mauro
 */
class Modelos {
     
    private $modelo;
    private $precio;
    private $descripcion;
    private $imagen;
    
    function __construct($modelo, $precio, $descripcion, $imagen) {
        $this->modelo = $modelo;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
    }

    
    function getModelo() {
        return $this->modelo;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }


}
