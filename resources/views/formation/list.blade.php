@extends('layout.appEtudiant')
@section('content')

<div class="row mt-2 mb-1">
    @if (isset($formations) && $formations->count() > 0)
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-6 mb-4">
                <h4 class="mb-2">Formations disponibles : [ <span id="formations-count"> {{ $formations->count() }} </span> ]</h4>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-end">
                <form id="search-form" class="d-flex recherche d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search shadow mb-4">
                    <input type="search" name="recherche" id="search-input" class="form-control bg-light border-secondary" 
                        placeholder="Rechercher une formation ..." >
                    <span id="search-loader" class="spinner-border spinner-border-sm text-primary ml-2 d-none" role="status" aria-hidden="true"></span>
                </form>
            </div>
        </div>
        <div id="formations-container" class="row">
            @foreach ($formations as $form)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card small-box">
                        <img src="{{ $form->image ? asset('storage/' . $form->image) : asset('img/nn.png') }}" class="img-fluid" alt="Aucune image disponible" />
                        <div class="card-body">
                            <div class="inner">
                                <h4>{{ $form->titre }}</h4>
                                <p>Durée : {{ $form->duree }} Heures</p>
                                <p>Prix : {{ $form->prix }} XOF</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('formation.achat', ['formation_id' => $form->id]) }}" class="btn btn-primary">Acheter</a>
                                <a href="{{ route('forma.detail', ['formation_id' => $form->id]) }}" class="btn btn-info">Plus d'info</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-input');
                const formationContainer = document.getElementById('formations-container');
                const formationCount = document.getElementById('formations-count');
                const searchLoader = document.getElementById('search-loader');
                let initialHtml = formationContainer.innerHTML;
                let initialCount = parseInt(formationCount.textContent);

                function fetchFormation(query) {
                    if (!query) {
                        formationContainer.innerHTML = initialHtml;
                        formationCount.textContent = initialCount;
                        return;
                    }

                    searchLoader.classList.remove('d-none');
                    fetch(`{{ route('formations.search') }}?recherche=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            formationContainer.innerHTML = '';
                            formationCount.textContent = data.length;

                            if (data.length > 0) {
                                data.forEach(formation => {
                                    formationContainer.insertAdjacentHTML('beforeend', `
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                            <div class="card small-box">
                                                <img src="${formation.img}" class="img-fluid" alt="Aucune image disponible" />
                                                <div class="card-body">
                                                    <div class="inner">
                                                        <h4>${formation.titre}</h4>
                                                        <p>Durée : ${formation.duree} Heures</p>
                                                        <p>Prix : ${formation.prix} XOF</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="${formation.url1}" class="btn btn-primary">Acheter</a>
                                                        <a href="${formation.url2}" class="btn btn-info">Plus d'info</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `);
                                });
                            } else {
                                formationContainer.innerHTML = `<div class="col-12 text-center text-danger">Aucun résultat trouvé</div>`;
                            }
                        })
                        .catch(err => {
                            formationContainer.innerHTML = `<div class="col-12 text-center text-danger">Erreur : ${err.message}</div>`;
                        })
                        .finally(() => {
                            searchLoader.classList.add('d-none');
                        });
                }

                let debounceTimer;
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        fetchFormation(this.value.trim());
                    }, 300);
                });
            });
        </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @else
        <div class="card text-align-center">
            Aucune Formation pour le moment!
        </div>
    @endif
</div>



@endsection
