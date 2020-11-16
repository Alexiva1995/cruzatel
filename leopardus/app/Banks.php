<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    protected $table = 'banks';

    protected $fillable = [
        'nombre', 'titular', 'tipo_cuenta', 'numero_cuenta', 'dni', 'correo'
    ];
}
