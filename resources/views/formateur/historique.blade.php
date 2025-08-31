<style>
    .hover-shadow:hover {
        transform: scale(1.05);
        transition: all 0.3s ease-in-out;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        background-color: #e4e2e2ea;
        color: black;
    }
</style>

@extends('layout.appFormateur')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ma caisse</h1>

        <h1 class="h3 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            {{ $formateur->solde }} XOF 
        </h1>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @forelse($paiements as $paiement)
            @php
                $commission = 0.10; // 10% de commission pour la plateforme
                $solde = $paiement->montant * (1 - $commission); // Calcul du solde du formateur
            @endphp
            <div class="col-md-4">
                <div class="card shadow-sm p-3 hover-shadow">
                    <div class="card-header">
                        <h5 class="fw-bold card-title"> Detail de la transaction</h5>
                    </div>
                    <div class="card-body">
                        <p class="">💰 Prix : {{ number_format($paiement->montant, 0, ',', ' ') }} XOF</p>
                        <p class="">💵 Réçu: {{ number_format($solde, 0, ',', ' ') }} XOF   (90%)</p>
                        <p>📅 Date et heure: {{ \Carbon\Carbon::parse($paiement->date)->format('d/m/Y H:i') }}</p>
                        <p>💳 Moyen de paiement: {{ ucfirst($paiement->methode) }}</p>
                        <p>
                            📌Statut : {{ ucfirst($paiement->status) }}
                        </p>
                        <p>📚Formation :  {{ $paiement->formation ? $paiement->formation->titre : 'N/A' }}</p>
                        <p>
                            👤 Acheteur : 
                            @if($paiement->etudiant)
                                {{ $paiement->etudiant->prenom }} {{ $paiement->etudiant->nom }} (Étudiant)
                            @else
                                {{ $paiement->formateur->nom }} {{ $paiement->formateur->prenom }} (Formateur)
                            @endif
                        </p>
                        {{-- <a href="#" class="text-success">Voir détails ></a> --}}
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Vous n'avez aucun paiement pour le moment.</div>
        @endforelse
    </div>

@endsection