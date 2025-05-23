<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $card->name }}'s Business Card - Digital Card Maker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-preview {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 400px;
            margin-bottom: 20px;
        }
        
        .business-card {
            width: 600px;
            height: 360px;
            background-color: #{{ $card->background_color ?? '000000' }};
            color: #{{ $card->text_color ?? 'ffffff' }};
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
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
            opacity: {{ ($card->background_opacity ?? 100) / 100 }};
            @if($card->background_image)
                background-image: url('https://ucarecdn.com/{{ $card->background_image }}/-/preview/');
                background-size: {{ $card->background_zoom ?? 100 }}%;
                background-position-x: {{ $card->background_position_x ?? 50 }}%;
                background-position-y: {{ $card->background_position_y ?? 50 }}%;
                display: block;
            @else
                display: none;
            @endif
        }
        
        .business-card h4,
        .business-card p {
            position: relative;
            z-index: 2;
            margin-bottom: 10px;
            text-align: {{ $card->text_align ?? 'center' }};
        }
        
        .qr-container {
            margin-top: 30px;
            text-align: center;
        }
        
        .share-link {
            margin-top: 15px;
            text-align: center;
        }
        
        .action-buttons {
            margin-top: 20px;
            text-align: center;
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
                        <a class="nav-link" href="{{ route('cards.index') }}">My Cards</a>
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
                        <span>Business Card Preview</span>
                        <div>
                            <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form method="POST" action="{{ route('cards.destroy', $card->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this card?')">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-preview">
                            <div class="business-card" style="background-color: #{{ $card->background_color }}; color: #{{ $card->text_color }};">
                                <div class="background-image-container"></div>
                                <h4>{{ $card->name }}</h4>
                                <p>{{ $card->title }}</p>
                                <p>{{ $card->address }}</p>
                                <p>{{ $card->phone }}</p>
                                <p>{{ $card->email }}</p>
                            </div>
                        </div>
                        
                        <div class="qr-container">
                            <h5>QR Code</h5>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($card->share_url) }}" alt="QR Code">
                        </div>
                        
                        <div class="share-link">
                            <h4>Share Link</h4>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ $card->share_url }}" id="shareUrl" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="copyShareUrl()">Copy</button>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <a href="{{ $card->share_url }}" target="_blank" class="btn btn-success">View Public Card</a>
                            <button onclick="exportAsImage()" class="btn btn-primary">Export as Image</button>
                            <a href="{{ route('cards.index') }}" class="btn btn-secondary">Back to My Cards</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script>
        function copyShareUrl() {
            var copyText = document.getElementById("shareUrl");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            alert("Share link copied to clipboard!");
        }
        
        // Add export image functionality
        function exportAsImage() {
            const cardElement = document.querySelector('.business-card');
            
            // Show loading message
            const loadingMsg = document.createElement('div');
            loadingMsg.textContent = 'Generating image...';
            loadingMsg.style.position = 'fixed';
            loadingMsg.style.top = '50%';
            loadingMsg.style.left = '50%';
            loadingMsg.style.transform = 'translate(-50%, -50%)';
            loadingMsg.style.padding = '10px 20px';
            loadingMsg.style.background = 'rgba(0,0,0,0.7)';
            loadingMsg.style.color = 'white';
            loadingMsg.style.borderRadius = '5px';
            loadingMsg.style.zIndex = '9999';
            document.body.appendChild(loadingMsg);
            
            // Use setTimeout to allow the loading message to render
            setTimeout(() => {
                html2canvas(cardElement, {
                    scale: 2, // Higher quality
                    backgroundColor: null,
                    logging: false,
                    useCORS: true,
                    allowTaint: true
                }).then(canvas => {
                    // Remove loading message
                    document.body.removeChild(loadingMsg);
                    
                    // Create download link
                    const link = document.createElement('a');
                    link.download = 'business-card-{{ $card->unique_id }}.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                }).catch(error => {
                    console.error('Error generating image:', error);
                    document.body.removeChild(loadingMsg);
                    alert('Failed to generate image. Please try again.');
                });
            }, 100);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>