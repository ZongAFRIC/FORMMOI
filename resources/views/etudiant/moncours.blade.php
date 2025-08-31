<style>
    .custom-modal {
        position: absolute !important;
        top: 0 !important;
        right: 0 !important;
        width: 100% !important;
        max-width: 300px;
        transform: none !important;
    }

    .custom-modal .modal-dialog {
        margin: 0 !important;
        max-width: 100% !important;
    }

    .custom-modal .modal-content {
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }

</style>
@extends('layout.appEtudiant')

@section('content')
    <h4> Mes cours &#187; {{ $formation->titre }}</h4>
    <div class="row mt-4">
        <!-- Liste des chapitres -->
        <div class="col-md-3">
            <ul class="list-group">
                @foreach ($chapitres as $chapitre)
                    <a href="{{ route('etudiant.moncours', ['id' => $formation->id, 'chapitre_id' => $chapitre->id]) }}" 
                       class="{{ $chapitreActif && $chapitreActif->id === $chapitre->id }}">
                        <li class="list-group-item mb-1 {{ $chapitreActif && $chapitreActif->id === $chapitre->id ? 'active' : '' }}">
                            {{ $chapitre->titre }}
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>

        <!-- Contenu du chapitre -->
        <div class="col-md-7">
            @if ($chapitreActif)
                @if ($chapitreActif->video)
                    <video style="height: auto;" class="img-fluid" controls>
                        <source src="{{ asset('storage/' . $chapitreActif->video) }}" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture des vidéos.
                    </video>
                @endif
                <h4>{{ $chapitreActif->titre }}</h4>
                <p>{{ $chapitreActif->description }}</p>
            @else
                <p>Aucun chapitre sélectionné.</p>
            @endif
        </div>

        <!-- Actions sur le chapitre -->
        <div class="col-md-2 fs-6">
            <div>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm me-2 btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white pe-1"></i>PDF</a>
                <a href="#" class="ml-3 d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#formateurModal">
                    <i class="pe-1 bi bi-person-workspace fa-sm text-white"></i> Formateur
                </a>

                <!-- Modal -->
                <div class="modal fade custom-modal" id="formateurModal" tabindex="-1" aria-labelledby="formateurModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="formateurModalLabel">Le Formateur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"><i class="bi bi-x-square"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex align-items-center">
                                    <img class="img-profile rounded-circle me-3" style="width: 60px; height: 60px;" 
                                        src="{{ $formation->formateur->image ? asset('storage/' . $formation->formateur->image) : asset('img/user-removebg-preview.png') }}">
                                    <div>
                                        <p class="mb-1"><strong>{{ $formation->formateur->nom }} {{ $formation->formateur->prenom }}</strong></p>
                                        <p class="text-muted small">{{ $formation->formateur->bio }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <a href="mailto: {{ $formation->formateur->email }} " class="mb-4">Le contacter par mail</a>

                                    <a href="#" class="btn btn-primary" id="chatFormateur">
                                        <i class="bi bi-chat-dots"></i> Chatter avec le Formateur
                                    </a>
                                </div>
                            </div>

                            <!-- Pied du modal avec un bouton de fermeture -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-4">
                @if (auth()->guard('etudiant')->user()->status === 'active')
                <form method="POST" action="{{ route('chapitre.noter', ['chapitreId' => $chapitreActif->id]) }}">
                    @csrf
                    <div class="text-center">
                        <label for="note" class="form-label">Noter ce chapitre</label>
                        <div class="rating d-inline-flex">
                            <input type="number" name="note" id="note" class="form-control" placeholder="Votre note (sur 5)" min="1" max="5" required>
                        </div>
                        <input type="hidden" name="type" value="Note">
                        <button type="submit" class="btn btn-primary mt-3 d-block mx-auto">Noter</button>
                    </div>
                </form>         

                    <div class="mt-4">
                        <div class="mt-4">
                            <form action="{{ route('chapitre.commenter', $chapitreActif->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="commentaire">Commenter</label>
                                    <textarea name="commentaire" id="commentaire" class="form-control" rows="4" placeholder="Votre commentaire ..." required></textarea>
                                </div>
                                <input type="hidden" name="type" value="Commentaire">
                                <button type="submit" class="btn btn-success mt-2">Envoyer</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div></div>
                @endif

                @if ($chapitreActif)
                    <h5>Commentaires</h5>
                    @if ($chapitreActif->commentaires->count() > 0)
                        @foreach ($chapitreActif->commentaires as $commentaire)
                            <div class="p-2 border rounded my-2">
                                <strong>{{ $commentaire->user->nom ?? 'Utilisateur inconnu' }}</strong> - 
                                <span>{{ $commentaire->created_at->format('d/m/Y') }}</span>
                                <p>{{ $commentaire->contenu }}</p>
                            </div>
                        @endforeach
                    @else
                        <p>Aucun commentaire pour ce chapitre.</p>
                    @endif

                    {{-- Affichage des notes --}}
                    {{-- <h4>Notes</h4>
                    @if ($chapitreActif->note->count() > 0)
                        @foreach ($chapitreActif->note as $note)
                            <div class="p-2 border rounded my-2">
                                <strong>{{ $note->user->nom ?? 'Utilisateur inconnu' }}</strong> - 
                                <span>{{ $note->created_at->format('d/m/Y') }}</span>
                                <p>Note donnée : {{ $note->valeur }}/5</p>
                            </div>
                        @endforeach
                        <div class="mt-4">
                            <h5>Note moyenne</h5>
                            <p>{{ $chapitreActif->note->count() > 0 ? $chapitreActif->note->avg('valeur') : 'Aucune note' }}</p>
                        </div>
                    @else
                        <p>Aucune note pour ce chapitre.</p>
                    @endif --}}
                @endif
            </div>
        </div>
    </div>
@endsection
