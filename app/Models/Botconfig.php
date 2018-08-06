<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Botconfig extends Model
{
     protected $table = 'botconfig';
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token', 'user_id', 'currency', 'webhook',
    ];
    
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
