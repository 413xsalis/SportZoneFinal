<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'estudiante_documento',
        'fecha_pago',
        'valor',
        'medio_pago',
        'tipo',
        'concepto',
        'estado',
        'mes',
        'año'
    ];

     protected $dates = ['deleted_at']; // 👈 Para que Laravel maneje la fecha automáticamente

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_documento', 'documento');
    }

} 