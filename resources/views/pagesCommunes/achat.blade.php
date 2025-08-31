@extends(Auth::guard('etudiant')->check() ? 'layout.appEtudiant' : (Auth::guard('formateur')->check() ? 'layout.appFormateur' : 'layout.default'))

@section('content')
    <div class="container">
        <h3 class="mt-3 fs-3">Achat</h3>
        <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
            <li class="breadcrumb-item fs-5"><a href="{{ url()->previous() }}">Formations</a></li>
            <li class="breadcrumb-item fs-5 active">Achat</li>
        </ol>

        {{-- @if (Auth::guard('etudiant')->check())
            <p>Connecté en tant qu'étudiant</p>
        @elseif (Auth::guard('formateur')->check())
            <p>Connecté en tant que formateur</p>
        @else
            <p>Non connecté</p>
        @endif --}}

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

        <p> Mode de paiement</p>
        <div class="modePaiementImg">
        <div class="button"> 
            <a href="{{ route('paiement.orange-money', ['formation_id' => $formation->id ?? $commande->id]) }}">
                <img src="{{ asset('img/logoOM.png') }}" alt="OM"> 
                <div class="button-title">Orange Money</div>
            </a>
        </div> 
        <div class="button">
            <a href="{{ route('paiement.moov-money', ['formation_id' => $formation->id ?? $commande->id]) }}">
                <img src="{{ asset('img/logoMoov.png') }}" alt="Moov"> 
                <div class="button-title">Moov Money</div>
            </a>
        </div> 
        <div class="button"> 
            <a href="{{ route('paiement.telecel-money', ['formation_id' => $formation->id ?? $commande->id]) }}">
                <img src="{{ asset('img/telecelMoney.webp') }}" alt="Telecel Money"> 
                <div class="button-title">Telecel Money</div> 
            </a>
        </div>
        <div class="button"> 
            <a href="{{ route('paiement.sank-money', ['formation_id' => $formation->id ?? $commande->id]) }}">
                <img src="{{ asset('img/sank.png') }}" alt="Sank"> 
                <div class="button-title">Sank Money</div> 
            </a>
        </div>
        <div class="button"> 
            <a href="{{ route('paiement.coris-money', ['formation_id' => $formation->id ?? $commande->id]) }}">
                <img src="{{ asset('img/corisMoney.png') }}" alt="Coris Money"> 
                <div class="button-title">Coris Money</div> 
            </a>
        </div>
        <div class="button"> 
            <a href="{{ route('paiement.wave', ['formation_id' => $formation->id ?? $commande->id]) }}">
                <img src="{{ asset('img/wave.png') }}" alt="Wave"> 
                <div class="button-title">Wave</div> 
            </a>
        </div>
    </div>

    </div>
@endsection
