<style>
    .custom-modal {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        max-width: 300px;
        max-height: 600px;
    }

    .custom-modal .modal-dialog {
        margin: 0;
        max-width: 100%;
    }

    .titre {
        font-size: 1.5rem;
        font-weight: bold;
        border-bottom: 2px solid #2825bd;
    }

    .scrollable-chapitres {
        max-height: 600px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .custom-modal .modal-content {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .badge-success-circle {
        width: 20px;
        height: 20px;
        background-color: #198754;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }

    .activer:hover {
        background-color: #ededed89 !important;
        color: black !important;
    }
</style>

@extends(Auth::guard('etudiant')->check() ? 'layout.appEtudiant' : (Auth::guard('formateur')->check() ? 'layout.appFormateur' : 'layout.default'))

@section('content')
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
    <li class="breadcrumb-item fs-5 active text-black">
        Mes cours &#187; {{ $formation->titre }}
    </li>
</ol>

<div class="row mt-3">
    <!-- Liste des chapitres -->
    <div class="col-md-3 scrollable-chapitres">
        <ul class="list-group">
            @foreach ($chapitres as $chapitre)
                <a href="{{ route('formation.monCours', ['id' => $formation->id, 'chapitre_id' => $chapitre->id]) }}"
                   class="list-group-item list-group-item-action d-flex align-items-center {{ $chapitreActif && $chapitreActif->id === $chapitre->id ? 'activer' : 'activer' }}">
                   
                    @php
                        $user = auth('etudiant')->user() ?? auth('formateur')->user();
                    @endphp

                    @if ($chapitre->estTerminePar($user))
                        <span class="badge-success-circle me-2">
                            <i class="bi bi-check-lg"></i>
                        </span>
                    @endif

                    <h6 class="mb-0">{{ $chapitre->titre }}</h6>
                </a>
            @endforeach
        </ul>
    </div>

    <!-- Contenu du chapitre -->
    <div class="col-md-7">
        @if ($chapitreActif)
            <h4 class="titre">{{ $chapitreActif->titre }}</h4>
            @if ($chapitreActif->video)
                <video id="videoPlayer" class="img-fluid" controls>
                    <source src="{{ asset('storage/' . $chapitreActif->video) }}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture des vidéos.
                </video>
            @endif
            <p>{{ $chapitreActif->description }}</p>
        @else
            <p>Aucun chapitre sélectionné.</p>
        @endif
    </div>

    <!-- Actions -->
    <div class="col-md-2 fs-6">
        @if ($formation->pdf)
            <a href="{{ asset('storage/' . $formation->pdf) }}"
               class="btn btn-sm btn-primary shadow-sm mb-2"
               download>
               <i class="fas fa-download fa-sm text-white-50"></i> PDF
            </a>
        @endif

        <!-- Bouton Formateur -->
        <a href="#" class="btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#formateurModal">
            <i class="pe-1 bi bi-person-workspace fa-sm text-white"></i> Formateur
        </a>

        <!-- Modal Formateur -->
        <div class="modal fade custom-modal" id="formateurModal" tabindex="-1" aria-labelledby="formateurModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="formateurModalLabel">Le Formateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center mb-3">
                            <img class="rounded-circle me-3" style="width: 60px; height: 60px;"
                                 src="{{ $formation->formateur->image ? asset('storage/' . $formation->formateur->image) : asset('img/user-removebg-preview.png') }}">
                            <div>
                                <strong>{{ $formation->formateur->nom }} {{ $formation->formateur->prenom }}</strong>
                                <p class="text-muted small mb-0">{{ $formation->formateur->telephone }}</p>
                                <p class="text-muted small">{{ $formation->formateur->bio }}</p>
                            </div>
                        </div>
                        <div class="text-center mb-4">
                            <a href="tel:{{ $formation->formateur->telephone }}" class="d-block">Contacter par téléphone</a>
                            <a href="mailto:{{ $formation->formateur->email }}" class="d-block">Contacter par mail</a>
                        </div>

                        <!-- Formulaire message -->
                        <form id="message-form" action="{{ route('messages.envoyer') }}" method="POST" class="rounded shadow-sm">
                            @csrf
                            <input type="hidden" name="recepteur_id" value="{{ $formation->formateur->id }}">
                            <input type="hidden" name="recepteur_type" value="formateur">
                            <textarea name="contenu" class="form-control mb-2" placeholder="Écrivez votre message..." rows="2" required></textarea>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Envoyer <i class="bi bi-send"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Note et Commentaire -->
        <div class="mt-4 mb-4">
            @php
                $avisNote = $chapitreActif->avis->where('utilisateur_id', auth()->id())->where('type', 'Note')->first();
            @endphp

            <form method="POST" action="{{ route('chapitre.noter', $chapitreActif->id) }}">
                @csrf
                <div class="text-center">
                            <label for="note" class="form-label">Noter ce chapitre</label>
                            <button type="submit" class="  d-block mx-auto"><div class="rating d-inline-flex">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="note" value="{{ $i }}" 
                                        {{ $avisNote && $avisNote->note == $i ? 'checked' : '' }} required>
                                    <label for="star{{ $i }}" title="{{ $i }} étoiles" class="star">★</label>
                                @endfor
    </button>
                        </div>
                
            </form>

            <form action="{{ route('chapitre.commenter', $chapitreActif->id) }}" method="POST" class="mt-3">
                @csrf
                <textarea name="commentaire" class="form-control" rows="2" required placeholder="Votre commentaire"></textarea>
                <button type="submit" class="btn btn-success mt-2">Commenter</button>
            </form>
        </div>
        
        <div class="progress mt-4" style="height: 10px; background: #ddd; border-radius: 5px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progression }}%; border-radius: 5px;" aria-valuenow="{{ $progression }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <small class="d-block mt-1 fs-6">Progrès :{{ $progression }}%</small>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const video = document.getElementById('videoPlayer');
    if (video) {
        video.addEventListener('ended', () => {
            fetch("{{ route('chapitre.marquerTermine', $chapitreActif->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert("Erreur : " + data.message);
                }
            })
            .catch(() => alert("Une erreur est survenue lors de la mise à jour."));
        });
    }
});
</script>
@endsection
