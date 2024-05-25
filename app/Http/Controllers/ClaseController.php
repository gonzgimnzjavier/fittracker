<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Entrenador;

class ClaseController extends Controller
{
    public function index()
    {
        $clases = Clase::all();
        return view('clases.index', compact('clases'));
    }

    public function create()
    {
        $entrenadores = Entrenador::all();
        return view('clases.create', compact('entrenadores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'horario' => 'required|string|max:255',
            'entrenador_id' => 'required|exists:entrenadores,id',
        ]);

        $clase = Clase::create($request->only('nombre', 'descripcion', 'horario'));
        $clase->entrenadores()->attach($request->entrenador_id);

        return redirect()->route('clases.index')->with('success', 'Clase creada exitosamente.');
    }

    public function show($id)
    {
        $clase = Clase::with('entrenadores')->findOrFail($id);
        return view('clases.show', compact('clase'));
    }

    public function edit($id)
    {
        $clase = Clase::findOrFail($id);
        $entrenadores = Entrenador::all();
        return view('clases.edit', compact('clase', 'entrenadores'));
    }

    public function update(Request $request, $id)
    {
        $clase = Clase::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'horario' => 'required|string|max:255',
            'entrenador_id' => 'required|exists:entrenadores,id',
        ]);

        $clase->update($request->only('nombre', 'descripcion', 'horario'));
        $clase->entrenadores()->sync($request->entrenador_id);

        return redirect()->route('clases.index')->with('success', 'Clase actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $clase = Clase::findOrFail($id);
        $clase->delete();

        return redirect()->route('clases.index')->with('success', 'Clase eliminada exitosamente.');
    }
}