<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of games
     */
    public function index()
    {
        $games = Game::orderBy('games_id', 'desc')->get();
        return view('admin.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new game
     */
    public function create()
    {
        return view('admin.games.create');
    }

    /**
     * Store a newly created game
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_games' => 'required|string|max:100',
            'status' => 'required|in:aktif,nonaktif',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'nama_games' => $request->nama_games,
            'status' => $request->status
        ];

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/games', $imageName);
            $data['gambar'] = $imageName;
        }

        Game::create($data);

        return redirect('/admin/games')->with('success', 'Game berhasil ditambahkan!');
    }

    /**
     * Show the form for editing game
     */
    public function edit($id)
    {
        $game = Game::where('games_id', $id)->firstOrFail();
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Update the specified game
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_games' => 'required|string|max:100',
            'status' => 'required|in:aktif,nonaktif',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $game = Game::where('games_id', $id)->firstOrFail();

        $data = [
            'nama_games' => $request->nama_games,
            'status' => $request->status
        ];

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($game->gambar && Storage::exists('public/games/' . $game->gambar)) {
                Storage::delete('public/games/' . $game->gambar);
            }

            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/games', $imageName);
            $data['gambar'] = $imageName;
        }

        $game->update($data);

        return redirect('/admin/games')->with('success', 'Game berhasil diupdate!');
    }

    /**
     * Remove the specified game
     */
    public function destroy($id)
    {
        $game = Game::where('games_id', $id)->firstOrFail();

        // Delete image if exists
        if ($game->gambar && Storage::exists('public/games/' . $game->gambar)) {
            Storage::delete('public/games/' . $game->gambar);
        }

        $game->delete();

        return redirect('/admin/games')->with('success', 'Game berhasil dihapus!');
    }
}