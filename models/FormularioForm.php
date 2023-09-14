<?php

namespace app\models;


use yii\base\Model;

class FormularioForm extends Model{
    public $nombre;
    public $apellido1;
    public $apellido2;


    public function rules(){

        return[
            [['nombre','apellido1','apellido2'],'required'],
            [['nombre','apellido1','apellido2'],'string'],
            

        ];

    }

    public function getNombreCompleto(){

        return ucfirst($this->nombre).' '.ucfirst($this->apellido1).' '.ucfirst($this->apellido2);

    }
}

?>