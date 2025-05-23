<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Digital Card Maker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/layout-emerald-theme.css') }}">
    <style>
        .team-member {
            text-align: center;
            margin-bottom: 20px;
        }
        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
        .team-member h5 {
            margin-bottom: 5px;
        }
        .team-member .role {
            color: #6c757d;
            font-style: italic;
            margin-bottom: 10px;
        }
        .social-icons a {
            color: #495057;
            margin: 0 5px;
            font-size: 18px;
        }
        .social-icons a:hover {
            color: #0d6efd;
        }
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
            <a class="navbar-brand" href="#">Bknown Cards</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cards.create') }}">Create Card</a>
                    </li>
                </ul>
                <div class="d-flex">
                    @auth
                        <span class="navbar-text">
                            Welcome, {{ Auth::user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main role="main">
    <!-- Hero Page with Cards Display -->
    <div class="hero-section position-relative overflow-hidden">
        <div class="container-fluid px-4 py-5 hero-img">
            <div class="row min-vh-100 align-items-center">
                <div class="col-lg-12">
                    <div class="container mt-4">
                        <div class="row mb-4">
                            <div class="col-12 text-center">
                                <h1 class="display-4 fw-bold text-white">Your <span class="text-primary">BKnown</span> Cards</h1>
                                <p class="lead text-white-50 mb-5">Manage your digital business cards collection</p>
                            </div>
                        </div>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body border-0">
                                        @if($cards->isEmpty())
                                            <div class="alert alert-info bg-dark text-white border-primary">
                                                <p class="mb-0">You haven't created any business cards yet.</p>
                                            </div>
                                        @else
                                            <div class="row">
                                                @foreach($cards as $card)
                                                    <div class="col-md-4 mb-4">
                                                        <div class="card border-0 h-100 bg-transparent">
                                                            <div class="card-body border-0 p-0">
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
                                                            <div class="card-footer border-0 bg-transparent">
                                                                <a href="{{ route('cards.show', $card->id) }}" class="btn btn-sm btn-primary">View</a>
                                                                <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-sm btn-outline-light">Edit</a>
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
                        
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <a href="{{ route('cards.create') }}" class="btn btn-primary btn-lg px-4">Create New Card</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </main>
    
    <div class="emerald-bg">

        <!-- About Us -->
            <div class="container">
                <!-- About us Text -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="lc-block mb-4">
                            <h2 editable="inline" class="display-2 mb-0"><b>About Us</b></h2>
                            <p editable="inline">Learn about the people behind the team!</p>
                        </div><!-- /lc-block -->
                    </div>
                </div>
    
                <div class="row">
    
                    <!-- Selvin -->
                    <div class="col-md-6 py-4">
                        <div class="lc-block"><img alt="" class="rounded-circle float-start me-4"
                            src="{{ asset('images/Crisostomo.jpeg') }}"  
                            style="width:10vh;" loading="lazy">
                            <div editable="rich">
                                <h5><strong>Crisostomo, Selvin A.</strong></h5>
                            </div>
    
                            <small editable="inline" class="text-secondary" style="letter-spacing:1px">Fullstack Developer</small>
    
                            <div editable="rich">
                                <p>A driven Computer Engineering student diving headfirst into the world of Web development.</p>
                            </div>
                        </div>
                    </div>
    
                    <!-- Andrei -->
                    <div class="col-md-6 py-4">
                        <div class="lc-block"><img alt="" class="rounded-circle float-start me-4" 
                            src="{{ asset('images/DeJesus..jpg') }}" 
                            style="width:10vh;" loading="lazy">
    
                            <div editable="rich">
                                <h5><strong>De Jesus, James Andrei C.</strong></h5>
                            </div>
    
                            <small editable="inline" class="text-secondary" style="letter-spacing:1px">Fullstack Developer</small>
    
                            <div editable="rich">
                                <p>A driven Computer Engineering student diving headfirst into the world of Web development.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
    
                    <!-- Erick -->
                    <div class="col-md-6 py-4">
                        <div class="lc-block"><img alt="" class="rounded-circle float-start me-4" 
                            src="{{ asset('images/Nito.jpg') }}" 
                            style="width:10vh;" loading="lazy">
                            <div editable="rich">
                                <h5><strong>Nito, Erick Jason L.</strong></h5>
                            </div>
    
                            <small editable="inline" class="text-secondary" style="letter-spacing:1px">Fullstack Developer</small>
    
                            <div editable="rich">
                                <p>A driven Computer Engineering student diving headfirst into the world of Web development.</p>
                            </div>
                        </div>
    
                    </div>
    
                    <!-- Trisha -->
                    <div class="col-md-6 py-4">
                        <div class="lc-block">
                            <img alt="" class="rounded-circle float-start me-4"
                            src="{{ asset('images/Villareal.jpg') }}" 
                            style="width:10vh;" loading="lazy">
                            <div editable="rich">
                                <h5><strong>Villareal, Trisha Mae S.</strong></h5>
                            </div>
    
                            <small editable="inline" class="text-secondary" style="letter-spacing:1px">Fullstack Developer</small>
    
                            <div editable="rich">
                                <p>A driven Computer Engineering student diving headfirst into the world of Web development.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        <!-- Footer -->
            <footer class="bg-transparent text-white py-3 mt-5"> 
                <div class="container"> 
                    <div class="row justify-content-center"> 
                        <div class="col-md-6 text-center"> 
                            <p class="mb-1">© 2025 <strong>Business Kolektibs</strong>. All rights reserved.</p> 
                            <p class="mt-1"><i>A collective of bold minds, for businesses at great heights</i></p> 
                        </div> 
                    </div> 
                </div> 
            </footer>
    
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>