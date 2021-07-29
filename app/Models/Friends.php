<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'player_name',
    ];

    public function container() {
        return $this->belongsTo('App\Models\Friends', 'player_name', 'id');
    }
}
