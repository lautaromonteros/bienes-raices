<?php

namespace App;

class ActiveRecord {
    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Validación
    protected static $errores = [];

    //Definir la conexion a bd
    public static function setDB($database){
        self::$db = $database;
    }

    public function guardar() {
        if(!is_null($this->id)){
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

        $query = "UPDATE " . static::$tabla . " SET ";
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

        $query = "INSERT INTO " . static::$tabla . "(".join(', ', array_keys($atributos)) . ") VALUES ('" . join("', '", array_values($atributos)) . " ');";

        $resultado = self::$db->query($query);

        if($resultado){
            //Redireccionar al usuario
            
            header('Location: ../?resultado=1');
        }
    }

    //Eliminar un registro
    public function eliminar(){
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado){
            $this->eliminarImagen();
            header('Location: ../admin?resultado=3');
        }

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
        if(!is_null($this->id)){
            $this->eliminarImagen();
        }

        //Asignar al atributo imagen, el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Eliminar archivo
    public function eliminarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
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
        $query = "select * from " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;

    }
    
    //Buscar propiedad por id
    public static function find($id){
        $query = "select * from " . static::$tabla . " where id = ${id}";

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
        $objeto = new static;

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