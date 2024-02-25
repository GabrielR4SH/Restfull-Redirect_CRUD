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


    public function update(Request $request, $code)
    {
        return $this->redirectService->update($request, $code);
    }

    public function destroy($id)
    {
        return $this->redirectService->destroy($id);
    }
}
