@extends('layout.appFormateur')

@section('content')
    <div class="row bg-body-tertiary rounded-3">
        <div class="col-lg-8 col-md-8 col-sm-6 mb-4">
            <h4>Formations disponibles : [ <span id="formation-count">{{ $autresformations->count() }}</span> ]</h4>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 mb-4 d-flex justify-content-end">
            <form id="search-form" class="d-flex recherche d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search shadow mb-4">
                <input type="search" name="recherche" id="search-input" class="form-control bg-light border-secondary" placeholder="Rechercher une formation...">
                <span id="search-loader" class="spinner-border spinner-border-sm text-primary ml-2 d-none" role="status" aria-hidden="true"></span>
            </form>
        </div>
    </div>

    <div class="row mb-1" id="formations-container">

        @if ($autresformations->count() > 0)
            <div class="row">
                @foreach ($autresformations as $form)
                    @include('page.formationCard', ['form' => $form])
                @endforeach
            </div>
        @else
            <p class="text-warning">Aucune autre formation disponible.</p>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("search-input");
            const loader = document.getElementById("search-loader");
            const formationsContainer = document.getElementById("formations-container");
            const formationCount = document.getElementById("formation-count");

            searchInput.addEventListener("keyup", function() {
                const query = this.value.trim();
                loader.classList.remove("d-none");

                fetch(`{{ route('fmt-search-formations') }}?recherche=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        loader.classList.add("d-none");
                        formationsContainer.innerHTML = data.html;
                        formationCount.textContent = data.count;
                    })
                    .catch(error => {
                        console.error("Erreur :", error, "on est ici");
                        loader.classList.add("d-none");
                    });
            });
        });
    </script>

@endsection
