<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
/** Campos que pueden asignarse masivamente */    protected $fillable = ['slug','name','price_usd','mailbox_space_gb','domain_limit'];
}
