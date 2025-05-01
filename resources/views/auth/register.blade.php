<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="mgpap-header p-4 rounded-top text-center">
                    <h1 class="h3 mb-0">
                        <i class="bi bi-person-plus me-2"></i>
                        {{ __('Créer un compte') }}
                    </h1>
                </div>

                <div class="card shadow-sm border-0 rounded-bottom">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Nom complet')" class="form-label text-muted" />
                                <x-text-input id="name" 
                                            class="form-control bg-light border-0 py-2 px-3 rounded" 
                                            type="text" 
                                            name="name" 
                                            :value="old('name')" 
                                            required 
                                            autofocus 
                                            autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger small" />
                            </div>

                            <!-- Email Address -->
                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Adresse email')" class="form-label text-muted" />
                                <x-text-input id="email" 
                                            class="form-control bg-light border-0 py-2 px-3 rounded" 
                                            type="email" 
                                            name="email" 
                                            :value="old('email')" 
                                            required 
                                            autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <x-input-label for="password" :value="__('Mot de passe')" class="form-label text-muted" />
                                <x-text-input id="password" 
                                            class="form-control bg-light border-0 py-2 px-3 rounded"
                                            type="password"
                                            name="password"
                                            required 
                                            autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="form-label text-muted" />
                                <x-text-input id="password_confirmation" 
                                            class="form-control bg-light border-0 py-2 px-3 rounded"
                                            type="password"
                                            name="password_confirmation" 
                                            required 
                                            autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger small" />
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a class="text-mgpap-secondary text-decoration-none" href="{{ route('login') }}">
                                    <i class="bi bi-arrow-left-short"></i>
                                    {{ __('Déjà inscrit ?') }}
                                </a>

                                <x-primary-button class="btn btn-mgpap px-4 py-2">
                                    <i class="bi bi-person-check me-2"></i>
                                    {{ __('S\'inscrire') }}
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
        
        .text-mgpap-secondary {
            color: var(--mgpap-secondary);
        }
        
        .text-mgpap-secondary:hover {
            color: var(--mgpap-primary);
            text-decoration: underline;
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