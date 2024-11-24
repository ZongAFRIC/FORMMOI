@extends('layout.appEtudiant')

@section('content')
<div class="container mt-4">
    <h4>Votre panier</h4>

    @if ($formations->isEmpty())
        <p>Votre panier est vide. <a href="{{ route('formations.list') }}">Voir les formations disponibles</a>.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Formation</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formations as $formation)
                    <tr>
                        <td>{{ $formation->titre }}</td>
                        <td>{{ $formation->prix }} XOF</td>
                        <td>
                            <form action="{{ route('panier.retirer', ['formation_id' => $formation->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Retirer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ $total }} XOF</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <!-- Formulaire pour valider le panier -->
        <form action="{{ route('commande.valider') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Valider le panier</button>
        </form>
    @endif
</div>
@endsection
