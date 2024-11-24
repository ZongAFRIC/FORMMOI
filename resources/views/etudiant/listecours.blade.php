@extends('layout.appEtudiant')
@section('content')
  <h4>Mes cours</h4>
  <div class="row">
    @if ($mesFormations->isEmpty())
        <p class="text-center">Vous n'avez encore aucun cours. <a href="{{ route('formations.list') }}">Voir les formations disponibles.</a></p>
    @else
        @foreach ($mesFormations as $cours)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                <div class="small-box">
                    <div class="inner">
                        <h4>{{ $cours->titre }}</h4>
                    </div>
                    {{-- <a href="{{ route('etudiant.moncours', ['titre' => urlencode($cours->titre)]) }}" class="small-box-footer">
                        Lire <i class="fas fa-arrow-circle-right"></i>
                    </a> --}}

                    <a href="{{ route('etudiant.moncours', ['id' => $cours->id]) }}" class="small-box-footer">
                      Lire <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
            </div>
        @endforeach
    @endif
  </div>

    
@endsection