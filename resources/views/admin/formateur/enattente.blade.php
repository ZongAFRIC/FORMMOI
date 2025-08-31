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
                @if (isset($invalidFormateurs) && $invalidFormateurs->count() > 0) 

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
                        @foreach ($invalidFormateurs as $invalid)
                            <tr>
                                <td> {{ $invalid->id }} </td>
                                <td> {{ $invalid->nom }} </td>
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
                                        <div class="">
                                            <a href="{{ route('attente.detail',$invalid->id)}}" class="btn btn-success">Voir</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    
                </tbody>
                @else
                        <tr>
                            <td colspan="8">00 formateur en attente dans la base de données.</td>
                        </tr>
                @endif
            </table>

        </div>
    </div>
</div>
    
@endsection