<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $card->name }}'s Business Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #bizCard {
            padding-top: 40px;
            width: 700px;
            height: 300px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            position: relative;
            border-radius: 8px;
        }
        
        #bizCard:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
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
        
        .footer {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Digital Business Card</h3>
                    </div>
                    <div class="card-body">
                        <div id="bizCard">
                            <h2 id="name">{{ $card->name }}</h2>
                            <h3 id="title">{{ $card->title }}</h3>
                            <br>
                            <h4 id="address">{{ $card->address }}</h4>
                            <h4 id="phone">{{ $card->phone }}</h4>
                            <h4 id="email">{{ $card->email }}</h4>
                        </div>
                        
                        <div class="footer">
                            <p>Created with Digital Card Maker</p>
                            <a href="{{ url('/') }}" class="btn btn-primary">Create Your Own Card</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>