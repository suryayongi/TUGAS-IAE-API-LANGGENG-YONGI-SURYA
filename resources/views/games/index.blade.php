<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Game - Tugas IAE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .rating-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0,0,0,0.7);
            color: #ffc107;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-dark text-light">

    <nav class="navbar navbar-dark bg-secondary mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Tugas Integrasi Aplikasi Enterprise Impelementasi API LANGGENG YONGI SURYA</span>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4 text-center">Daftar Game Populer (RAWG API)</h2>

        <div class="row">
            @forelse ($games as $game)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 bg-secondary text-white border-0 shadow">
                        <div class="position-relative">
                            <img src="{{ $game['background_image'] }}" class="card-img-top" alt="{{ $game['name'] }}">
                            <span class="rating-badge">★ {{ $game['rating'] }}</span>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $game['name'] }}</h5>
                            <p class="card-text small mb-1">Rilis: {{ $game['released'] }}</p>
                            
                            <div class="mt-2">
                                @foreach(array_slice($game['genres'], 0, 3) as $genre)
                                    <span class="badge bg-dark">{{ $genre['name'] }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="alert alert-danger">Gagal memuat data game. Cek koneksi internet atau API Key.</p>
                </div>
            @endforelse
        </div>
    </div>

    <footer class="text-center py-4 text-muted mt-5">
        <small>Dibuat dengan Laravel & RAWG API</small>
    </footer>

</body>
</html>