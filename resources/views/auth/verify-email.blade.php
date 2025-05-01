<x-guest-layout>
    <div class="container py-4">
        <div class="mgpap-header p-3 rounded-top mb-4">
            <h1 class="h4 mb-0">
                <i class="bi bi-envelope-check me-2"></i>
                {{ __('Vérification de votre email') }}
            </h1>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="alert alert-mgpap mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    {{ __('Merci pour votre inscription ! Avant de commencer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer. Si vous n\'avez pas reçu l\'email, nous pouvons vous en renvoyer un.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse email fournie lors de l\'inscription.') }}
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <x-primary-button class="btn-mgpap">
                            <i class="bi bi-envelope-arrow-up me-2"></i>
                            {{ __('Renvoyer l\'email de vérification') }}
                        </x-primary-button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-mgpap">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            {{ __('Se déconnecter') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --mgpap-primary: #1a5f7a;
            --mgpap-secondary: #57c5b6;
            --mgpap-light: #f8f9fa;
        }
        
        .mgpap-header {
            background-color: var(--mgpap-primary);
            color: white;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        
        .btn-mgpap {
            background-color: var(--mgpap-primary);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
        }
        
        .btn-mgpap:hover {
            background-color: #13455a;
            color: white;
        }
        
        .btn-outline-mgpap {
            color: var(--mgpap-primary);
            border-color: var(--mgpap-primary);
        }
        
        .btn-outline-mgpap:hover {
            background-color: var(--mgpap-primary);
            color: white;
        }
        
        .alert-mgpap {
            background-color: var(--mgpap-light);
            border-left: 4px solid var(--mgpap-primary);
            color: var(--mgpap-primary);
        }
        
        .card {
            border-radius: 0 0 0.5rem 0.5rem;
            border: none;
        }
    </style>
</x-guest-layout>