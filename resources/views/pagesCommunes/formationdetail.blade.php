@extends(Auth::guard('etudiant')->check() ? 'layout.appEtudiant' : (Auth::guard('formateur')->check() ? 'layout.appFormateur' : 'layout.default'))

@section('content')
<div class="card mb-3 pt-3 px-3 shadow-sm">
  <h5 class="fw-bold text-primary">Formation &#187; Détail</h5>
</div>

<div class="row justify-content-center">
  <div class="col-lg-6 col-md-8 col-sm-10 mb-4">
    <div class="card small-box shadow-sm border-0 rounded-3">
      @if($formation->image)
        <div class="text-center">
          <img src="{{ asset('storage/' . $formation->image) }}" 
               class="card-img-top img-fluid rounded shadow-sm" 
               style="max-width: 100%; height: auto;" 
               alt="{{ $formation->titre }}" />
        </div>
      @else 
        <div class="text-center">
          <iframe src="" class="card-img img-fluid rounded shadow-sm" 
                  style="max-width: 100%; height: auto;" 
                  title="Aucune image disponible"></iframe>
        </div>
      @endif

      <div class="card-body">
        <div class="inner">
          <h4 class="fw-bold text-primary mb-3">{{ $formation->titre }}</h4>
          <p><strong>Description :</strong> {{ $formation->description }}</p>
          <p><strong>Durée :</strong> {{ $formation->duree }} heures</p>
          <p><strong>Chapitres :</strong> {{ $formation->chapitres_count }}</p>
          <p class="text-success fw-bold"><strong>Prix :</strong> {{ $formation->prix }} XOF</p>
          <hr class="my-3">

          <fieldset class="border p-3 rounded bg-light">
            <legend class="float-none w-auto px-2 fw-semibold text-dark">Formateur</legend>
            <div class="row align-items-center">
              <div class="col-md-4 text-center">
                <img 
                  class="img-profile rounded-circle shadow-lg border border-secondary" 
                  src="{{ $formation->formateur->image ? asset('storage/' . $formation->formateur->image) : asset('img/user-removebg-preview.png') }}" 
                  style="width: 120px; height: 120px; object-fit: cover;">
              </div>
              <div class="col-md-8">
                <p class="mb-1 fw-bold text-dark">{{ $formation->formateur->nom }} {{ $formation->formateur->prenom }}</p>
                <p class="text-muted fst-italic">{{ $formation->formateur->bio }}</p>
              </div>
            </div>
          </fieldset>

          <hr class="my-3">
        </div>
      </div>

      <div class="d-flex justify-content-center p-4">
        <a href="{{ route('formation.achat', ['formation_id' => $formation->id]) }}" 
           class="btn btn-primary btn-lg w-100">
           Acheter cette formation
        </a>
      </div>
    </div>
  </div>
</div>

<style>
  .card.small-box:hover {
    transform: scale(1.02);
    transition: transform 0.3s ease;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
  }
</style>
@endsection
