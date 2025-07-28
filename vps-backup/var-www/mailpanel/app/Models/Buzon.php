<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buzon extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'email',
        'password',
        'activo',
        'dominio_id',  // <— añadimos la nueva columna
    ];

    // Ocultar el password al serializar el modelo
    protected $hidden = [
        'password',
    ];

    /**
     * Relación: un buzón pertenece a un dominio.
     */
    public function dominio()
    {
        return $this->belongsTo(Dominio::class, 'dominio_id');
    }
}

