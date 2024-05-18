<?php
// app/Http/Controllers/EntrenadorController.php
namespace App\Http\Controllers;

use App\Models\Entrenador;
use Illuminate\Http\Request;

class EntrenadorController extends Controller
{
    public function index()
    {
        $entrenadores = Entrenador::all();
        return view('entrenadores.index', compact('entrenadores'));
    }

    public function create()
    {
        return view('entrenadores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'especialidad' => 'required',
            'dni' => 'required|unique:entrenadores',
        ]);

        Entrenador::create($request->all());
        return redirect()->route('entrenadores.index')->with('success', 'Entrenador creado correctamente.');
    }

    public function show(Entrenador $entrenador)
    {
        return view('entrenadores.show', compact('entrenador'));
    }

    public function edit(Entrenador $entrenador)
    {
        return view('entrenadores.edit', compact('entrenador'));
    }

    public function update(Request $request, Entrenador $entrenador)
    {
        $request->validate([
            'nombre' => 'required',
            'especialidad' => 'required',
            'dni' => 'required|unique:entrenadores,dni,' . $entrenador->id,
        ]);

        $entrenador->update($request->all());
        return redirect()->route('entrenadores.index')->with('success', 'Entrenador actualizado correctamente.');
    }

    public function destroy(Entrenador $entrenador)
    {
        $entrenador->delete();
        return redirect()->route('entrenadores.index')->with('success', 'Entrenador eliminado correctamente.');
    }
}
