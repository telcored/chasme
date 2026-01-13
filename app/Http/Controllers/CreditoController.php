<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Credito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:creditos')->only(['index']);
        $this->middleware('permission:creditos-crear')->only(['create', 'store']);
        $this->middleware('permission:creditos-editar')->only(['edit', 'update']);
        $this->middleware('permission:creditos-eliminar')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clientId = $request->get('client_id');
        $query = Credito::with('client')->orderBy('fecha', 'desc');

        if ($clientId) {
            $query->where('client_id', $clientId);
        }

        $creditos = $query->paginate(20);
        $clients = Client::where('active', 1)->orderBy('name')->get();

        // Calculate summary if a client is selected
        $summary = [];
        if ($clientId) {
            $totalCargos = Credito::where('client_id', $clientId)->where('tipo', 'cargo')->sum('monto');
            $totalAbonos = Credito::where('client_id', $clientId)->where('tipo', 'abono')->sum('monto');
            $summary = [
                'total_cargos' => $totalCargos,
                'total_abonos' => $totalAbonos,
                'saldo' => $totalCargos - $totalAbonos
            ];
        }

        return view('credito.index', compact('creditos', 'clients', 'summary', 'clientId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::where('active', 1)->orderBy('name')->get();
        return view('credito.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'fecha' => 'required|date',
            'glosa' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
            'tipo' => 'required|in:cargo,abono',
        ]);

        Credito::create($request->all());

        return redirect()->route('credito.index', ['client_id' => $request->client_id])
            ->with('success', 'Registro creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Credito $credito)
    {
        return view('credito.show', compact('credito'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credito $credito)
    {
        $clients = Client::where('active', 1)->orderBy('name')->get();
        return view('credito.edit', compact('credito', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Credito $credito)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'fecha' => 'required|date',
            'glosa' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
            'tipo' => 'required|in:cargo,abono',
        ]);

        $credito->update($request->all());

        return redirect()->route('credito.index', ['client_id' => $credito->client_id])
            ->with('success', 'Registro actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credito $credito)
    {
        $clientId = $credito->client_id;
        $credito->delete();

        return redirect()->route('credito.index', ['client_id' => $clientId])
            ->with('success', 'Registro eliminado exitosamente.');
    }
}
