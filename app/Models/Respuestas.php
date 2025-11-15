<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model
{
    protected $fillable = [
          'user_id',
            'consulta_id',
            'pregunta_id',
            'opcion_id',
            'fecha_respuesta'
    ];
}
