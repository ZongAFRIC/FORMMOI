@extends('layout.appAdmin')
@section('content')
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
    <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item fs-5 "> <a href="/admin/gestion-categorie">Catégorie</a></li>
    <li class="breadcrumb-item fs-5 active">Ajouter une catégorie</li>
</ol>
<div class="card mb-2">
            
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h2 class="text-center fs-4 my-4">Ajouter une catégorie</h2></div>
                <div class="card-body">
                    {{-- @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif --}}
                    
                    <form method="POST" action="/admin/gerer-categorie/store">
                        @csrf
                        {{-- <div class="col-md-12">
                            <div class="form-floating">
                                <input class="form-control" name="nom_categorie" id="" type="text" placeholder="Nom" required/>
                                <label for="">Nom catégorie</label>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <div class=" mb-3 mb-sm-0">
                                <label for="Nom" class="fs-4">Nom de la categorie</label>
                                <input type="text" class="form-control form-control-user form-control-lg" placeholder=" ~ Nom de la categorie" name="nom_categorie" required autofocus autocomplete="nom_categorie">
                            </div>
                        </div>

                        {{-- <div class="col-md-12">
                            <div class="form-floating">
                                <input class="form-control" name="image" id="" type="hidden" placeholder="Image" />
                                <label for="">Image de la categorie</label>
                            </div>
                        </div> --}}
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button class="btn btn-primary form-control-lg fs-4">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br>
@endsection