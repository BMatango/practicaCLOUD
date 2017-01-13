<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Color
 *
 * @author Mauro
 */
class Color {
    private $color;
    private $nombre;
    private $imagen;
    
    function __construct($color, $nombre, $imagen) {
        $this->color = $color;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
    }

    
    function getColor() {
        return $this->color;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

 
}
