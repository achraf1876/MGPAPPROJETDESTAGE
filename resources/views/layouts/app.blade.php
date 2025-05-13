<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MGPAP') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <style>
            :root {
                --mgpap-primary:rgb(100, 202, 165);
                --mgpap-secondary:rgb(40, 53, 51);
                --mgpap-light:rgb(92, 123, 153);
                --mgpap-dark: #212529;
            }
            
            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: var(--mgpap-light);
            }
            
            .bg-mgpap-primary {
                background-color: var(--mgpap-primary) !important;
            }
            
            .text-mgpap-primary {
                color: var(--mgpap-primary) !important;
            }
            
            .btn-mgpap {
                background-color: var(--mgpap-primary);
                color: white;
                border-radius: 4px;
                padding: 8px 20px;
                font-weight: 500;
            }
            
            .btn-mgpap:hover {
                background-color: #13455a;
                color: white;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="d-flex flex-column min-vh-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm py-3">
                    <div class="container">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow-1 py-4">
                <div class="container">
                    {{ $slot }}
                </div>
            </main>

            <footer class="bg-mgpap-primary text-white py-3 mt-auto">
                <div class="container text-center">
                    <p class="mb-0">&copy; {{ date('Y') }} MGPAP. Tous droits réservés.</p>
                </div>
            </footer>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>