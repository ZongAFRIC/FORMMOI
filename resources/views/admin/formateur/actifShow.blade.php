@extends('layout.appAdmin')
@section('content')
{{-- <h1 class="mt-3 fs-3">Outil admin</h1> --}}
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
    <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item fs-5 "><a href="{{route('admin.gestFormateurs')}}"></a>Gestion formateurs</li>
    <li class="breadcrumb-item fs-5 ">Formateurs actifs</li>
    <li class="breadcrumb-item fs-6 active">Information du formateur</li>
</ol>
<div class="card mb-2">
            
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-2">
                <div class="card-header"><h2 class="text-center fs-4 my-4">Information du formateur</h2></div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tbody>
                          <tr>
                            <td colspan="2">Nom  </td>
                            <td>{{ $validFormateur->nom }}</td>
                          </tr>
                          <tr>
                            <td colspan="2">Prenom  </td>
                            <td>{{ $validFormateur->prenom}}</td>
                          </tr>
                          <tr>
                            <td colspan="2">Email  </td>
                            <td>{{ $validFormateur->email }}</td>
                          </tr>

                          <tr>
                            <td colspan="2">Telephone  </td>
                            <td>{{ $validFormateur->telephone }}</td>
                          </tr>
                          
                          <tr>
                            <td colspan="2">Attestation </td>
                            <td> 
                              @if($validFormateur->attestation)
                                  <a href="{{ asset('storage/' . $validFormateur->attestation) }}" target="_blank" class="fs-6">
                                      Voir l'attestation
                                  </a>
                              @else
                                  <span class="text-muted">Aucune  attestation</span>
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">Cv </td>
                            <td> 
                              @if($validFormateur->cv)
                                  <a href="{{ asset('storage/' . $validFormateur->cv) }}" target="_blank" class="fs-6">
                                      Voir le Cv
                                  </a>
                              @else
                                  <span class="text-muted">Aucun CV </span>
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">Bio :</td>
                            <td> {{ $validFormateur->bio }} </td>
                          </tr>
                        </tbody>
                      </table>
                    
                </div>
                <div class="card-footer item-center d-flex justify-content-between">
                    <a href="mailto:{{ $validFormateur->email }}" class="btn btn-primary"> Envoyer un mail </a>
                    <form action="{{ $validFormateur->status === 'active' ? route('formateur.desactivation', $validFormateur->id) : route('formateur.activation', $validFormateur->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn {{ $validFormateur->status === 'active' ? 'btn-danger' : 'btn-success' }}">
                            {{ $validFormateur->status === 'active' ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>
                </div>
        </div>
    </div>
</div>

    
@endsection