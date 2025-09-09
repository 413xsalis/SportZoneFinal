<?php

namespace App\Models;

// Importaciones de clases necesarias
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // ← IMPORTANTE: Para manejo de roles y permisos
use Illuminate\Database\Eloquent\SoftDeletes; // ← IMPORTANTE: Para borrado suave (soft delete)

class User extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; // ← Configuración para soft delete

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles; // ← TRAITS IMPORTANTES:
    // - HasFactory: Para factories de testing
    // - Notifiable: Para notificaciones
    // - HasRoles: Para sistema de roles y permisos (Spatie package)

    /**
     * The attributes that are mass assignable.
     * ← ATRIBUTOS QUE SE PUEDEN ASIGNAR EN MASA (mass assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'eps', // ← Campo personalizado para EPS (seguro médico)
        'documento_identidad', // ← Número de documento
        'foto_documento', // ← Ruta/URL de foto del documento
        'direccion_hogar', // ← Dirección de residencia
        'fecha_nacimiento', // ← Fecha de nacimiento
        'telefono', // ← Número telefónico
        'foto_perfil', // ← Foto de perfil del usuario
        'logo_personalizado' // ← Logo personalizado (probablemente para branding)
    ];

    /**
     * The attributes that should be hidden for serialization.
     * ← ATRIBUTOS OCULTOS en respuestas JSON y arrays
     */
    protected $hidden = [
        'password', // ← Contraseña siempre oculta
        'remember_token', // ← Token de "recordarme" oculto
    ];

    /**
     * Get the attributes that should be cast.
     * ← CONVERSIONES DE TIPOS de atributos
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // ← Conversión a DateTime
            'password' => 'hashed', // ← IMPORTANTE: Encriptación automática de contraseñas
        ];
    }
}