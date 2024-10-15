@extends('layout.appFormateur')

@section('content')
<h1 class="mt-2 fs-3">Mes formations</h1>
<ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mt-2 mb-3">
    <li class="breadcrumb-item "><a href="#" class="fs-5">Dashboard</a></li>
    <li class="breadcrumb-item fs-5 active">Mes formations</li>
</ol>
<div class="card mb-1">

</div>
<div class="card mb-2 d-flex">
    <a class=" btn btn-primary add" href="{{ route('create.formation') }}"><i class="fa-solid fa-user-plus"></i> Créer un formation</a>
</div>

{{-- @if(Session::has('success'))
      <div class="card ">
        {{ Session::get('success') }}
      </div>
@endif --}}


{{-- <div class="container"> --}}
    <div class="container-fluid px-4">
       
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> Liste personnel
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Service</th>
                            <th>Numero</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @if (isset($users) && $users->count() > 0) 
                            @foreach ($users as $user)
                                    <tr>
                                        <td> {{ $user->matricule }} </td>
                                        <td> {{ $user->name }} </td>
                                        <td> {{ $user->prenom }} </td>
                                        <td> {{ $user->service }} </td>
                                        <td> {{ $user->numero }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td><a  href="{{ route('personnel-detail',$user->id)}}" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-arrows-to-eye"></i></a> 
                                            <a  href="{{ route('personnel-edit',$user->id)}}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-user-edit"></i></a> 
                                            <a  href="{{ route('personnel-delete',$user->id)}}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                            @endforeach
                         @else
                            <tr>
                                <td colspan="6">00 utilisateur dans la base de données.</td>
                            </tr>

                        @endif
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
    
@endsection