@extends('layout.appEtudiant')
@section('content')
    <h4> Gérer mon compte </h4>
    <div class="row mt-3">
        <div class="col-md-6">
            <!-- **********************Modification de l'adresse e-mail **************************** -->
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#emailModal">Modifier mon adresse e-mail</a>
            <!-- Modal -->
            <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="emailModalLabel">Modifier mon adresse e-mail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('etudiant.editCompteEmail', $etudiant->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Actuelle adresse e-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value=" {{ $etudiant->email }} " readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Nouvelle adresse e-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>

            <!-- **********************Modification du mot de passe **************************** -->
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#passwordModal">Modifier mon mot de passe</a>

            <!-- Modal -->
            <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Modifier mon mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('etudiant.updateCompte', $etudiant->id ) }}">
                    @csrf
                    <div class="modal-body">
                    <div class="mb-3">
                        <label for="oldPassword" class="form-label">Ancien mot de passe</label>
                        <input type="password" class="form-control" id="oldPassword" name="old_password" required >
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Confirmer le nouveau mot de passe</label>
                        <input type="password" class="form-control" id="confirmNewPassword" name="new_password_confirmation" required>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
                </div>
            </div>
            </div>

        </div>
    </div>



@endsection