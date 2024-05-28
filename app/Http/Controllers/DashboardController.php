<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Cliente;

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
}