<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $primaryKey = 'games_id';
    public $timestamps = false;

    protected $fillable = [
        'nama_games',
        'gambar',
        'status'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'games_id', 'games_id');
    }
}