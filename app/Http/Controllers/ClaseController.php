<?php
// app/Http/Controllers/ClaseController.php
namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\Request;

class ClaseController extends Controller
{
    public function index()
    {
        $clases = Clase::all();
        return view('clases.index', compact('clases'));
    }

    public function create()
    {
        return view('clases.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'horario' => 'required',
        ]);

        Clase::create($request->all());
        return redirect()->route('clases.index')->with('success', 'Clase creada correctamente.');
    }

    public function show(Clase $clase)
    {
        return view('clases.show', compact('clase'));
    }

    public function edit(Clase $clase)
    {
        return view('clases.edit', compact('clase'));
    }

    public function update(Request $request, Clase $clase)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'horario' => 'required',
        ]);

        $clase->update($request->all());
        return redirect()->route('clases.index')->with('success', 'Clase actualizada correctamente.');
    }

    public function destroy(Clase $clase)
    {
        $clase->delete();
        return redirect()->route('clases.index')->with('success', 'Clase eliminada correctamente.');
    }
}
