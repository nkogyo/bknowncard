<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $bizMakerTitle }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}" media="screen">

    <style media="screen">
    #bizCard {
      padding-top: 40px;
      width: 700px;
      height: 300px;
      margin: 0 auto;
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      margin-bottom: 30px;
    }

    #name {
      color: #212529;
      text-align: center;
      font-weight: 600;
    }

    #title {
      color: #6c757d;
      text-align: center;
    }

    #address, #phone, #email {
      color: #6c757d;
      text-align: center;
    }

    .card {
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      max-width: 300px;
      margin: 0 auto;
      margin-bottom: 30px;
    }

    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .card-container {
      padding: 16px;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">{{ $bizMakerTitle }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Business Card Display -->
                <div id="bizCard">
                    <h2 id="name">{{ $name }}</h2>
                    <h3 id="title">{{ $title }}</h3>
                    <br>
                    <h4 id="address">{{ $address }}</h4>
                    <h4 id="phone">{{ $phone }}</h4>
                    <h4 id="email">{{ $email }}</h4>
                </div>

                <!-- Card Preview -->
                <div class="card">
                    <img src="{{ asset('images/img_avatar.png') }}" alt="Avatar" class="card-img-top">
                    <div class="card-container">
                        <h4 class="card-title"><b>{{ $name }}</b></h4>
                        <p class="card-text">{{ $title }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>