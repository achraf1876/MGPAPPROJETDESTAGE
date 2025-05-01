<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Profil Utilisateur') }} - MGPAP</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --mgpap-primary: #1a5f7a;
            --mgpap-secondary: #57c5b6;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
        }
        
        .profile-card {
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .profile-header {
            border-bottom: 1px solid #e0e0e0;
            background-color: rgba(26, 95, 122, 0.05);
        }
        
        .btn-mgpap {
            background-color: var(--mgpap-primary);
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .btn-mgpap:hover {
            background-color: #13455a;
            color: white;
        }
        
        .form-control:focus {
            border-color: var(--mgpap-primary);
            box-shadow: 0 0 0 0.2rem rgba(26, 95, 122, 0.25);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card bg-white mb-4">
                    <div class="profile-header p-4">
                        <h2 class="h4 mb-0 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-badge me-2" viewBox="0 0 16 16">
                                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5v11A2.5 2.5 0 0 0 4.5 16h7a2.5 2.5 0 0 0 2.5-2.5v-11A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v11a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 13.5v-11z"/>
                            </svg>
                            {{ __('Informations du profil') }}
                        </h2>
                        <p class="text-muted mb-0 mt-2 small">
                            {{ __('Mettez à jour vos informations personnelles') }}
                        </p>
                    </div>
                    
                    <div class="p-4">
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="mb-4">
                                <label for="name" class="form-label">{{ __('Nom complet') }}</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">{{ __('Adresse email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="alert alert-warning mt-3">
                                        <p class="mb-2">{{ __('Votre adresse email n\'est pas vérifiée.') }}</p>
                                        <button form="send-verification" class="btn btn-sm btn-outline-primary">
                                            {{ __('Renvoyer l\'email de vérification') }}
                                        </button>
                                        @if (session('status') === 'verification-link-sent')
                                            <div class="alert alert-success mt-3 mb-0">
                                                {{ __('Un nouveau lien de vérification a été envoyé.') }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-mgpap">
                                    {{ __('Enregistrer les modifications') }}
                                </button>
                                
                                @if (session('status') === 'profile-updated')
                                    <div class="alert alert-success ms-3 mb-0 py-2 px-3">
                                        {{ __('Modifications enregistrées') }}
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>