@extends('layout.appAdmin')
@section('content')
{{-- <h1 class="mt-3 fs-3">Outil admin</h1> --}}
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
    <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
    {{-- <li class="breadcrumb-item fs-5 active">Outil admin</li> --}}
    <li class="breadcrumb-item fs-5 active">Editer categorie</li>
</ol>
<div class="card mb-2">
            
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h2 class="text-center fs-4 my-4">Modifier categorie</h2></div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('categorie.update',$categorie->id)}}">
                        @csrf
                        @method('PUT')
                        
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input class="form-control" name="nom_categorie" id="" type="text" value="{{ $categorie->nom_categorie }}" placeholder="Nom" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <img src="{{ $categorie->image ? asset('storage/' . $categorie->image) : asset('img/user.webp') }}" alt="Image de la catégorie" class="img-fluid mb-2" width="30"                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection