@extends(Auth::guard('etudiant')->check() ? 'layout.appEtudiant' : (Auth::guard('formateur')->check() ? 'layout.appFormateur' : 'layout.default'))

@section('content')
<div class="container">
    <h3 class="mt-3 fs-3">Achat</h3>
    <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-3">
        <li class="breadcrumb-item fs-5"><a href="{{ url()->previous() }}">Achat</a></li>
        <li class="breadcrumb-item fs-5 active">MoovMoney</li>
    </ol>

    <p>Vous allez effectuer un paiement pour la formation : <strong>{{ $formation->titre }}</strong></p>

    <form method="POST" action="{{ route('paiement.processus') }}">
        @csrf
        <!-- ID de la formation -->
        <input type="hidden" name="formation_id" value="{{ $formation->id }}">
        <input type="hidden" name="method" value="moov_money">

        <!-- Prix de la formation -->
        <div class="form-group">
            <label for="prix">Prix de la formation :</label>
            <input type="text" name="prix" id="prix" class="form-control" 
                   value="{{ $formation->prix ?? $commande->total }}" readonly>
        </div>

        <div>
            <p> Composez sur votre telephone <span style="color: green">*555*4*6*{{ $formation->prix ?? $commande->total }}#</span> suivez lzs intructions pour recevoir votre code otp. </p>
        </div>

        <!-- Montant saisi -->
        <div class="form-group mt-3">
            <label for="montant">Montant :</label>
            <input type="text" name="montant" id="montant" class="form-control" required>
            <small id="validationMessage" class="form-text text-danger"></small>
        </div>

        <!-- Bouton de validation -->
        <button type="submit" class="btn btn-primary mt-3">Valider le paiement</button>
    </form>
</div>

<!-- Validation JavaScript -->
<script>
    document.getElementById('montant').addEventListener('input', function () {
        const prixFormation = parseFloat(document.getElementById('prix').value);
        const montantSaisi = parseFloat(this.value);
        const validationMessage = document.getElementById('validationMessage');

        if (isNaN(montantSaisi) || montantSaisi < prixFormation) {
            validationMessage.textContent = "Le montant doit être supérieur ou égal au prix de la formation.";
            this.classList.add('border-danger');
            this.classList.remove('border-success');
        } else {
            validationMessage.textContent = "";
            this.classList.add('border-success');
            this.classList.remove('border-danger');
        }
    });
</script>
@endsection
