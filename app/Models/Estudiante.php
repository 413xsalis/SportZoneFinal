<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $primaryKey = 'documento';
    public $incrementing = false;
    public $timestamps = true;


    protected $fillable = [
        'documento',
        'nombre_1',
        'nombre_2',
        'apellido_1',
        'apellido_2',
        'telefono',
        'nombre_contacto',
        'telefono_contacto',
        'eps',
        'grupo_id',
        'id_subgrupo',
        'estado'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
    public function subgrupo()
    {
        return $this->belongsTo(Subgrupo::class, 'id_subgrupo');
    }
    public function getNombreCompletoAttribute()
    {
        return trim("{$this->nombre_1} {$this->nombre_2} {$this->apellido_1} {$this->apellido_2}");
    }
}
