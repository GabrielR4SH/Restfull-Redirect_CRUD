<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use Illuminate\Http\Request;
use App\Services\RedirectService;

class RedirectController extends Controller
{
    protected $redirectService;

    public function __construct(RedirectService $redirectService)
    {
        $this->redirectService = $redirectService;
    }

    // Métodos para interação com as views no frontend (rotas web)
    public function webIndex()
    {
        $redirects = Redirect::all();
        return view('redirects.index', compact('redirects'));
    }

    public function create()
    {
        //
    }

    public function edit($id)
    {
        //
    }

    // Métodos para interação com a API (rotas api)
    public function index()
    {
        $redirects = Redirect::all();
    
        return response()->json($redirects);
    }

    public function show($id)
    {
        $redirect = Redirect::findOrFail($id);
        return response()->json($redirect);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'url_destino' => 'required|string',
            'ativo' => 'required|boolean',
        ]);

        $this->redirectService->createRedirect($validatedData);

        return response()->json(['message' => 'Redirect created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'url_destino' => 'required|string',
            'ativo' => 'required|boolean',
        ]);

        $this->redirectService->updateRedirect($id, $validatedData);

        return response()->json(['message' => 'Redirect updated successfully'], 200);
    }

    public function destroy($id)
    {
        $this->redirectService->deleteRedirect($id);

        return response()->json(['message' => 'Redirect deleted successfully'], 204);
    }
}
