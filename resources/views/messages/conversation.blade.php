@foreach ($messages as $message)
    @if ($message->expediteur_id == auth()->id())
        <div class="text-end p-2 bg-info rounded">
            {{ $message->contenu }}
        </div>
        <small class=" h6 text-end d-block">
            {{ $message->created_at->format('d-m-y') }} à {{ $message->created_at->format('H:i') }} ||
            @if ($message->lu)
                <span class="text-success">✓ Lu</span>
            @else
                <span class="text-muted">✓ Envoyé</span>
            @endif
        </small>
    @else
        <div class="text-start p-2 bg-primary text-white mb-2 mt-2 rounded">
            {{ $message->contenu }}
        </div>
        <small class="d-block h6">
            {{ $message->created_at->format('d-m-y') }} à {{ $message->created_at->format('H:i') }}
        </small>
    @endif
@endforeach
