<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use Illuminate\Http\Request;
use App\Services\RedirectService;
use App\Http\Requests\RedirectRequest;
use Illuminate\Foundation\Http\FormRequest;

class RedirectController extends Controller
{
    protected $redirectService;

    public function __construct(RedirectService $redirectService)
    {
        $this->redirectService = $redirectService;
    }

    // Métodos para interação com as views no frontend (rotas web)

    public function hashids_demo()
    {
        $id = 23234;
        $this->redirectService->hashids_demo($id);
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
        return $this->redirectService->index();
    }

    public function show($id)
    {
        $redirect = Redirect::findOrFail($id);
        return response()->json($redirect);
    }

    public function store(RedirectRequest $request)
    {
        return $this->redirectService->store($request);
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
