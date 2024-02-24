<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Redirect extends Model
{
    use \Vinkla\Hashids\HasHashid; //HashId Implementado na model

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function getCodeAttribute()
    {
        return $this->hashid;
    }
}
