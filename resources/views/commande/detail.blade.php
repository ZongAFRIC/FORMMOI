@extends('layout.appEtudiant')
@section('content')
    
<div class="container mt-4">
    <h4>Détails de la commande</h4>

    <!-- Affichage des détails de la commande -->
    <div class="mb-4">
        <h5>Commande ID: {{ $commande->id }}</h5>
        <p>Status: {{ $commande->status }}</p>
        <p>Total: {{ $commande->total }} XOF</p>
        <p>Type d'utilisateur: {{ ucfirst($commande->type_utilisateur) }}</p>
        {{-- <p>Utilisateur: {{ $commande->utilisateur->name }}</p> --}}
    </div>

    <!-- Affichage des formations liées à cette commande -->
    <h5>Formations associées :</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Prix</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commande->formations as $formation)
                <tr>
                    <td>{{ $formation->titre }}</td>
                    <td>{{ $formation->prix }} XOF</td>
                    <td>1</td> <!-- Vous pouvez afficher la quantité si elle est stockée dans une colonne supplémentaire -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('commandes.etudiant') }}" class="btn btn-secondary">Retour à la liste des commandes</a>
</div>


@endsection