<?php

namespace App;

class Propiedad extends ActiveRecord{

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    public $id, $titulo, $precio, $imagen, $descripcion, $habitaciones, $wc, $estacionamiento, $creado, $vendedorid;
    
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    //Validación
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = 'Debes añadir un titulo';
        }
        if(!$this->precio){
            self::$errores[] = 'Debes añadir un precio';
        }
        if(strlen($this->descripcion)<50){
            self::$errores[] = 'La descripcion es obligatoria y debe tener al menos 50 caracteres';
        }
        if(!$this->habitaciones){
            self::$errores[] = 'Debes añadir la cantidad de habitaciones';
        }
        if(!$this->wc){
            self::$errores[] = 'Debes añadir la cantidad de baños';
        }
        if(!$this->estacionamiento){
            self::$errores[] = 'Debes añadir la cantidad de estacionamiento';
        }
        if(!$this->vendedorId){
            self::$errores[] = 'Debes seleccionar un vendedor';
        }
        if(!$this->imagen){
            self::$errores[] = 'La imagen de la propiedad es obligatoria';
        }

        return self::$errores;
    }
}