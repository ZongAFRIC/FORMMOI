@extends('layout.appFormateur')
@section('content')
<div class="row">
    @if ($mesFormations->isEmpty())
        <p class="text-center">Vous n'avez encore aucun cours. <a href="{{ route('formations.list') }}">Voir les formations disponibles.</a></p>
    @else
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-6 mb-4">
                <h4>Mes cours</h4>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-end">
                <form id="search-form" class="d-flex recherche d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search shadow mb-4">
                    <input type="search" name="recherche" id="search-input" class="form-control bg-light border-secondary" 
                        placeholder="Rechercher un cours ..." >
                </form>
            </div>
        </div>
        <div id="categories-container" class="row">
            @foreach ($mesFormations as $cours)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                    <div class="small-box">
                        <div class="inner">
                            <h4>{{ $cours->titre }}</h4>
                        </div>
                        <a href="{{ route('formation.monCours', ['id' => $cours->id]) }}" class="small-box-footer">
                            Lire <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const categoriesContainer = document.getElementById('categories-container');

        function fetchCategories(query) {
            fetch(`/search-categories?recherche=${query}`)
                .then(response => response.json())
                .then(data => {
                    categoriesContainer.innerHTML = '';
                    if (data.length > 0) {
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
                        categoriesContainer.innerHTML = '<div class="card text-align-center">Aucune catégorie trouvée!</div>';
                    }
                })
                .catch(error => console.error('Erreur:', error));
        }

        searchInput.addEventListener('input', function () {
            const query = this.value.trim();
            fetchCategories(query);
        });
    });
</script> --}}
@endsection
