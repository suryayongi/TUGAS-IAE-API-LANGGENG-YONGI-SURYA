<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    public function index()
    {
        $apiKey = env('RAWG_API_KEY');

        $response = Http::get("https://api.rawg.io/api/games", [
            'key' => $apiKey,
            'page_size' => 12,
            'ordering' => '-added'
        ]);

        if ($response->successful()) {
            $games = $response->json()['results'];
        } else {
            $games = [];
        }

        return view('games.index', ['games' => $games]);
    }
    public function indexApi()
    {
        // 1. Ambil API Key
        $apiKey = env('RAWG_API_KEY');

        // 2. Tembak API RAWG
        $response = Http::get("https://api.rawg.io/api/games", [
            'key' => $apiKey,
            'page_size' => 10,
            'ordering' => '-added'
        ]);

        // 3. Cek respons
        if ($response->successful()) {
            $games = $response->json()['results'];
            $formattedGames = collect($games)->map(function ($game) {
                return [
                    'judul_game' => $game['name'],
                    'rating' => $game['rating'],
                    'tanggal_rilis' => $game['released'],
                    'gambar' => $game['background_image'],
                    'sumber_data' => 'RAWG API via Langgeng Server'
                ];
            });

            // 5. Kembalikan dalam bentuk JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Data game berhasil diambil',
                'total_data' => count($formattedGames),
                'data' => $formattedGames
            ], 200);

        } else {
            // kalo misal gagal
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data dari RAWG'
            ], 500);
        }
    }
}