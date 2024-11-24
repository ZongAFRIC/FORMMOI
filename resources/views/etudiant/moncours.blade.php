@extends('layout.appEtudiant')

@section('content')
    <h4> Mes cours > {{ $formation->titre }}</h4>
    <div class="row mt-4">
        <!-- Liste des chapitres -->
        <div class="col-md-3">
            <ul class="list-group">
                @foreach ($chapitres as $chapitre)
                    <li class="list-group-item {{ $chapitreActif && $chapitreActif->id === $chapitre->id ? 'active' : '' }}">
                        <a href="{{ route('etudiant.moncours', ['id' => $formation->id, 'chapitre_id' => $chapitre->id]) }}" 
                           class="text-decoration-none btn  {{ $chapitreActif && $chapitreActif->id === $chapitre->id ? 'text-white' : 'text-dark' }}">
                            {{ $chapitre->titre }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-1">

        </div>

        <!-- Contenu du chapitre -->
        <div class="col-md-8">
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
    </div>
@endsection
