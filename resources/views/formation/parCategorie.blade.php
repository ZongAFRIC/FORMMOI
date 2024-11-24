@extends('layout.appEtudiant')
@section('content')

<div class="container mt-4">
    <h4>Formations pour la catégorie : {{ $categorie->nom_categorie }} [ <span class="count">{{ $categorie->formations()->count() }}</span> ]</h4>
    
    <div class="row"> 
        @foreach ($categorie->formations as $formation)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $formation->titre }}</h5>
                    <p class="card-text">{{ $formation->description }}</p>
                    {{-- <a href="{{ route('formation.detail', $formation->id) }}" class="btn btn-primary">Voir la formation</a> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
