@extends('layout.appAdmin')
@section('content')
{{-- <h1 class="mt-3 fs-3">Outils admin</h1> --}}
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
    <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item fs-5 "><a href="{{route('admin.gestFormateurs')}}"></a>Gestion formateurs</li>
    <li class="breadcrumb-item fs-5 active">Formateurs actifs</li>
</ol>
<div class="card mb-2">
            
</div>
<div class="">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Liste formateurs actifs
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($validFormateurs) && $validFormateurs->count() > 0) 
                        @foreach ($validFormateurs as $valid)
                            <tr>
                                <td> {{ $valid->id }} </td>
                                <td> {{ $valid->nom }} </td>
                                {{-- <td> 
                                    <a href="#">
                                        <img src="{{ $cat->image ? asset($cat->image) : asset('img/user.webp') }}" 
                                        alt="Image de la catégorie" 
                                        class="img-fluid" 
                                        width="30"
                                        data-bs-toggle="modal" data-bs-target="#imageModal">
                                    </a>
                                </td> --}}
                                <td> {{ $valid->prenom }} </td>
                                <td> {{ $valid->telephone }} </td>
                                <td> {{ $valid->email }} </td>
                                <td> {{ $valid->status }} </td>
                                        
                                <td class="text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <a href="{{ route('categorie.detail',$valid->id)}}" class="btn btn-success btn-circle btn-sm"><i class="fas fa-arrows-to-eye"></i></a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('categorie.edit',$valid->id)}}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-user-edit"></i></a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('categorie.delete',$valid->id)}}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">00 categorie dans la base de données.</td>
                        </tr>
                    @endif
                            <!-- Modal -->
            {{-- <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                    <img src="{{ $cat->image ? asset($cat->image) : asset('img/user.webp') }}" 
                        alt="Image agrandie de la catégorie" 
                        class="img-fluid">
                    </div>
                </div>
                </div>
            </div> --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection