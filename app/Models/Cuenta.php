<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cuenta extends Model
{
    use HasUuids;

    public function getTransferenciasAttribute()
    {
        return $this->transferenciasRealizadas->merge($this->transferenciasRecibidas);
    }

    public function transferenciasRealizadas() : HasMany
    {
        return $this->hasMany(Transferencia::class, 'cuenta_origen');
    }

    public function transferenciasRecibidas() : HasMany
    {
        return $this->hasMany(Transferencia::class, 'cuenta_destino');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }


}
