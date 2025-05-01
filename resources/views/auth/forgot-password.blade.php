<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="mgpap-header p-4 rounded-top text-center">
                    <h1 class="h3 mb-0">
                        <i class="bi bi-shield-lock me-2"></i>
                        {{ __('Réinitialisation du mot de passe') }}
                    </h1>
                </div>

                <div class="card shadow-sm border-0 rounded-bottom">
                    <div class="card-body p-4">
                        <div class="alert alert-mgpap mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            {{ __('Mot de passe oublié ? Aucun problème. Indiquez-nous votre adresse email et nous vous enverrons un lien de réinitialisation.') }}
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="alert alert-success mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Adresse email')" class="form-label text-muted" />
                                <x-text-input id="email" 
                                            class="form-control bg-light border-0 py-2 px-3 rounded" 
                                            type="email" 
                                            name="email" 
                                            :value="old('email')" 
                                            required 
                                            autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                            </div>

                            <div class="d-grid mt-4">
                                <x-primary-button class="btn btn-mgpap py-2">
                                    <i class="bi bi-envelope-arrow-up me-2"></i>
                                    {{ __('Envoyer le lien de réinitialisation') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
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
        
        .alert-mgpap {
            background-color: var(--mgpap-light);
            border-left: 4px solid var(--mgpap-primary);
            color: var(--mgpap-primary);
        }
        
        .btn-mgpap {
            background-color: var(--mgpap-primary);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-mgpap:hover {
            background-color: #13455a;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .form-control {
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(26, 95, 122, 0.25);
            border-color: var(--mgpap-secondary);
        }
        
        .card {
            border-radius: 0 0 0.5rem 0.5rem;
        }
    </style>
</x-guest-layout>