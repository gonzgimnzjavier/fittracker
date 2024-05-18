<?php
// app/Http/Controllers/AsistenciaController.php
namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::all();
        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        return view('asistencias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'clase_id' => 'required|exists:clases,id',
            'fecha' => 'required|date',
        ]);

        Asistencia::create($request->all());
        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente.');
    }

    public function show(Asistencia $asistencia)
    {
        return view('asistencias.show', compact('asistencia'));
    }

    public function edit(Asistencia $asistencia)
    {
        return view('asistencias.edit', compact('asistencia'));
    }

    public function update(Request $request, Asistencia $asistencia)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'clase_id' => 'required|exists:clases,id',
            'fecha' => 'required|date',
        ]);

        $asistencia->update($request->all());
        return redirect()->route('asistencias.index')->with('success', 'Asistencia actualizada correctamente.');
    }

    public function destroy(Asistencia $asistencia)
    {
        $asistencia->delete();
        return redirect()->route('asistencias.index')->with('success', 'Asistencia eliminada correctamente.');
    }
}
