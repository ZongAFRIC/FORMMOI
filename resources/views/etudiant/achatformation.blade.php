@extends('layout.appEtudiant')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Paiement</h2>

    <!-- Détails de la Formation ou de la Commande -->
    @if (isset($formation))
        <div class="card mb-4">
            <div class="card-header">Détails de la Formation</div>
            <div class="card-body">
                <h5>{{ $formation->titre }}</h5>
                <p>Description : {{ $formation->description }}</p>
                <p>Durée : {{ $formation->duree }} heures</p>
                <p>Prix : {{ $formation->prix }} XOF</p>
            </div>
        </div>
    @elseif (isset($commande))
        <div class="card mb-4">
            <div class="card-header">Détails de la Commande</div>
            <div class="card-body">
                <h5>Commande #{{ $commande->id }}</h5>
                <p>Nombre de formations : {{ $commande->formations->count() }}</p>
                <p>Total : {{ $commande->montant_total }} XOF</p>
            </div>
        </div>
    @endif

    <!-- Formulaire de Paiement -->
    <form action="{{ route('formation.achat', ['formation_id' => $formation->id]) }}" method="POST">
        @csrf

        @if (isset($formation))
            <input type="hidden" name="formation_id" value="{{ $formation->id }}">
        @elseif (isset($commande))
            <input type="hidden" name="commande_id" value="{{ $commande->id }}">
        @endif

        <input type="hidden" name="etudiant_id" value="{{ auth('etudiant')->id() }}">
        <div class="form-group mb-3">
            <label for="montant">Montant (XOF)</label>
            <input type="number" class="form-control" id="montant" name="montant" 
                value="{{ $formation->prix ?? $commande->total }}" readonly>
        </div>
        
        <div class="form-group mb-3">
            <label for="methode">Méthode de Paiement</label>
            <select class="form-control" id="methode" name="methode" required>
                <option value="" disabled selected>Choisir une méthode</option>
                <option value="Carte Bancaire">Carte Bancaire</option>
                <option value="Mobile Money">Mobile Money</option>
                <option value="PayPal">PayPal</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Confirmer le Paiement</button>
    </form>
</div>
@endsection
