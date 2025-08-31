@extends(Auth::guard('etudiant')->check() ? 'layout.appEtudiant' : (Auth::guard('formateur')->check() ? 'layout.appFormateur' : 'layout.default'))

@section('content')
<div class="row">
    @if ($mesFormations->isEmpty())
        <p class="text-center ard text-danger">Vous n'avez encore aucun cours. <a href="{{ route('formations.list') }}">Voir les formations disponibles.</a></p>
    @else
        <div class="row bg-body-tertiary rounded-3">
            <div class="col-lg-8 col-md-8 col-sm-6 mb-4">
                <h4>Mes cours : [ <span id="cours-count">{{ $mesformationCount }}</span> ]</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 mb-4 d-flex justify-content-end">
                <form id="search-form" class="d-flex recherche d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search shadow mb-4">
                    <input type="search" name="recherche" id="search-input" class="form-control bg-light border-secondary" placeholder="Rechercher un cours...">
                    <span id="search-loader" class="spinner-border spinner-border-sm text-primary ml-2 d-none" role="status" aria-hidden="true"></span>
                </form>
            </div>
        </div>
        
        <div id="cours-container" class="row">
            @foreach ($mesFormations as $cours)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4>{{ $cours->titre }}</h4>
                            <div class="d-flex justify-content-between">
                                <span class="fs-6"><i class="fas fa-clock"></i> {{ $cours->duree }} H</span> 
                                <span class="fs-6"><i class="fas fa-star"></i> 
                                    {{ $cours->moyenne_notes ? number_format($cours->moyenne_notes, 1) : 'Aucune note' }}
                                </span>
                            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const coursContainer = document.getElementById('cours-container');
        const coursCount = document.getElementById('cours-count');
        const searchLoader = document.getElementById('search-loader');
        let initialHtml = coursContainer.innerHTML;
        let initialCount = parseInt(coursCount.textContent);

        function fetchCours(query) {
            if (!query) {
                coursContainer.innerHTML = initialHtml;
                coursCount.textContent = initialCount;
                return;
            }

            searchLoader.classList.remove('d-none');
            fetch(`{{ route('search-cours') }}?recherche=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    coursContainer.innerHTML = '';
                    coursCount.textContent = data.length;

                    if (data.length > 0) {
                        data.forEach(cours => {
                            coursContainer.insertAdjacentHTML('beforeend', `
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="small-box">
                                        <div class="inner">
                                            <h4>${cours.titre}</h4>
                                            <div class="d-flex justify-content-between">
                                                <span><i class="fas fa-clock"></i> ${cours.duree} H</span>
                                                <span><i class="fas fa-star"></i> ${cours.moyenne_notes ? Number(cours.moyenne_notes).toFixed(1) : 'Aucune note'}</span>
                                            </div>
                                        </div>
                                        <a href="${cours.url}" class="small-box-footer">Lire <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        coursContainer.innerHTML = `<div class="col-12 text-center text-danger">Aucun résultat trouvé</div>`;
                    }
                })
                .catch(err => {
                    coursContainer.innerHTML = `<div class="col-12 text-center text-danger">Erreur : ${err.message}</div>`;
                })
                .finally(() => {
                    searchLoader.classList.add('d-none');
                });
        }

        let debounceTimer;
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                fetchCours(this.value.trim());
            }, 300);
        });
    });

</script>

@endsection