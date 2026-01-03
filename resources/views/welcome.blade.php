<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SunScreen Rating App</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .welcome-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="welcome-card p-5 text-center">
                    <div class="mb-4">
                        <i class="fas fa-sun fa-4x text-warning mb-3"></i>
                        <h1 class="display-5 fw-bold text-primary">SunScreen Rating</h1>
                        <p class="lead text-muted">
                            Sistem penilaian sunscreen terbaik untuk kulit sehat Anda
                        </p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <i class="fas fa-star fa-2x text-warning mb-3"></i>
                                    <h5>Rating System</h5>
                                    <p class="text-muted small">Beri rating pada produk sunscreen favorit Anda</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <i class="fas fa-chart-bar fa-2x text-primary mb-3"></i>
                                    <h5>Analytics</h5>
                                    <p class="text-muted small">Lihat statistik dan perbandingan produk</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-md-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </a>
                        @endif
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('penilaian.create') }}" class="text-muted text-decoration-none">
                            Lanjutkan sebagai guest <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>