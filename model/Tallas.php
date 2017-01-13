<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tallas
 *
 * @author Mauro
 */
class Tallas {
    private $talla;
    private $valorTalla;
    private $descripcion;
    
    function __construct($talla, $valorTalla, $descripcion) {
        $this->talla = $talla;
        $this->valorTalla = $valorTalla;
        $this->descripcion = $descripcion;
    }


    
    function getTalla() {
        return $this->talla;
    }

    function getValorTalla() {
        return $this->valorTalla;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setTalla($talla) {
        $this->talla = $talla;
    }

    function setValorTalla($valorTalla) {
        $this->valorTalla = $valorTalla;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }


}
