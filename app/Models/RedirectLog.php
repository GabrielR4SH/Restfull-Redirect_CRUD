<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RedirectLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'redirect_id',
        'ip',
        'user_agent',
        'referer',
        'query_params',
        'accessed_at',
    ];

    protected $dates = ['accessed_at', 'last_access'];

    public function setLastAccessAttribute($value)
    {
        $this->attributes['last_access'] = $value;
    }

}
