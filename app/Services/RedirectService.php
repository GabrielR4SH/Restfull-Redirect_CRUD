<?php

namespace App\Services;

use App\Models\Redirect;
use Hashids\Hashids;

class RedirectService
{

    public function index()
    {
        $redirects = Redirect::all();

        foreach ($redirects as $redirect) {
            $redirect->id = $redirect->code;
            unset($redirect->id); // Removi o atributo ID pra não vim no JSON
        }

        return response()->json($redirects, 200);
    }

    public function store($request)
    {
        $hashids = new Hashids();
        $code = $hashids->encode(time());

        $redirect = Redirect::create([
            'url_destino' => $request->url_destino,
            'code' => $code,
        ]);

        return response()->json($redirect, 201);
    }
    
}
