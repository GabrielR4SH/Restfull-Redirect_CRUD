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
    

    public function createRedirect(array $data)
    {
        return Redirect::create($data);
    }

    public function updateRedirect($id, array $data)
    {
        $redirect = Redirect::findOrFail($id);
        $redirect->update($data);
    }

    public function deleteRedirect($id)
    {
        $redirect = Redirect::findOrFail($id);
        $redirect->delete();
    }

    public function hashids_demo($id)
    {
        $this->id = 23234;
        $hs = new Hashids();

        $this->id = $hs->encode($id);

        dd($this->id);
    }
}
