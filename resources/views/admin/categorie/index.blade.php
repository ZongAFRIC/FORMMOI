@extends('layout.appAdmin')
@section('content')

    <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mt-2 mb-3">
        <li class="breadcrumb-item "><a href="/admin/dashboard" class="fs-5">Dashboard</a></li>
        <li class="breadcrumb-item fs-5 active">Categorie</li>
    </ol>
    <div class="card mb-1">

    </div>
    <div class="card mb-2 d-flex">
        <a class="btn btn-primary add form-control-lg fs-5" href="{{ route('categorie.create') }}"><i class="fas fa-plus me-2"></i> Categorie</a>
    </div>

    <div class="container">
            <div class="container-fluid px-4">
            
                <div class="card mb-4">
                    <div class="card-header fs-5">
                        <i class="fas fa-table me-1"></i> Liste categorie
                    </div>
                    <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                {{-- <th>Image</th> --}}
                                <th>Date d'enregistrement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($categories) && $categories->count() > 0) 
                                @foreach ($categories as $cat)
                                    <tr>
                                        <td> {{ $cat->id }} </td>
                                        <td> {{ $cat->nom_categorie }} </td>
                                        {{-- <td> 
                                            <a href="#">
                                                <img src="{{ $cat->image ? asset($cat->image) : asset('img/user.webp') }}" 
                                                alt="Image de la catégorie" 
                                                class="img-fluid" 
                                                width="30"
                                                data-bs-toggle="modal" data-bs-target="#imageModal">
                                            </a>
                                        </td> --}}
                                        <td> {{ $cat->created_at }} </td>
                                                
                                        <td class="text-center">
                                            <a  href="{{ route('categorie.detail',$cat->id)}}" class="btn btn-success btn-circle btn-sm"><i class="fas fa-arrows-to-eye"></i></a> 
                                            <a  href="{{ route('categorie.edit',$cat->id)}}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-user-edit"></i></a> 
                                            <a  href="{{ route('categorie.delete',$cat->id)}}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
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
        </div>
        <div class="card mb-2 d-flex">
        </div>
    </div>
    
@endsection