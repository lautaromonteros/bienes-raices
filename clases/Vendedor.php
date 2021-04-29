<?php

namespace App;

class Vendedor extends ActiveRecord{
    
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id, $nombre, $apellido, $telefono;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    //Validación
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] = 'El nombre es obligatorio';
        }
        if(!$this->apellido){
            self::$errores[] = 'El apellido es obligatorio';
        }
        if(!$this->telefono){
            self::$errores[] = 'El telefono es obligatorio';
        }

        return self::$errores;
    }
}