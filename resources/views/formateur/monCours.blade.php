@extends('layout.appFormateur')
@section('content')
    <h4> Mes cours &#187; {{ $formation->titre }}</h4>
    <div class="row mt-3">
        <!-- Liste des chapitres -->
        <div class="col-md-3">
            <ul class="list-group">
                @foreach ($chapitres as $chapitre)
                
                    <a href="{{ route('formateur.moncours', ['id' => $formation->id, 'chapitre_id' => $chapitre->id]) }}" 
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
                @if ($formation->pdf != null)
                <a href=" {{ asset('storage/' . $formation->pdf) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" download="{{ asset('storage/' . $formation->pdf) }}" download><i
                    class="fas fa-download fa-sm text-white-50"></i> Telecharger le PDF</a>  
                @else
                    
                @endif
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
                @if (auth()->guard('formateur')->user()->status === 'active')
                    @php
                        $avisNote = $chapitreActif->avis->where('utilisateur_id', auth()->id())->where('type', 'Note')->first();
                    @endphp

                    <form method="POST" action="{{ route('chapitre.noter', ['chapitreId' => $chapitreActif->id]) }}">
                        @csrf
                        <div class="text-center">
                            <label for="note" class="form-label">Noter ce chapitre</label>
                            {{-- <div class="rating d-inline-flex">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="note" value="{{ $i }}" 
                                        {{ $avisNote && $avisNote->note == $i ? 'checked' : '' }} required>
                                    <label for="star{{ $i }}" title="{{ $i }} étoiles" class="star">★</label>
                                @endfor
                            </div> --}}
                            <button type="submit" class="btn btn-primary mt-3 d-block mx-auto"><div class="rating d-inline-flex">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="note" value="{{ $i }}" 
                                        {{ $avisNote && $avisNote->note == $i ? 'checked' : '' }} required>
                                    <label for="star{{ $i }}" title="{{ $i }} étoiles" class="star">★</label>
                                @endfor
                
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <h6>Commenter ce chapitre</h6>
                        <form action="{{ route('chapitre.commenter', $chapitreActif->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="commentaire" id="commentaire" class="form-control" rows="2" required placeholder="Votre commentaire"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success mt-2">Commenter</button>
                        </form>
                    </div>
                @else
                    <div></div>
                @endif
        </div>
    </div>
@endsection