@extends('layout.appAdmin')
@section('content')
{{-- <h1 class="mt-3 fs-3">Outils admin</h1> --}}
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
    <li class="breadcrumb-item fs-5"><a href="/admin/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item fs-5 "><a href="{{route('admin.gestFormateurs')}}"></a>Gestion formateurs</li>
    <li class="breadcrumb-item fs-5 active">Formateurs en attente</li>
</ol>
<div class="card mb-2">
            
</div>
<div class="container">
    <div class="container-fluid px-4">
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Liste formateurs en attente
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
                        <th>Etat</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($invalidFormateurs) && $invalidFormateurs->count() > 0) 
                        @foreach ($invalidFormateurs as $invalid)
                            <tr>
                                <td> {{ $invalid->id }} </td>
                                <td> {{ $invalid->nom }} </td>
                                {{-- <td> 
                                    <a href="#">
                                        <img src="{{ $cat->image ? asset($cat->image) : asset('img/user.webp') }}" 
                                        alt="Image de la catégorie" 
                                        class="img-fluid" 
                                        width="30"
                                        data-bs-toggle="modal" data-bs-target="#imageModal">
                                    </a>
                                </td> --}}
                                <td> {{ $invalid->prenom }} </td>
                                <td> {{ $invalid->telephone }} </td>
                                <td> {{ $invalid->email }} </td>
                                <td> 
                                    <form action="{{ route('admin.validerFormateur', $invalid->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="formateur-{{ $invalid->id }}"
                                                name="is_validated" value="1" onchange="this.form.submit()" {{ $invalid->is_validated ? 'checked' : '' }}>
                                            <label class="form-check-label" for="formateur-{{ $invalid->id }}">Valider</label>
                                        </div>
                                    </form>
                                </td>
                                <td> {{ $invalid->status }} </td>
                                        
                                <td class="text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <a href="{{ route('attente.detail',$invalid->id)}}" class="btn btn-success btn-circle btn-sm"><i class="fas fa-arrows-to-eye"></i></a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route('categorie.edit',$invalid->id)}}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-user-edit"></i></a>
                                        </div>
                                        {{-- <div class="col-auto">
                                            <a href="{{ route('categorie.delete',$invalid->id)}}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                        </div> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">00 formateur en attente dans la base de données.</td>
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