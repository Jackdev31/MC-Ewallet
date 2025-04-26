<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ewallet extends Model
{

    protected $fillable = [
        'user_id',  // assuming you have a relation to user
        'balance',
    ];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
