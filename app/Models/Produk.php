<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'produk_id';
    public $timestamps = false;
    protected $guarded = [];

    public function game()
    {
        return $this->belongsTo(Game::class, 'games_id', 'games_id');
    }
}
