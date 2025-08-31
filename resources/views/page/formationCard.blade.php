<div class="col-lg-4 col-md-3 col-sm-6 mb-2">
    <div class="card small-box">
        {{-- Affichage de l'image ou de la vidéo de la formation --}}
        <img src="{{ asset('img/nn.png') }}" class="img-fluid" alt="Aucune image disponible" />

        <div class="card-body">
            <div class="inner">
                <h4>{{ $form->titre }}</h4>
                <p>Durée : {{ $form->duree }} Heures</p>
                <p>Prix : {{ $form->prix }} XOF</p>
            </div>

            {{-- Boutons d'action --}}
            @if ($mesformations->contains($form))
                <div class="d-flex justify-content-between">
                    <p class="text-warning text-center fs-4">Moi</p>
                </div>

            @elseif ($formationsAchetees->contains($form))
                <div class="d-flex justify-content-between">
                    <p class="text-warning text-center fs-4">Achetée</p>
                </div>

            @else
                <div class="d-flex justify-content-between">
                    <a href="{{ route('formation.achat', ['formation_id' => $form->id]) }}" class="btn btn-primary">Acheter</a>
                    <a href="{{ route('forma.detail', ['formation_id' => $form->id]) }}" class="btn btn-info">Plus d'info</a>
                </div>
            @endif
        </div>
    </div>
</div>
