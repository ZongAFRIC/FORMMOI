@extends('layout.appEtudiant')
@section('content')

<div class="row mt-2 mb-1">
    
    @if (isset($formation) && $formation->count() > 0)
        <h4 class="mb-2">Formations disponibles : [ <span>{{ $formation->count() }}</span> ]</h4>
        <div class="row">
          @foreach ($formation as $form)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
              <div class="card small-box">
                @if($form->image)
                  <img src="{{ asset('storage/' . $form->image) }}" class="card-img-top" alt="{{ $form->titre }}" />
                @elseif($form->video)
                  <video class="card-img-top" controls>
                    <source src="{{ asset('storage/' . $form->video) }}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                  </video>
                @else
                  <img src="https://ethna.net/medias/ressources_documentaires/9-cadre-de-la-formation-en-etp/images/formation-lg.jpg" class="card-img" alt="Aucune image disponible" />
                @endif
                <div class="card-body">
                  <div class="inner">
                    <h4>{{ $form->titre }}</h4>
                    {{-- <p>Desciption : {{ $form->description }}</p> --}}
                    <p>Durée : {{ $form->duree }} Heures</p>
                    <p>Prix : {{ $form->prix }} XOF</p>
                  </div>
                  <div class="d-flex justify-content-between">
                    <a href=" {{ route('etudiant.achat', ['formation_id' => $form->id]) }} " class="btn btn-primary">Acheter</a>
                    <a href=" {{ route('forma.detail', ['formation_id' => $form->id]) }} " class="btn btn-info">Plus d'info</a> 
                    <form action="{{ route('commande.panier.ajouter') }}" method="POST">
                      @csrf
                      <input type="hidden" name="formation_id" value="{{ $form->id }}">
                      <button type="submit" class="btn btn-warning">Ajouter au panier</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
    @else
        <div class="card text-align-center">
          Aucune Formation pour le moment!
        </div>
    @endif
</div>

@endsection
