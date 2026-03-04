<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimCard extends Model
{
    protected $fillable = [
        'serial_number',
        'numero_telefono',
        'producto_id',
        'estado',
        'solicitud_sim_id',
        'fecha_asignacion',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function solicitud()
    {
        return $this->belongsTo(SolicitudSim::class, 'solicitud_sim_id');
    }

    // Automatización: Se ejecuta cada vez que creas, actualizas o eliminas un SIM
    protected static function booted()
    {
        static::saved(function ($simCard) {
            $simCard->producto->recalcularStock();
        });

        static::deleted(function ($simCard) {
            $simCard->producto->recalcularStock();
        });
    }
}
