<div class="card border-0 shadow-sm rounded-3 mt-4">
    <div class="card-header bg-danger bg-opacity-10 py-3">
        <h3 class="h5 fw-bold mb-0 text-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ __('Supprimer le compte') }}
        </h3>
    </div>
    <div class="card-body p-4">
        <div class="alert alert-warning mb-4">
            <i class="bi bi-exclamation-octagon-fill me-2"></i>
            {{ __('Une fois votre compte supprimé, toutes ses données seront effacées définitivement.') }}
            {{ __('Veuillez sauvegarder toutes les informations importantes avant de continuer.') }}
        </div>

        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
            <i class="bi bi-trash3-fill me-2"></i>
            {{ __('Supprimer le compte') }}
        </button>

        <!-- Modal de confirmation -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ __('Confirmer la suppression') }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        
                        <div class="modal-body">
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-octagon-fill me-2"></i>
                                {{ __('Cette action est irréversible. Toutes vos données seront perdues.') }}
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    {{ __('Mot de passe') }}
                                </label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       required placeholder="{{ __('Entrez votre mot de passe') }}">
                                @if($errors->userDeletion->get('password'))
                                    <div class="invalid-feedback d-block">
                                        @foreach($errors->userDeletion->get('password') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-2"></i>
                                {{ __('Annuler') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash3-fill me-2"></i>
                                {{ __('Supprimer définitivement') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>