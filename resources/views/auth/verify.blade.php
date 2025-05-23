<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Digital Card Maker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/auth-emerald-theme.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card rounded-4 shadow bg-transparent" style="max-width: 400px; margin: 0 auto;">
                        <div class="card-header text-center py-3 fw-bold fs-4 border-0">
                            {{ __('Verify Your Email Address') }}
                        </div>
                        <div class="card-body bg-dark px-4 py-4 rounded-bottom-4 text-light">
                            @if (session('resent'))
                                <div class="alert alert-success bg-dark text-light" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <div>
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-primary">
                                    {{ __('click here to request another') }}
                                </button>
                                <span href="{{ url('/') }}" class="btn back-btn start-0 mx-3 text-light">
                                    <i>or go back home</i>
                                </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

