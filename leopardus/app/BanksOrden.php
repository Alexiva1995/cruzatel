<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanksOrden extends Model
{
    protected $table = 'banks_orden';

    protected $fillable = [
        'idorden', 'iduser', 'producto', 'precio', 'bauche',
        'status', 'titular', 'n_cuenta'
    ];
}
