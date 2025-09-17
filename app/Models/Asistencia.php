<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estudiante;
use App\Models\Subgrupo;

class Asistencia extends Model
{
    protected $table = 'asistencias';



    // Laravel manejará el ID autoincremental
    protected $primaryKey = 'id';
    public $incrementing = true;   // ✅ debe ser true
    protected $keyType = 'int';    // ✅ entero, no string

    protected $fillable = [
        'estudiante_documento',
        'subgrupo_id',
        'fecha',
        'estado'
    ];

// En Asistencia.php
public function getGrupoAttribute()
{
    return $this->subgrupo ? $this->subgrupo->grupo : null;
}


    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_documento', 'documento');
    }

    public function subgrupo()
    {
        return $this->belongsTo(Subgrupo::class, 'subgrupo_id', 'id');
    }

        public function getHoraRegistroAttribute()
    {
        return $this->updated_at ? $this->updated_at->format('H:i:s') : null;
    }
}