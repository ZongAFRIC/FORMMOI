@extends('layout.appAdmin')
@section('content')
{{-- <h1 class="mt-3 fs-3">Outil admin</h1> --}}
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
    <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
    {{-- <li class="breadcrumb-item fs-5 active">Outil admin</li> --}}
    <li class="breadcrumb-item fs-6 active">Detail de la categorie</li>
</ol>
<div class="card mb-2">
            
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-2">
                <div class="card-header"><h2 class="text-center fs-4 my-4">Detail categorie</h2></div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tbody>
                          <tr>
                            <td colspan="2">Nom categorie :</td>
                            <td>{{ $categorie->nom_categorie}}</td>
                          </tr>

                          <tr>
                            <td colspan="2">Image :</td>
                            <td> <img src="{{ $categorie->image ? asset($categorie->image) : asset('img/user.webp') }}" 
                                alt="Image de la catégorie" 
                                class="img-fluid" 
                                width="70"
                                >
                            </td>
                          </tr>

                          <tr>
                            <td colspan="2">Date d'ajout :</td>
                            <td> {{ $categorie->created_at}} </td>
                          </tr>

                          <tr>
                            <td colspan="2">Date d'edition :</td>
                            <td> {{ $categorie->updated_at}} </td>
                          </tr>
                        </tbody>
                      </table>
                
                </div>

                <a href=" {{ route('categotie.retour')}}" class="btn btn-info"> OK</a>
            
            </div>
        </div>
    </div>
</div>

    
@endsection