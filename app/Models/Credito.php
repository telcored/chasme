<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'fecha',
        'glosa',
        'monto',
        'tipo'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
