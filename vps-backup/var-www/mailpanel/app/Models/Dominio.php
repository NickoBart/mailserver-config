<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dominio extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'valido',
    ];

    /**
     * Un dominio puede tener muchos buzones.
     */
    public function buzones()
    {
        return $this->hasMany(Buzon::class, 'dominio_id');
    }
}
