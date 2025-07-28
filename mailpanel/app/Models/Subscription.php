<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    // Permitir la asignación masiva de estos campos
    protected $fillable = [
        'quantity','billing_day','razon_social','rut','direccion','ciudad_region','giro','contact_email','contact_phone',
        'name',
        'email',
        'domain',
        'status',
        'preference_id',
        'init_point',
        'expires_at',
        'plan_id',
    ];

    // Casteos
    protected $casts = [
        'expires_at'  => 'datetime',
        'grace_until' => 'datetime',
    ];


    /**
     * La suscripción pertenece a un plan.
     */
    public function plan()
    {
        return $this->belongsTo(\App\Models\Plan::class);
    }
}
