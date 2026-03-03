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
        'fecha_asignacion'
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
        static::created(function ($simCard) {
            // ⚡ Bolt: Recalcular stock cuando se crea un nuevo SIM
            $simCard->producto->recalcularStock();
        });

        static::updated(function ($simCard) {
            // ⚡ Bolt: Solo recalcular stock si cambió su estado o tipo de producto
            if ($simCard->wasChanged(['estado', 'producto_id'])) {
                $simCard->producto->recalcularStock();
            }
        });

        static::deleted(function ($simCard) {
            $simCard->producto->recalcularStock();
        });
    }
}