@extends('layout.appEtudiant')
@section('content')
  
  <div class="row">
    @if ($mesFormations->isEmpty())
        @if ( auth()->guard('etudiant')->user()->status === 'active')
            <p class="text-center">Vous n'avez encore aucun cours. <a href="{{ route('formations.list') }}">Voir les formations disponibles.</a></p>
        @else
            <p class="text-center">Vous n'avez encore aucun cours.</p>
        @endif

    @else

        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-6 mb-4">
                <h4>Mes cours</h4>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-end">
                <form id="search-form" class="d-flex recherche d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search shadow mb-4">
                <input type="search" name="recherche" id="search-input" class="form-control bg-light border-secondary" placeholder="Rechercher un cours ...">
            </form>
            </div>
        </div>
        @foreach ($mesFormations as $cours)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4>{{ $cours->titre }}</h4>
                    </div>

                    <a href="{{ route('formation.monCours', ['id' => $cours->id]) }}" class="small-box-footer">
                      Lire <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
            </div>
        @endforeach
    @endif
  </div>

  @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const coursContainer = document.getElementById('cours-container');

            searchInput.addEventListener('input', function() {
                const query = this.value;
                fetch(`{{ route('search-cours') }}?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        let coursHtml = '';
                        data.forEach(cours => {
                            coursHtml += `
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h4>${cours.titre}</h4>
                                        </div>
                                        <a href="{{ route('formation.monCours', ['id' => '${cours.id}']) }}" class="small-box-footer">
                                            Lire <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            `;
                        });
                        coursContainer.innerHTML = coursHtml;
                    });
            });
        });
    </script>
    @endpush
@endsection