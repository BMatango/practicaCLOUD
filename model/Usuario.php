<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Mauro
 */
class Usuario {
    private $usuario;
    private $nombre;
    private $contraseña;
    
    function __construct($usuario, $nombre, $contraseña) {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->contraseña = $contraseña;
    }

    
    function getUsuario() {
        return $this->usuario;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getContraseña() {
        return $this->contraseña;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }


}
