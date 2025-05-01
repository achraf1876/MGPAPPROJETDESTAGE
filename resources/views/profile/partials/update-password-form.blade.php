<div class="password-update-section bg-white p-4 rounded-3 shadow-sm">
    <div class="mb-4">
        <h3 class="h5 text-dark fw-bold mb-2">
            <i class="bi bi-key-fill text-mgpap-primary me-2"></i>
            {{ __('Changer le mot de passe') }}
        </h3>
        <p class="text-muted small mb-0">
            {{ __('Pour votre sécurité, utilisez un mot de passe fort et unique.') }}
        </p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="needs-validation" novalidate>
        @csrf
        @method('put')

        <!-- Mot de passe actuel -->
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="currentPassword" 
                   name="current_password" required placeholder=" ">
            <label for="currentPassword">{{ __('Mot de passe actuel') }}</label>
            @if($errors->updatePassword->get('current_password'))
                <div class="invalid-feedback d-block">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <!-- Nouveau mot de passe -->
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="newPassword" 
                   name="password" required placeholder=" ">
            <label for="newPassword">{{ __('Nouveau mot de passe') }}</label>
            @if($errors->updatePassword->get('password'))
                <div class="invalid-feedback d-block">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <!-- Confirmation -->
        <div class="form-floating mb-4">
            <input type="password" class="form-control" id="confirmPassword" 
                   name="password_confirmation" required placeholder=" ">
            <label for="confirmPassword">{{ __('Confirmer le mot de passe') }}</label>
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary px-4 py-2 rounded-2">
                <i class="bi bi-check-lg me-2"></i>
                {{ __('Mettre à jour') }}
            </button>
            
            @if(session('status') === 'password-updated')
                <div class="alert alert-success ms-3 mb-0 py-2 px-3 small fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    {{ __('Mot de passe mis à jour') }}
                </div>
            @endif
        </div>
    </form>
</div>

<style>
    .password-update-section {
        border: 1px solid rgba(0, 0, 0, 0.08);
    }
    .form-floating label {
        color: #6c757d;
    }
    .form-control:focus {
        border-color: var(--mgpap-primary);
        box-shadow: 0 0 0 0.25rem rgba(26, 95, 122, 0.15);
    }
</style>