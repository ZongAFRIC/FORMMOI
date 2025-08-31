@extends('layout.appFormateur')
@section('content')

    <div class="container">
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

        <p> Mode de paiement</p>
        <div class="modePaiementImg">
            <div class="button"> 
                <img src="{{asset('img/logoOM.png')}}" alt="OM"> 
                <div class="button-title">Orange Money</div> 
            </div> 
            
            <div class="button">
                <img src="{{asset('img/logoMoov.png')}}" alt="Moov"> 
                <div class="button-title">Moov Money</div> 
            </div> 
            
            <div class="button"> 
                <img src="{{asset('img/telecelMoney.webp')}}" alt="Telecel Money"> 
                <div class="button-title">Telecel Money</div> 

            </div> <div class="button"> 
                <img src="{{asset('img/sank.png')}}" alt="Sank"> 
                <div class="button-title">Sank Money</div> 
            </div> 

            <div class="button"> 
                <img src="{{asset('img/corisMoney.png')}}" alt="Coris Money"> 
                <div class="button-title">Coris Money</div> 
            </div> 
            
            <div class="button"> 
                <img src="{{asset('img/wave.png')}}" alt="Wave"> 
                <div class="button-title">Wave</div> 
            </div>
        </div>
        
    </div>
    
@endsection