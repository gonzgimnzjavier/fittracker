<?php
// app/Http/Controllers/ClienteController.php
namespace App\Http\Controllers;

use App\Models\Cliente;
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
        return view('clientes.create');
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
        ]);

        $data = $request->all();
        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('public/perfiles');
            $data['foto_perfil'] = Storage::url($path);
        }

        Cliente::create($data);
        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
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
        ]);

        $data = $request->all();
        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('public/perfiles');
            $data['foto_perfil'] = Storage::url($path);
            // Eliminar la foto anterior si existe
            if ($cliente->foto_perfil) {
                Storage::delete(str_replace('/storage', 'public', $cliente->foto_perfil));
            }
        }

        $cliente->update($data);
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
