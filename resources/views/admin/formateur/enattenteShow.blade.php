@extends('layout.appAdmin')
@section('content')
{{-- <h1 class="mt-3 fs-3">Outil admin</h1> --}}
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
    <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item fs-5 "><a href="{{route('admin.gestFormateurs')}}"></a>Gestion formateurs</li>
    <li class="breadcrumb-item fs-5 ">Formateurs en attente</li>
    <li class="breadcrumb-item fs-6 active">Information du demandeur</li>
</ol>
<div class="card mb-2">
            
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-lg mt-2">
                <div class="card-header"><h2 class="text-center fs-4 my-4">Information du demandeur</h2></div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tbody>
                          <tr>
                            <td colspan="2">Nom  :</td>
                            <td>{{ $invalidFormateur->nom}}</td>
                          </tr>

                          <tr>
                            <td colspan="2">Prenom  :</td>
                            <td>{{ $invalidFormateur->prenom}}</td>
                          </tr>

                          <tr>
                            <td colspan="2">Email  :</td>
                            <td>{{ $invalidFormateur->email}}</td>
                          </tr>

                          {{-- <tr>
                            <td colspan="2">Image :</td>
                            <td> <img src="{{ $invalidFormateur->image ? asset($invalidFormateur->image) : asset('img/user.webp') }}" 
                                alt="Image de la catégorie" 
                                class="img-fluid" 
                                width="70"
                                >
                            </td>
                          </tr> --}}

                          <tr>
                            <td colspan="2">Attestation :</td>
                            <td> {{ $invalidFormateur->attestation}} </td>
                          </tr>

                          <tr>
                            <td colspan="2">Cv :</td>
                            <td> {{ $invalidFormateur->cv}} </td>
                          </tr>

                          <tr>
                            <td colspan="2">Bio :</td>
                            <td> {{ $invalidFormateur->bio}} </td>
                          </tr>
                        </tbody>
                      </table>
                
                      <form action="{{ route('admin.validerFormateur', $invalidFormateur->id) }}" method="POST">
                        @csrf
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="formateur-{{ $invalidFormateur->id }}"
                                name="is_validated" value="1" onchange="this.form.submit()" {{ $invalidFormateur->is_validated ? 'checked' : '' }}>
                            <label class="form-check-label" for="formateur-{{ $invalidFormateur->id }}">Valider le demandeur</label>
                        </div>
                    </form>
                </div>

                <a href="mailto"></a>

                <a href=" {{ route('categotie.retour')}}" class="btn btn-warning"> Annuler</a>
            
            </div>
        </div>
    </div>
</div>

    
@endsection