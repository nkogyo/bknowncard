@extends('layouts.card-layout')

@section('title', 'Create Business Card')

@section('additional_styles')
<link rel="stylesheet" href="{{ asset('css/layout-emerald-theme.css') }}">
<style>
    .card {
        background-color: transparent;
        border: 0;
    }
    .card-header {
        background-color: rgba(33, 37, 41, 0.8);
        color: white;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .card-body {
        background-color: rgba(33, 37, 41, 0.6);
        color: white;
    }
    .form-label {
        color: #ffffff;
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
    .form-select {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
    }
    .text-muted {
        color: rgba(255, 255, 255, 0.6) !important;
    }
    .btn-outline-secondary {
        color: white;
        border-color: rgba(255, 255, 255, 0.3);
    }
    .btn-outline-secondary:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="hero-section position-relative overflow-hidden">
    <div class="container-fluid px-4 py-5 hero-img">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="display-4 fw-bold text-white">Create Your <span class="text-primary">BKnown</span> Card</h1>
                <p class="lead text-white-50 mb-5">Design your professional digital business card</p>
            </div>
        </div>

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
            
            <div class="col-md-6 my-3">
                <!-- Card Preview -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Card Preview</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-preview">
                            <div class="business-card">
                                <h4 class="cardNameDisplay">Fullname</h4>
                                <p class="cardTitleDisplay">Job Title</p>
                                <p class="cardAddressDisplay">Address</p>
                                <p class="cardPhoneDisplay">Phone Number</p>
                                <p class="cardEmailDisplay">Email Address</p>
                                <div id="customFieldsDisplay"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Colors Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Card Colors</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <label class="me-2">Background Color</label>
                                    <input type="color" class="form-control form-control-color me-2" id="colorPicker" value="#000000" title="Choose your card background color">
                                    <span id="hexValue">#000000</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <label class="me-2">Text Color</label>
                                    <input type="color" class="form-control form-control-color me-2" id="textColorPicker" value="#ffffff" title="Choose your card text color">
                                    <span id="textHexValue">#ffffff</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>              
            </div>

            <div class="col-md-6 mt-3 mb-5">
                <!-- Card Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Card Information</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cards.store') }}" id="cardForm" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="background_opacity" id="backgroundOpacityInput" value="100">
                        <input type="hidden" name="background_zoom" id="backgroundZoomInput" value="100">
                        <input type="hidden" name="text_align" id="textAlignInput" value="center">
                        <input type="hidden" name="unique_id" id="uniqueIdInput" value="{{ old('unique_id', Str::uuid()) }}">
                        <input type="hidden" name="background_color" id="backgroundColorInput" value="000000">
                        <input type="hidden" name="text_color" id="textColorInput" value="ffffff">

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <div class="input-group">
                                
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                <div class="text-format-toolbar">
                                    <br><button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="bold" data-target="name"><i class="bi bi-type-bold"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="italic" data-target="name"><i class="bi bi-type-italic"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="underline" data-target="name"><i class="bi bi-type-underline"></i></button>
                                    <select class="form-select form-select-sm font-select" data-target="name">
                                        <option value="inherit">Default Font</option>
                                        <option value="'Arial', sans-serif">Arial</option>
                                        <option value="'Helvetica', sans-serif">Helvetica</option>
                                        <option value="'Times New Roman', serif">Times New Roman</option>
                                        <option value="'Georgia', serif">Georgia</option>
                                        <option value="'Courier New', monospace">Courier New</option>
                                        <option value="'Verdana', sans-serif">Verdana</option>
                                        <option value="'Roboto', sans-serif">Roboto</option>
                                        <option value="'Open Sans', sans-serif">Open Sans</option>
                                        <option value="'Montserrat', sans-serif">Montserrat</option>
                                        <option value="'Lato', sans-serif">Lato</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Job Title</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                <div class="text-format-toolbar">
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="bold" data-target="title"><i class="bi bi-type-bold"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="italic" data-target="title"><i class="bi bi-type-italic"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="underline" data-target="title"><i class="bi bi-type-underline"></i></button>
                                    <select class="form-select form-select-sm font-select" data-target="title">
                                        <option value="inherit">Default Font</option>
                                        <option value="'Arial', sans-serif">Arial</option>
                                        <option value="'Helvetica', sans-serif">Helvetica</option>
                                        <option value="'Times New Roman', serif">Times New Roman</option>
                                        <option value="'Georgia', serif">Georgia</option>
                                        <option value="'Courier New', monospace">Courier New</option>
                                        <option value="'Verdana', sans-serif">Verdana</option>
                                        <option value="'Roboto', sans-serif">Roboto</option>
                                        <option value="'Open Sans', sans-serif">Open Sans</option>
                                        <option value="'Montserrat', sans-serif">Montserrat</option>
                                        <option value="'Lato', sans-serif">Lato</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                                <div class="text-format-toolbar">
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="bold" data-target="address"><i class="bi bi-type-bold"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="italic" data-target="address"><i class="bi bi-type-italic"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="underline" data-target="address"><i class="bi bi-type-underline"></i></button>
                                    <select class="form-select form-select-sm font-select" data-target="address">
                                        <option value="inherit">Default Font</option>
                                        <option value="'Arial', sans-serif">Arial</option>
                                        <option value="'Helvetica', sans-serif">Helvetica</option>
                                        <option value="'Times New Roman', serif">Times New Roman</option>
                                        <option value="'Georgia', serif">Georgia</option>
                                        <option value="'Courier New', monospace">Courier New</option>
                                        <option value="'Verdana', sans-serif">Verdana</option>
                                        <option value="'Roboto', sans-serif">Roboto</option>
                                        <option value="'Open Sans', sans-serif">Open Sans</option>
                                        <option value="'Montserrat', sans-serif">Montserrat</option>
                                        <option value="'Lato', sans-serif">Lato</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <div class="input-group">
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" inputmode="numeric" required>
                                <div class="text-format-toolbar">
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="bold" data-target="phone"><i class="bi bi-type-bold"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="italic" data-target="phone"><i class="bi bi-type-italic"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="underline" data-target="phone"><i class="bi bi-type-underline"></i></button>
                                    <select class="form-select form-select-sm font-select" data-target="phone">
                                        <option value="inherit">Default Font</option>
                                        <option value="'Arial', sans-serif">Arial</option>
                                        <option value="'Helvetica', sans-serif">Helvetica</option>
                                        <option value="'Times New Roman', serif">Times New Roman</option>
                                        <option value="'Georgia', serif">Georgia</option>
                                        <option value="'Courier New', monospace">Courier New</option>
                                        <option value="'Verdana', sans-serif">Verdana</option>
                                        <option value="'Roboto', sans-serif">Roboto</option>
                                        <option value="'Open Sans', sans-serif">Open Sans</option>
                                        <option value="'Montserrat', sans-serif">Montserrat</option>
                                        <option value="'Lato', sans-serif">Lato</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                <div class="text-format-toolbar">
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="bold" data-target="email"><i class="bi bi-type-bold"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="italic" data-target="email"><i class="bi bi-type-italic"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary format-btn" data-format="underline" data-target="email"><i class="bi bi-type-underline"></i></button>
                                    <select class="form-select form-select-sm font-select" data-target="email">
                                        <option value="inherit">Default Font</option>
                                        <option value="'Arial', sans-serif">Arial</option>
                                        <option value="'Helvetica', sans-serif">Helvetica</option>
                                        <option value="'Times New Roman', serif">Times New Roman</option>
                                        <option value="'Georgia', serif">Georgia</option>
                                        <option value="'Courier New', monospace">Courier New</option>
                                        <option value="'Verdana', sans-serif">Verdana</option>
                                        <option value="'Roboto', sans-serif">Roboto</option>
                                        <option value="'Open Sans', sans-serif">Open Sans</option>
                                        <option value="'Montserrat', sans-serif">Montserrat</option>
                                        <option value="'Lato', sans-serif">Lato</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

                        <div id="customFieldsContainer"></div>
                        <button type="button" class="add-field-btn btn mt-3 btn-custom" id="addFieldBtn" onclick="addCustomField()">Add Custom Label</button>

                        
                    </div>
                </div>
                <!-- Image and Card Info Section-->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Add Images to Card</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div role="uploadcare-uploader" id="cardImageUploader"></div>
                            <small class="text-muted">Upload images to add to your card. Images with transparent backgrounds work best.</small>
                        </div>
                        <!-- Removed the single image size slider that was here -->
                        <div id="uploadedImagesContainer" class="mb-3">
                            <h6>Uploaded Images</h6>
                            <div id="uploadedImagesList" class="row">
                                <!-- Uploaded images will appear here -->
                                <div class="col-12 text-muted" id="noImagesMessage">No images uploaded yet</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Adding Icons -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Add Icons to Card</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="iconSearch" class="form-label text-">Search Icons</label>
                            <input type="text" class="form-control icon-search text-light" id="iconSearch">
                        </div>
                        <div class="icon-picker-container">
                            <div class="icon-grid" id="iconGrid">
                                <!-- Icons will be loaded here -->
                            </div>
                        </div>
                        <div id="selectedIconsContainer" class="mt-3">
                            <h6>Selected Icons</h6>
                            <div id="selectedIconsList" class="row">
                                <div class="col-12 text-muted" id="noIconsMessage">No icons selected yet</div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="next-btn" form="cardForm" id="nextBtn">Create Card</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.11/dist/interact.min.js"></script>
<script src="{{ asset('js/icon-functions.js') }}"></script>
<script src="{{ asset('js/font-function.js') }}"></script>
<script src="{{ asset('js/customlabel-function.js') }}"></script>
<script src="{{ asset('js/card-functions.js') }}"></script>
<script src="{{ asset('js/preview-content-function.js') }}"></script>
@endsection
