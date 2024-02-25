<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Redirect extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'url_destino', 'code', 'ativo', 'last_access'
    ];
    protected $dates = ['deleted_at'];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function getCodeAttribute()
    {
        return $this->attributes['code'];

    }
}
