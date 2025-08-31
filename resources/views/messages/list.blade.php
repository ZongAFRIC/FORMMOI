<div class="messages-list">
    @foreach($messages as $message)
        <div class="message {{ $message->expediteur_id == auth()->id() ? 'sent' : 'received' }}">
            <p>{{ $message->contenu }}</p>
            <small>{{ $message->created_at->diffForHumans() }}</small>
        </div>
    @endforeach
</div>

<style>
    .messages-list {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #ccc;
        padding: 10px;
    }

    .message {
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 5px;
    }

    .sent {
        background: #dcf8c6;
        text-align: right;
    }

    .received {
        background: #f1f1f1;
        text-align: left;
    }
</style>
