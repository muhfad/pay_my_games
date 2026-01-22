<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\Game;
use App\Models\User;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'orders_id';
    public $timestamps = false;

    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'games_id', 'games_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
