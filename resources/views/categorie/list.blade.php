@extends('layout.appEtudiant')
@section('content')

<div class="row mt-4 mb-3">
    
    @if (isset($categorie) && $categorie->count() > 0)
        <h4>Categories disponibles : {{ $categorie->count() }} </h4>
        <div class="row">
          @foreach ($categorie as $cat)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>{{ $cat->nom_categorie }}</h4>
                  <p>Formation : {{ $cat->formations_count }}</p>
                </div>
                <a href=" {{ route('categorie.formations', ['nom_categorie' => $cat->nom_categorie] ) }} " class="small-box-footer">
                  Tout voir <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          @endforeach
        </div>

    @else
        <div class="card text-align-center">
          Aucune catégorie pour le moment!
        </div>
    @endif
</div>

@endsection
