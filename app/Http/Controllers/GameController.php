<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 

class GameController extends Controller
{
    public function index()
    {
        // 1. Ambil API Key dari .env
        $apiKey = env('RAWG_API_KEY');

        // 2. Tembak API RAWG
        $response = Http::get("https://api.rawg.io/api/games", [
            'key' => $apiKey,
            'page_size' => 12,
            'ordering' => '-added' 
        ]);

        // 3. Cek jika API berhasil dihubungi
        if ($response->successful()) {
            $games = $response->json()['results'];
        } else {
            $games = []; 
        }

        // 4. Kirim data ke tampilan 
        return view('games.index', ['games' => $games]);
    }
}