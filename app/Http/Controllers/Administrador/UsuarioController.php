<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * MÉTODO INDEX - LISTA PRINCIPAL DE USUARIOS
     * Muestra la lista de usuarios con paginación y estadísticas
     */
    public function index()
    {
        // Obtener usuarios con sus roles (relación eager loading)
        $users = User::with('roles')->paginate(10);
        
        // Estadísticas para el dashboard
        $totalUsers = User::withTrashed()->count();      // Total incluyendo eliminados
        $activeUsers = User::whereNull('deleted_at')->count();  // Usuarios activos
        $inactiveUsers = User::onlyTrashed()->count();   // Usuarios eliminados (inactivos)

        return view('administrador.Gestion_usuarios.principal', 
            compact('users', 'totalUsers', 'activeUsers', 'inactiveUsers'));
    }

    /**
     * MÉTODO TRASHED - PAPELERA DE USUARIOS ELIMINADOS
     * Muestra solo los usuarios con eliminación suave (soft delete)
     */
    public function trashed()
    {
        $users = User::onlyTrashed()->latest()->get();
        return view('administrador.Gestion_usuarios.trashed', compact('users'));
    }

    /**
     * MÉTODO SHOW - MOSTRAR DETALLES DE USUARIO
     * Muestra los detalles de un usuario específico
     */
    public function show(User $usuario)
    {
        // Carga explícita de roles para evitar problemas de carga diferida
        $usuario->load('roles');
        return view('administrador.Gestion_usuarios.show', compact('usuario'));
    }

    /**
     * MÉTODO EDIT - FORMULARIO DE EDICIÓN
     * Muestra el formulario para editar un usuario existente
     */
    public function edit(User $usuario)
    {
        $roles = Role::all(); // Todos los roles disponibles
        return view('administrador.Gestion_usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * MÉTODO UPDATE - ACTUALIZAR USUARIO
     * Valida y actualiza la información de un usuario existente
     */
    public function update(Request $request, User $usuario)
    {
        // Validación con regla unique ignorando el usuario actual
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 
                       Rule::unique('users')->ignore($usuario->id)],
            'roles' => ['array'],
            'roles.*' => ['exists:roles,name'], // Valida que los roles existan
        ]);

        // Actualizar información básica del usuario
        $usuario->update($request->all());

        // Sincronizar roles (elimina los antiguos y añade los nuevos)
        $usuario->syncRoles($request->input('roles', []));

        return redirect()->route('admin.gestion')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * MÉTODO DESTROY - ELIMINACIÓN SUAVE (SOFT DELETE)
     * Desactiva un usuario sin eliminarlo permanentemente
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete(); // Eliminación suave

        return redirect()->route('admin.gestion')
            ->with('success', 'Usuario desactivado exitosamente');
    }

    /**
     * MÉTODO RESTORE - RESTAURAR USUARIO ELIMINADO
     * Reactiva un usuario que fue eliminado con soft delete
     */
    public function restore($id)
    {
        $usuario = User::withTrashed()->findOrFail($id);
        $usuario->restore(); // Restauración

        return redirect()->route('admin.gestion')
            ->with('success', 'Usuario reactivado exitosamente');
    }

    /**
     * MÉTODO FORCE DELETE - ELIMINACIÓN PERMANENTE
     * Elimina definitivamente un usuario de la base de datos
     */
    public function forceDelete($id)
    {
        $usuario = User::withTrashed()->findOrFail($id);
        $usuario->forceDelete(); // Eliminación permanente

        return redirect()->route('admin.gestion')
            ->with('success', 'Usuario eliminado permanentemente');
    }
}