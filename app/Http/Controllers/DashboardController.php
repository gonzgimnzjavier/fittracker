<?php
// DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Cliente;
use App\Models\Membresia;

class DashboardController extends Controller
{
    public function index()
    {
        $clases = Clase::all();
        return view('dashboard', compact('clases'));
    }

    public function getChartData($claseId)
    {
        $clase = Clase::withCount('clientes')->findOrFail($claseId);
        $totalClientes = Cliente::count();
        $clientesMatriculados = $clase->clientes_count;

        return response()->json([
            'totalClientes' => $totalClientes,
            'clientesMatriculados' => $clientesMatriculados,
        ]);
    }

    public function getMembresiaData()
    {
        $membresias = Membresia::withCount('clientes')->get();
        $data = $membresias->map(function($membresia) {
            return [
                'nombre' => $membresia->nombre,
                'clientes_count' => $membresia->clientes_count
            ];
        });

        return response()->json($data);
    }
}