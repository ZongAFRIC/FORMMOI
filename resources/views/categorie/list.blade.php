@extends($layout)

@section('content')
    <div class="row mt-4 mb-3">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-6 mb-4">
                <h5>Catégories disponibles : <span id="categories-count">{{ $categories->count() }}</span></h5>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 mb-4 d-flex justify-content-end">
                <form id="search-form" class="d-flex recherche d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search shadow mb-4">
                    <input type="search" name="recherche" id="search-input" class="form-control bg-light border-secondary" 
                        placeholder="Rechercher une catégorie ..." >
                    <span id="search-loader" class="spinner-border spinner-border-sm text-primary ml-2 d-none" role="status" aria-hidden="true"></span>
                </form>
            </div>
        </div>

        <!-- Conteneur pour les catégories (mis à jour dynamiquement) -->
        <div id="categories-container" class="row mt-3">
            @foreach ($categories as $cat)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h4>{{ $cat->nom_categorie }}</h4>
                            <p>Formation : {{ $cat->formations_count }}</p>
                        </div>
                        <a href="{{ route('categorie.formations', ['nom_categorie' => $cat->nom_categorie]) }}" class="small-box-footer">
                            Tout voir <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Message si aucune catégorie n'est disponible -->
        @if ($categories->isEmpty())
            <div class="card text-align-center">Aucune catégorie pour le moment!</div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const categoriesContainer = document.getElementById('categories-container');
            const categoriesCount = document.getElementById('categories-count');

            // Fonction pour effectuer une recherche
            function fetchCategories(query) {
                fetch(`/search-categories?recherche=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        // Mise à jour du conteneur des catégories
                        categoriesContainer.innerHTML = '';
                        if (data.length > 0) {
                            categoriesCount.textContent = data.length; // Mettre à jour le nombre de catégories
                            data.forEach(cat => {
                                const categoryHtml = `
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                        <div class="small-box bg-primary">
                                            <div class="inner">
                                                <h4>${cat.nom_categorie}</h4>
                                                <p>Formation : ${cat.formations_count}</p>
                                            </div>
                                            <a href="${cat.url}" class="small-box-footer">
                                                Tout voir <i class="fas fa-arrow-circle-right"></i>
                                            </a>

                                        </div>
                                    </div>
                                `;
                                categoriesContainer.insertAdjacentHTML('beforeend', categoryHtml);
                            });
                        } else {
                            categoriesCount.textContent = 0;
                            categoriesContainer.innerHTML = '<div class="text-center text-danger ">Aucun résultat!</div>';
                        }
                    })
                    .catch(error => console.error('Erreur:', error));
            }

            // Écouteur d'événements pour l'entrée de texte
            searchInput.addEventListener('input', function () {
                const query = this.value.trim();
                fetchCategories(query);
            });
        });
    </script>
@endsection
