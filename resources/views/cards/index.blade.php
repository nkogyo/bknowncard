<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Business Cards - Digital Card Maker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .business-card {
            width: 100%;
            height: 200px;
            border-radius: 10px;
            color: #ffffff;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.19), 0 2px 2px rgba(0,0,0,0.23);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .background-image-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 0;
        }
        
        .business-card h5,
        .business-card h6,
        .business-card p {
            position: relative;
            z-index: 2;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Digital Card Maker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('cards.index') }}">My Cards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cards.create') }}">Create Card</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <span class="navbar-text me-3">
                        Welcome, {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>My Business Cards</span>
                        <a href="{{ route('cards.create') }}" class="btn btn-primary">Create New Card</a>
                    </div>
                    <div class="card-body">
                        @if($cards->isEmpty())
                            <div class="alert alert-info">
                                You haven't created any business cards yet. <a href="{{ route('cards.create') }}">Create your first card</a>.
                            </div>
                        @else
                            <div class="row">
                                @foreach($cards as $card)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body p-0">
                                                <div class="business-card" style="background-color: #{{ $card->background_color ?? '000000' }}; color: #{{ $card->text_color ?? 'ffffff' }};">
                                                    @if($card->background_image)
                                                        <div class="background-image-container" style="
                                                            background-image: url('https://ucarecdn.com/{{ $card->background_image }}/-/preview/');
                                                            background-size: {{ $card->background_zoom ?? 100 }}%;
                                                            opacity: {{ ($card->background_opacity ?? 100) / 100 }};
                                                            display: block;
                                                        "></div>
                                                    @endif
                                                    <h5 class="card-title">{{ $card->name }}</h5>
                                                    <h6 class="card-subtitle mb-2">{{ $card->title }}</h6>
                                                    <p class="card-text">
                                                        {{ $card->email }}<br>
                                                        {{ $card->phone }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="{{ route('cards.show', $card->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                                <form method="POST" action="{{ route('cards.destroy', $card->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>