<?php

namespace App\Services;

use App\Models\Redirect;

class RedirectService
{
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
}
