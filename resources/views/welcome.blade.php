<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MGPAP - Professional Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-blue: #3498db;  /* Bleu clair */
            --primary-green: #2ecc71; /* Vert moderne */
            --dark-green: #27ae60;    /* Vert foncé */
            --light-bg: #f8f9fa;      /* Fond clair */
            --dark-text: #2c3e50;     /* Texte foncé */
        }
        
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        
        .btn-primary {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            padding: 0.5rem 1.75rem;
        }
        
        .btn-primary:hover {
            background-color: var(--dark-green);
            border-color: var(--dark-green);
        }
        
        .btn-outline-primary {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
            padding: 0.5rem 1.75rem;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-blue);
            color: white;
        }
        
        .main-hero {
            background: linear-gradient(135deg, rgba(52,152,219,0.1) 0%, rgba(46,204,113,0.1) 100%);
            border-radius: 1rem;
        }
        
        .logo-icon {
            background-color: var(--primary-green);
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
        
        footer {
            background-color: var(--dark-text);
            color: white;
        }
    </style>
</head>

<body>
    <header class="py-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent px-0">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                        <div class="logo-icon">
                            <i class="bi bi-shield-check fs-5"></i>
                        </div>
                        <span class="fs-3" style="color: var(--primary-green);">MGPAP</span>
                    </a>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="ms-auto d-flex align-items-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary me-3">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">
                                        <i class="bi bi-person-plus me-2"></i>Register
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="flex-grow-1 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="main-hero p-5 text-center">
                        <h1 class="display-4 fw-bold mb-4" style="color: var(--primary-blue);">Welcome to MGPAP</h1>
                        <p class="lead mb-4">Professional management platform with modern design</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-4">
                                    <i class="bi bi-arrow-right me-2"></i>Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-3">
                                    <i class="bi bi-rocket me-2"></i>Get Started
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-lg px-4">
                                    <i class="bi bi-info-circle me-2"></i>Learn More
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-4 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2025 MGPAP. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>