@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mgpap-header p-3 rounded-top mb-3">
        <h1 class="h3 mb-0">
            <i class="bi bi-envelope-check me-2"></i>
            Vérification de l'email
        </h1>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="alert alert-info bg-mgpap-secondary text-white border-0">
                <i class="bi bi-info-circle-fill me-2"></i>
                Merci pour votre inscription ! Avant de commencer, pourriez-vous vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer ?
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success bg-success text-white border-0">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Un nouveau lien de vérification a été envoyé à l'adresse email que vous avez fournie lors de l'inscription.
                </div>
            @endif

            <div class="d-flex gap-3 mt-4">
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-mgpap">
                        <i class="bi bi-envelope-arrow-up me-2"></i>
                        Renvoyer l'email de vérification
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Se déconnecter
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
    }
    
    .btn-mgpap {
        background-color: var(--mgpap-primary);
        color: white;
        border: none;
    }
    
    .btn-mgpap:hover {
        background-color: #13455a;
        color: white;
    }
    
    .bg-mgpap-secondary {
        background-color: var(--mgpap-secondary);
    }
    
    .alert {
        border-left: 4px solid transparent;
    }
    
    .alert-info.bg-mgpap-secondary {
        border-left-color: var(--mgpap-primary);
    }
    
    .alert-success {
        border-left-color: #28a745;
    }
</style>
@endsection