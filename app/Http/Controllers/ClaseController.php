<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Entrenador;
use App\Models\Cliente;

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
        $clase = Clase::with(['entrenadores', 'clientes'])->findOrFail($id);
        $clientes = Cliente::all(); 
        return view('clases.show', compact('clase', 'clientes'));
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

    public function asignarAlumno(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $clase = Clase::findOrFail($id);
        $cliente = Cliente::findOrFail($request->cliente_id);

        
        $membresia = $cliente->membresia;
        if ($cliente->clases()->count() >= $membresia->max_clases) {
            return redirect()->route('clases.show', $clase->id)
                ->with('error', 'El cliente ha alcanzado el número máximo de clases permitidas por su membresía.');
        }

  
        $clase->clientes()->attach($cliente->id);

        return redirect()->route('clases.show', $clase->id)->with('success', 'Alumno asignado a la clase correctamente.');
    }
}