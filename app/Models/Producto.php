<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'stock'];

    // Un producto tiene muchos SIM cards físicos
    public function simCards()
    {
        return $this->hasMany(SimCard::class);
    }

    // Función mágica para recalcular el stock
    public function recalcularStock()
    {
        $this->update([
            'stock' => $this->simCards()->where('estado', 'disponible')->count()
        ]);
    }
}