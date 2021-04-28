<?php

namespace App;

class Propiedad{

    //Base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    //Validación
    protected static $errores = [];

    public $id, $titulo, $precio, $imagen, $descripcion, $habitaciones, $wc, $estacionamiento, $creado, $vendedorid;

    //Definir la conexion a bd
    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = []){
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    public function guardar() {
        if(isset($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }

    public function actualizar(){
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query.= join(', ', $valores);
        $query.= " WHERE id = '" . self::$db->escape_string($this->id) ."'";
        $query.= " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado){
            //Redireccionar al usuario
            
            header('Location: ../?resultado=2');
        }


    }

    public function crear(){
        //Sanitizar entradas de datos
        $atributos = $this->sanitizarDatos();

        $query = "INSERT INTO propiedades(".join(', ', array_keys($atributos)) . ") VALUES ('" . join("', '", array_values($atributos)) . " ');";

        $resultado = self::$db->query($query);

        return $resultado;

        
    }

    //Identificar atributos
    public function atributos(){
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen){
        //Elimina la imagen previa
        if(isset($this->id)){
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }

        //Asignar al atributo imagen, el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
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
            self::$errores[] = 'La imagen es obligatoria';
        }

        return self::$errores;
    }

    //Lista todas las propiedades
    public static function all(){
        $query = "select * from propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;

    }
    
    //Buscar propiedad por id
    public static function find($id){
        $query = "select * from propiedades where id = ${id}";

        $resultado = self::consultarSQL($query);
        
        return array_shift($resultado);
    }

    protected static function consultarSQL($query){
        // Consultar db
        $resultado = self::$db->query($query);

        //Iterar resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach ($registro as $key => $value) {
            //debuguear($registro);
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []){
        foreach ($args as $key => $value) {
            if(property_exists($this, $key) && !is_null(($value))){
                $this->$key = $value;
            }
        }
    }
}