<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrenador;
use Illuminate\Support\Facades\Storage;


class EntrenadorController extends Controller
{
    // Mostrar una lista de entrenadores
    public function index()
    {
        $entrenadores = Entrenador::all();
        return view('entrenadores.index', compact('entrenadores'));
    }

    // Mostrar el formulario para crear un nuevo entrenador
    public function create()
    {
        return view('entrenadores.create');
    }

    // Almacenar un nuevo entrenador
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:entrenadores',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
            'fecha_nacimiento' => 'required|date',
            'dni' => 'required|unique:entrenadores',
            'foto_perfil' => 'nullable|image|max:2048',
        ]);

        $entrenador = new Entrenador($request->all());

        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('public/fotos_entrenadores');
            $entrenador->foto_perfil = Storage::url($path);
        }

        $entrenador->save();

        return redirect()->route('entrenadores.index')->with('success', 'Entrenador creado exitosamente.');
    }

    // Mostrar un entrenador específico
    public function show($id)
    {
        $entrenador = Entrenador::findOrFail($id);
        return view('entrenadores.show', compact('entrenador'));
    }

    // Mostrar el formulario para editar un entrenador
    public function edit($id)
    {
        $entrenador = Entrenador::find($id);
        return view('entrenadores.edit', compact('entrenador'));
    }

    // Actualizar un entrenador específico
    public function update(Request $request, $id)
{
    $entrenador = Entrenador::find($id);

    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:entrenadores,email,' . $entrenador->id,
        'telefono' => 'nullable|string|max:255',
        'direccion' => 'nullable|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'dni' => 'required|string|max:255|unique:entrenadores,dni,' . $entrenador->id,
        'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto_perfil')) {
        $imageName = time().'.'.$request->foto_perfil->extension();
        $request->foto_perfil->move(public_path('images'), $imageName);
        $data['foto_perfil'] = 'images/' . $imageName;
    }

    $entrenador->update($data);

    return redirect()->route('entrenadores.index')->with('success', 'Entrenador actualizado exitosamente');
}

    // Eliminar un entrenador específico
    public function destroy($id)
    {
        $entrenador = Entrenador::findOrFail($id);
        $entrenador->delete();

        return redirect()->route('entrenadores.index')->with('success', 'Entrenador eliminado correctamente');
    }
}