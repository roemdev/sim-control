<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudSim extends Model
{
    // Agregamos 'codigo' al fillable para evitar errores de asignación masiva
    protected $fillable = [
        'codigo',
        'cliente',
        'producto_id',
        'cantidad',
        'user_id',
        'estado',
    ];

    // Método para generar el código automáticamente al crear un registro
    protected static function booted()
    {
        static::creating(function ($solicitud) {
            // Genera algo como: SOL-260303-A1B2
            $solicitud->codigo = 'SOL-'.date('ymd').'-'.strtoupper(bin2hex(random_bytes(2)));
        });
    }

    // Constantes/Opciones de estado para reutilizar en el código
    public static function opcionesEstado(): array
    {
        return [
            'pendiente' => 'PENDIENTE',
            'completada' => 'COMPLETADA',
            'desestimada' => 'DESESTIMADA',
        ];
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function simCard()
    {
        return $this->hasOne(SimCard::class, 'solicitud_sim_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
