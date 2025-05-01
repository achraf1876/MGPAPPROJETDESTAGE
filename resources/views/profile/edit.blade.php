<x-app-layout>
    <x-slot name="header">
        <div class="bg-white shadow-sm py-3">
            <div class="container">
                <h2 class="h4 fw-bold text-mgpap-primary mb-0">
                    <i class="bi bi-person-gear me-2"></i>{{ __('Profil Utilisateur') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Section Information Profil -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <h3 class="h5 fw-bold mb-0 text-mgpap-primary">
                            
                        </h3>
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Section Mot de passe -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-mgpap-primary bg-opacity-10 py-3">
                        <h3 class="h5 fw-bold mb-0 text-mgpap-primary">
                            <i class="bi bi-shield-lock me-2"></i>Modifier le mot de passe
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Section Suppression compte -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-mgpap-primary bg-opacity-10 py-3">
                        <h3 class="h5 fw-bold mb-0 text-mgpap-primary">
                            <i class="bi bi-trash3 me-2"></i>Suppression du compte
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .rounded-3 {
            border-radius: 0.75rem !important;
        }
        .bg-mgpap-primary {
            background-color: var(--mgpap-primary) !important;
        }
        .text-mgpap-primary {
            color: var(--mgpap-primary) !important;
        }
        .bg-opacity-10 {
            background-color: rgba(26, 95, 122, 0.1) !important;
        }
    </style>
    @endpush
</x-app-layout>