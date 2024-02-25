<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use App\Http\Requests\CreateRedirectRequest;

class RedirectController extends Controller
{
    public function index()
    {
        $redirects = Redirect::all();
        return view('redirects.index', compact('redirects'));
    }

    public function show(Redirect $redirect)
    {
        return $redirect;
    }

    public function store(CreateRedirectRequest $request)
    {
        $redirect = Redirect::create([
            'url' => $request->input('url'),
        ]);

        return response()->json($redirect, 201);
    }


    public function update(CreateRedirectRequest $request, Redirect $redirect)
    {
        $redirect->update([
            'url' => $request->input('url'),
        ]);

        return response()->json($redirect, 200);
    }

    public function destroy(Redirect $redirect)
    {
        $redirect->delete();

        return response()->json(null, 204);
    }
}

