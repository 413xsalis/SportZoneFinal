<?php
namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PerfilInstController extends Controller
{
    public function edit()
    {
        return view('instructor.inicio.perfilinst');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'documento_identidad' => 'required|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:15',
            'eps' => 'nullable|string|max:100',
            'direccion_hogar' => 'nullable|string|max:500',
        ]);

        $user->update($validated);

        return redirect()->route('perfilinst.edit')->with('success', 'Perfil actualizado correctamente.');
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'foto_documento' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Eliminar documento anterior si existe
        if ($user->foto_documento) {
            Storage::delete($user->foto_documento);
        }

        // Guardar nuevo documento
        $path = $request->file('foto_documento')->store('documentos', 'public');
        $user->foto_documento = $path;
        $user->save();

        return redirect()->route('perfilinst.edit')->with('success', 'Documento subido correctamente.');
    }

 public function uploadLogo(Request $request)
{
    $user = Auth::user();

    // Si se pidió eliminar la foto
    if ($request->has('remove_profile_image')) {
        if ($user->foto_perfil && \Storage::exists('public/' . $user->foto_perfil)) {
            \Storage::delete('public/' . $user->foto_perfil);
        }
        $user->foto_perfil = null;
        $user->save();

        return back()->with('success', 'Imagen eliminada. Se usará el avatar por defecto.');
    }

    // Si se sube nueva imagen
    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('perfiles', 'public');
        $user->foto_perfil = $path;
        $user->save();

        return back()->with('success', 'Imagen actualizada correctamente.');
    }

    return back()->with('warning', 'No se subió ninguna imagen.');
}
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('perfilinst.edit')->with('success', 'Contraseña cambiada correctamente.');
    }
}

