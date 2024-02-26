<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedirectLog extends Model
{
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
