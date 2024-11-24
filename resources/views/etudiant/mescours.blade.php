@extends('layout.appEtudiant')
@section('content')
    <h1> Mes cours</h1>

    <ul>
        @foreach ($mesFormations as $cours)
            <li>{{ $cours->titre }}
                <a href="{{ route('forma.detail', $cours->id) }}">Accéder</a>
            </li>
        @endforeach
    </ul>

    
@endsection