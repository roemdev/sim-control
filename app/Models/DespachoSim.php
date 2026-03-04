<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DespachoSim extends Model
{
    protected $fillable = [
        'serial_number',
        'solicitud_sim_id',
        'estado',
    ];

    public function solicitudSim()
    {
        return $this->belongsTo(SolicitudSim::class);
    }

    public function simCard()
    {
        return $this->belongsTo(SimCard::class, 'serial_number', 'serial_number');
    }

    protected static function booted()
    {
        static::created(function ($despacho) {
            $simCard = $despacho->simCard;
            if ($simCard) {
                $simCard->update([
                    'estado' => 'asignada',
                    'solicitud_sim_id' => $despacho->solicitud_sim_id,
                    'fecha_asignacion' => now(),
                ]);
            }
        });
    }
}
