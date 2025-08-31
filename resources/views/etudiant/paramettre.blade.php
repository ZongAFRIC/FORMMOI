@extends('layout.appEtudiant')
@section('content')
    <h4> Paramètres </h4>
    <div class="row mt-3">
        <div class="col-md-6">
            <a href=" {{ route('etudiant.gererCompte') }} ">Gerer mon compte</a>
            <a href="#" class="btn bg-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer mon compte</a>

             <!-- Modal -->
             <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <a href="{{ route('etudiant.deleteCompte', $etudiant->id) }}" class="btn btn-danger">Confirmer</a>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    
@endsection