@extends('layouts.card-layout')

@section('title', 'Edit Business Card')

@section('additional_styles')
<link rel="stylesheet" href="{{ asset('css/layout-emerald-theme.css') }}">
<style>
    .progress-container {
        margin: 30px 0;
    }
    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 30px;
    }
    .progress-steps::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #e0e0e0;
        transform: translateY(-50%);
        z-index: 0;
    }
    .card-preview {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 600px;
    }
    .business-card {
        width: 600px;
        height: 360px;
        background-color: #000;
        border-radius: 10px;
        color: #ffffff;
        padding: 20px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    
    .background-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #000;
        opacity: 0;
        z-index: 1;
        pointer-events: none;
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
    }
    .card-style-option {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
        border: 2px solid transparent;
    }
    .card-style-option.selected {
        border-color: #ff6347;
    }
    .card-layout-option {
        width: 60px;
        height: 40px;
        border: 1px solid #ddd;
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
        background-color: #fff;
    }
    .card-layout-option.selected {
        border-color: #ff6347;
        background-color: #fff5f3;
    }
    .next-btn {
        background-color: #ff6347;
        border: none;
        padding: 12px 0;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        width: 100%;
        margin-top: 20px;
    }
    .next-btn:hover {
        background-color: #ff4c2b;
    }

    /* Color picker styling */
    #colorPicker, #textColorPicker {
        width: 40px;
        height: 40px;
        padding: 0;
        border: none;
        cursor: pointer;
    }
    
    #hexValue, #textHexValue {
        font-family: monospace;
        font-size: 14px;
        margin-left: 10px;
    }
    .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
    }
    
    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="hero-section position-relative overflow-hidden">
    <div class="container-fluid px-4 py-5 hero-img">
        <div class="row">
            <div class="col-md-12">
                <div class="progress-container">
                    <div class="progress-steps">
                        <div class="progress-step active">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card-preview">
                    <div class="business-card">
                        <h4 class="cardNameDisplay">{{ old('name', $card->name) }}</h4>
                        <p class="cardTitleDisplay">{{ old('title', $card->title) }}</p>
                        <p class="cardAddressDisplay">{{ old('address', $card->address) }}</p>
                        <p class="cardPhoneDisplay">{{ old('phone', $card->phone) }}</p>
                        <p class="cardEmailDisplay">{{ old('email', $card->email) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Edit your card</h2>
                <div class="card-option mt-4">
                    <div class="mt-3">
                        <p class="mb-1"><strong>Card Colors</strong></p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <label class="me-2">Background Color</label>
                                    <input type="color" class="form-control form-control-color me-2" id="colorPicker" value="#{{ $card->background_color ?? '000000' }}" title="Choose your card background color">
                                    <span id="hexValue">#{{ $card->background_color ?? '000000' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <label class="me-2">Text Color</label>
                                    <input type="color" class="form-control form-control-color me-2" id="textColorPicker" value="#{{ $card->text_color ?? 'ffffff' }}" title="Choose your card text color">
                                    <span id="textHexValue">#{{ $card->text_color ?? 'ffffff' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-option mt-4">
                    <div class="mt-3">
                        <p class="mb-1"><strong>Text Alignment</strong></p>
                        <div class="btn-group w-100 mb-3" role="group" aria-label="Text alignment">
                            <button type="button" class="btn btn-outline-secondary text-align-btn {{ $card->text_align == 'left' ? 'active' : '' }}" data-align="left">
                                <i class="bi bi-text-left"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary text-align-btn {{ $card->text_align == 'center' || !$card->text_align ? 'active' : '' }}" data-align="center">
                                <i class="bi bi-text-center"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary text-align-btn {{ $card->text_align == 'right' ? 'active' : '' }}" data-align="right">
                                <i class="bi bi-text-right"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary text-align-btn {{ $card->text_align == 'justify' ? 'active' : '' }}" data-align="justify">
                                <i class="bi bi-justify"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-option mt-4">
                    <div class="mt-3">
                        <p class="mb-1"><strong>Custom Background Image</strong></p>
                        <div class="mb-3">
                            <div role="uploadcare-uploader"></div>
                        </div>
                        <div class="mb-3">
                            <label for="imageOpacity" class="form-label">Background Opacity: <span id="opacityValue">{{ $card->background_opacity ?? '100' }}%</span></label>
                            <input type="range" class="form-range" id="imageOpacity" min="0" max="100" value="{{ $card->background_opacity ?? '100' }}">
                        </div>
                        <div class="mb-3">
                            <label for="imageZoom" class="form-label">Background Size: <span id="zoomValue">{{ $card->background_zoom ?? '100' }}%</span></label>
                            <input type="range" class="form-range" id="imageZoom" min="50" max="200" value="{{ $card->background_zoom ?? '100' }}">
                        </div>
                        <div class="mb-3">
                            <label for="imagePositionX" class="form-label">Horizontal Position: <span id="positionXValue">{{ $card->background_position_x ?? '50' }}%</span></label>
                            <input type="range" class="form-range" id="imagePositionX" min="0" max="100" value="{{ $card->background_position_x ?? '50' }}">
                        </div>
                        <div class="mb-3">
                            <label for="imagePositionY" class="form-label">Vertical Position: <span id="positionYValue">{{ $card->background_position_y ?? '50' }}%</span></label>
                            <input type="range" class="form-range" id="imagePositionY" min="0" max="100" value="{{ $card->background_position_y ?? '50' }}">
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('cards.update', $card->id) }}" id="cardForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="background_color" id="backgroundColorInput" value="{{ $card->background_color ?? '000000' }}">
                    <input type="hidden" name="background_opacity" id="backgroundOpacityInput" value="{{ $card->background_opacity ?? '100' }}">
                    <input type="hidden" name="background_zoom" id="backgroundZoomInput" value="{{ $card->background_zoom ?? '100' }}">
                    <input type="hidden" name="background_position_x" id="backgroundPositionXInput" value="{{ $card->background_position_x ?? '50' }}">
                    <input type="hidden" name="background_position_y" id="backgroundPositionYInput" value="{{ $card->background_position_y ?? '50' }}">
                    <input type="hidden" name="text_align" id="textAlignInput" value="{{ $card->text_align ?? 'center' }}">
                    <input type="hidden" name="text_color" id="textColorInput" value="{{ $card->text_color ?? 'ffffff' }}">
                    <input type="hidden" name="background_image" id="background_image" value="{{ $card->background_image ?? '' }}">
                    
                    <div class="form-fields">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $card->name) }}" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $card->title) }}" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $card->address) }}" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $card->phone) }}" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $card->email) }}" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="next-btn" id="nextBtn">Update Card</button>
                </form>
            </div>
        </div>
        @endsection

        @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Card color selection
                const colorPicker = document.getElementById('colorPicker');
                const hexValue = document.getElementById('hexValue');
                const textColorPicker = document.getElementById('textColorPicker');
                const textHexValue = document.getElementById('textHexValue');
                const backgroundColorInput = document.getElementById('backgroundColorInput');
                const businessCard = document.querySelector('.business-card');
                const textColorInput = document.getElementById('textColorInput');
                
                // Set initial card colors
                businessCard.style.backgroundColor = colorPicker.value;
                businessCard.style.color = textColorPicker.value;
                
                // Update card background color when picker changes
                colorPicker.addEventListener('input', function() {
                    const selectedColor = this.value;
                    hexValue.textContent = selectedColor;
                    businessCard.style.backgroundColor = selectedColor;
                    backgroundColorInput.value = selectedColor.substring(1); // Remove # for storage
                });
                
                // Update text color when text picker changes
                textColorPicker.addEventListener('input', function() {
                    const selectedColor = this.value;
                    textHexValue.textContent = selectedColor;
                    businessCard.style.color = selectedColor;
                    textColorInput.value = selectedColor.substring(1); // Remove # for storage
                });
                
                // Background image and opacity controls
                const opacitySlider = document.getElementById('imageOpacity');
                const opacityValue = document.getElementById('opacityValue');
                const backgroundOpacityInput = document.getElementById('backgroundOpacityInput');
                
                // Zoom controls
                const zoomSlider = document.getElementById('imageZoom');
                const zoomValue = document.getElementById('zoomValue');
                const backgroundZoomInput = document.getElementById('backgroundZoomInput');
                
                // Create a background image container for opacity control
                const backgroundImageContainer = document.createElement('div');
                backgroundImageContainer.classList.add('background-image-container');
                businessCard.insertBefore(backgroundImageContainer, businessCard.firstChild);

                // Text alignment controls
                const textAlignBtns = document.querySelectorAll('.text-align-btn');
                const textAlignInput = document.getElementById('textAlignInput');
                
                textAlignBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        // Remove active class from all buttons
                        textAlignBtns.forEach(b => b.classList.remove('active'));
                        // Add active class to clicked button
                        this.classList.add('active');
                        
                        const alignment = this.getAttribute('data-align');
                        textAlignInput.value = alignment;
                        
                        // Apply text alignment to card content
                        const textElements = businessCard.querySelectorAll('h4, p');
                        textElements.forEach(el => {
                            el.style.textAlign = alignment;
                        });
                    });
                });
                
                // Initialize text alignment
                const initialAlignment = textAlignInput.value;
                const textElements = businessCard.querySelectorAll('h4, p');
                textElements.forEach(el => {
                    el.style.textAlign = initialAlignment;
                });

                // Live preview updates for form fields
                const nameInput = document.getElementById('name');
                const titleInput = document.getElementById('title');
                const addressInput = document.getElementById('address');
                const phoneInput = document.getElementById('phone');
                const emailInput = document.getElementById('email');
                
                const nameDisplay = document.querySelector('.cardNameDisplay');
                const titleDisplay = document.querySelector('.cardTitleDisplay');
                const addressDisplay = document.querySelector('.cardAddressDisplay');
                const phoneDisplay = document.querySelector('.cardPhoneDisplay');
                const emailDisplay = document.querySelector('.cardEmailDisplay');
                
                // Update preview when input changes
                nameInput.addEventListener('input', function() {
                    nameDisplay.textContent = this.value;
                });
                
                titleInput.addEventListener('input', function() {
                    titleDisplay.textContent = this.value;
                });
                
                addressInput.addEventListener('input', function() {
                    addressDisplay.textContent = this.value;
                });
                
                phoneInput.addEventListener('input', function() {
                    phoneDisplay.textContent = this.value;
                });
                
                emailInput.addEventListener('input', function() {
                    emailDisplay.textContent = this.value;
                });

                // Uploadcare widget integration
                UPLOADCARE_PUBLIC_KEY = "{{ config('services.uploadcare.public_key') }}";
                const widget = uploadcare.SingleWidget('[role="uploadcare-uploader"]');
                
                widget.onChange(function(file) {
                    if (file) {
                        file.done(info => {
                            const uuid = info.uuid;
                            document.getElementById('background_image').value = uuid;
                            
                            // Update preview with Uploadcare CDN URL
                            const previewUrl = `https://ucarecdn.com/${uuid}/-/preview/`;
                            backgroundImageContainer.style.backgroundImage = `url('${previewUrl}')`;
                            backgroundImageContainer.style.display = 'block';
                            
                            // Apply current opacity and zoom settings
                            updateOpacity(opacitySlider.value);
                            updateZoom(zoomSlider.value);
                        });
                    }
                    else {
                        // Clear preview when image is removed
                        backgroundImageContainer.style.backgroundImage = '';
                        backgroundImageContainer.style.display = 'none';
                    }
                });

                // Handle opacity slider
                opacitySlider.addEventListener('input', function() {
                    updateOpacity(this.value);
                });
                
                // Handle zoom slider
                zoomSlider.addEventListener('input', function() {
                    updateZoom(this.value);
                });
                
                // Position X slider
                const positionXSlider = document.getElementById('imagePositionX');
                const positionXValue = document.getElementById('positionXValue');
                const backgroundPositionXInput = document.getElementById('backgroundPositionXInput');
                
                positionXSlider.addEventListener('input', function() {
                    const value = this.value;
                    positionXValue.textContent = value + '%';
                    backgroundPositionXInput.value = value;
                    backgroundImageContainer.style.backgroundPositionX = value + '%';
                });
                
                // Position Y slider
                const positionYSlider = document.getElementById('imagePositionY');
                const positionYValue = document.getElementById('positionYValue');
                const backgroundPositionYInput = document.getElementById('backgroundPositionYInput');
                
                positionYSlider.addEventListener('input', function() {
                    const value = this.value;
                    positionYValue.textContent = value + '%';
                    backgroundPositionYInput.value = value;
                    backgroundImageContainer.style.backgroundPositionY = value + '%';
                });
                
                // Helper functions
                function updateOpacity(value) {
                    opacityValue.textContent = value + '%';
                    backgroundOpacityInput.value = value;
                    backgroundImageContainer.style.opacity = value / 100;
                }
                
                function updateZoom(value) {
                    zoomValue.textContent = value + '%';
                    backgroundZoomInput.value = value;
                    backgroundImageContainer.style.backgroundSize = value + '%';
                }
                
                // Initialize background image if it exists
                if ('{{ $card->background_image }}') {
                    backgroundImageContainer.style.backgroundImage = `url('https://ucarecdn.com/{{ $card->background_image }}/-/preview/')`;
                    backgroundImageContainer.style.display = 'block';
                    backgroundImageContainer.style.opacity = {{ ($card->background_opacity ?? 100) / 100 }};
                    backgroundImageContainer.style.backgroundSize = '{{ $card->background_zoom ?? 100 }}%';
                    backgroundImageContainer.style.backgroundPositionX = '{{ $card->background_position_x ?? 50 }}%';
                    backgroundImageContainer.style.backgroundPositionY = '{{ $card->background_position_y ?? 50 }}%';
                }
            });
        </script>
        @endsection