@extends('layout.appEtudiant')

@section('content')
    <h4>Mes Commandes</h4>
    <a href=" {{ route('commande.panier') }} " class="btn btn-info">Afficher mon panier</a>
    @if ($commandes->isEmpty())
        <p>Vous n'avez encore aucune commande.</p>
    @else
        <ul>
            @foreach ($commandes as $commande)
                <li>
                    <strong>Commande #{{ $commande->id }}</strong> - 
                    Montant Total : {{ $commande->montant_total }} € - 
                    Statut : {{ $commande->status }}
                    <ul>
                        @foreach ($commande->formations as $formation)
                            <li>{{ $formation->titre }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
