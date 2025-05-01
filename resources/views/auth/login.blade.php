<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="mgpap-header p-4 rounded-top text-center">
                    <h1 class="h3 mb-0">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        {{ __('Connexion') }}
                    </h1>
                </div>

                <div class="card shadow-sm border-0 rounded-bottom">
                    <div class="card-body p-4">
                        <!-- Session Status -->
                        <x-auth-session-status class="alert alert-mgpap mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
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
                                            autofocus 
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
                                            autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4 form-check">
                                <input id="remember_me" 
                                       type="checkbox" 
                                       class="form-check-input" 
                                       name="remember">
                                <label for="remember_me" class="form-check-label text-muted">
                                    {{ __('Se souvenir de moi') }}
                                </label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                @if (Route::has('password.request'))
                                    <a class="text-mgpap-secondary text-decoration-none" href="{{ route('password.request') }}">
                                        <i class="bi bi-question-circle me-1"></i>
                                        {{ __('Mot de passe oublié ?') }}
                                    </a>
                                @endif

                                <x-primary-button class="btn btn-mgpap px-4 py-2">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    {{ __('Se connecter') }}
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
        
        .form-check-input:checked {
            background-color: var(--mgpap-primary);
            border-color: var(--mgpap-primary);
        }
        
        .card {
            border-radius: 0 0 0.5rem 0.5rem;
        }
    </style>
</x-guest-layout>