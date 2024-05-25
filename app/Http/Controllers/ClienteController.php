<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Clase;
use App\Models\Membresia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $membresias = Membresia::all();
        $clases = Clase::all();
        return view('clientes.create', compact('membresias', 'clases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:clientes',
            'telefono' => 'required',
            'direccion' => 'required',
            'fecha_nacimiento' => 'required|date',
            'dni' => 'required|unique:clientes',
            'foto_perfil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'membresia_id' => 'required|exists:membresias,id',
            'clases' => 'array',
            'clases.*' => 'exists:clases,id',
        ]);

        $membresia = Membresia::findOrFail($request->membresia_id);

        if (count($request->clases) > $membresia->max_clases) {
            return redirect()->back()->withErrors(['clases' => 'El número de clases excede el permitido por la membresía seleccionada.']);
        }

        $data = $request->all();
        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('public/perfiles');
            $data['foto_perfil'] = Storage::url($path);
        }

        $cliente = Cliente::create($data);
        $cliente->clases()->attach($request->clases);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        $membresias = Membresia::all();
        $clases = Clase::all();
        return view('clientes.edit', compact('cliente', 'membresias', 'clases'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefono' => 'required',
            'direccion' => 'required',
            'fecha_nacimiento' => 'required|date',
            'dni' => 'required|unique:clientes,dni,' . $cliente->id,
            'foto_perfil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'membresia_id' => 'required|exists:membresias,id',
            'clases' => 'array',
            'clases.*' => 'exists:clases,id',
        ]);

        $membresia = Membresia::findOrFail($request->membresia_id);

        if (count($request->clases) > $membresia->max_clases) {
            return redirect()->back()->withErrors(['clases' => 'El número de clases excede el permitido por la membresía seleccionada.']);
        }

        $data = $request->all();
        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('public/perfiles');
            $data['foto_perfil'] = Storage::url($path);
            if ($cliente->foto_perfil) {
                Storage::delete(str_replace('/storage', 'public', $cliente->foto_perfil));
            }
        }

        $cliente->update($data);
        $cliente->clases()->sync($request->clases);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->foto_perfil) {
            Storage::delete(str_replace('/storage', 'public', $cliente->foto_perfil));
        }
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}