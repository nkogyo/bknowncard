<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Dashboard - Digital Card Maker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout-emerald-theme.css') }}">
</head>
<body> 
    <!-- Hero Page -->
    <div class="hero-section position-relative overflow-hidden">
        <div class="container-fluid px-4 py-5 hero-img">
            <div class="row min-vh-100 align-items-center">
                <div class="col-lg-6 my-5 text-start">
                    <div class="lc-block mb-4">
                        <div editable="rich">
                            <p class="lead text-white-50">Welcome to <span class="text-primary">BKnown Cards</span> by © Business Kolektibs</p>
                            <h1 class="display-1 fw-bold text-white">Let yourself <br><span class="text-primary">B</span>e <span class="text-primary">K</span>nown</h1>
                        </div>
                    </div>
                    <div class="lc-block col-lg-10 mb-5">
                        <div editable="rich">
                            <p class="lead text-white-50">Your brand, your style.<br><br> Build sleek, print-ready business cards instantly, <Br> tailored to your vision and personality.</p>
                        </div>
                    </div>
                
                    <div class="lc-block d-grid gap-2 d-sm-flex mb-5"> 
                        <a class="btn btn-primary btn-lg px-4 gap-3" href="{{ route('login') }}" role="button">Start Creating!</a>
                    </div>
                </div>
                <div class="col-lg-6 position-relative">
                    <div class="geometric-shape">
                        <img src="{{ asset('card-bg/Greek-glass.png') }}" class="img-fluid" alt="Geometric Shape">
                    </div>
                </div>
            </div>
        </div>
    </div>
      
    <!-- Content -->
    <div class="min-vh-100 py-5">
        <div class="container">
            <div class="row mb-4 text-center">
                <div class="col-12">
                    <h2 class="fw-bold">Why Choose BKnown Cards?</h2>
                </div>
            </div>
            
            <div class="row mb-5">
                <div class="col-12 mb-4">
                    <h3 class="fw-bold fs-4">User-friendly GUI</h3>
                </div>
                
                <!-- First row of cards -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="card-title fw-semibold fs-5">Design Tools</h3>
                            <p class="card-text text-muted">Variety of choices for logos, colors, and fonts.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="card-title fw-semibold fs-5">Drag and Drop</h3>
                            <p class="card-text text-muted">Versatile feature that allows you to bring out your own style, by your own way.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="card-title fw-semibold fs-5">Export Options</h3>
                            <p class="card-text text-muted">Simply click create once done designing, and you are good to go!</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 mb-4">
                    <h3 class="fw-bold fs-4">Card Features</h3>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="card-title fw-semibold fs-5">Share via Link</h3>
                            <p class="card-text text-muted">You don't have to keep your creativity to yourself, you can share it to your friends or colleagues!</p>
                        </div>
                    </div>
                </div>
                
                <!-- Right side with two cards -->
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h3 class="card-title fw-semibold fs-5">QR Code Integration</h3>
                                    <p class="card-text text-muted">You also have the option to generate a QR Code for your card!.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h3 class="card-title fw-semibold fs-5">Print Quality</h3>
                                    <p class="card-text text-muted">You can also export your work into image format for printing!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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