@extends(Auth::guard('etudiant')->check() ? 'layout.appEtudiant' : 'layout.appFormateur')

@section('content')
<div class="">
    <h4 class="mb-4">Messagerie</h4>

    <div class="row">
        {{-- Liste des conversations  --}}
        <div class="col-md-3">
            <h4>Conversations</h4>
            <ul class="list-group">
                @foreach ($conversations as $key => $messages)
                    @php
                        list($id, $type) = explode('-', $key);
                        $interlocuteur = $type === 'etudiant' ? \App\Models\Etudiant::find($id) : \App\Models\Formateur::find($id);
                    @endphp
                    
                        <a href="#" class="conversation-link rounded" data-id="{{ $id }}" data-type="{{ $type }}">
                            <li class="list-group-item d-flex justify-content-between fs-6">
                            {{ $interlocuteur->nom }} {{ $interlocuteur->prenom }} ({{ $type }})
                        </a>
                        @if($messages->where('lu', false)->count() > 0)
                            <span class="badge bg-danger">{{ $messages->where('lu', false)->count() }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Zone de message  --}}
        <div class="col-md-9 ">
            <div id="conversation" class="border rounded p-2" style="height: 400px; overflow-y: scroll;">
                <p class="text-muted text-center">Discuter avec vos formateurs</p>
            </div>

            <!-- Formulaire d'envoi -->
            <form id="message-form" class="mt-3 d-none mb-4">
                @csrf
                <input type="hidden" id="recepteur_id">
                <input type="hidden" id="recepteur_type">
                <div class="input-group">
                    <input type="text" id="message-content" class="form-control form-control-lg" placeholder="Écrivez votre message...">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
            <br>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.conversation-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                let userId = this.dataset.id;
                let userType = this.dataset.type;
                
                fetch(`/messages/${userId}/${userType}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('conversation').innerHTML = html;
                        document.getElementById('message-form').classList.remove('d-none');
                        document.getElementById('recepteur_id').value = userId;
                        document.getElementById('recepteur_type').value = userType;
                    });
            });
        });

        document.getElementById('message-form').addEventListener('submit', function (e) {
            e.preventDefault();
            let messageContent = document.getElementById('message-content').value;
            let recepteurId = document.getElementById('recepteur_id').value;
            let recepteurType = document.getElementById('recepteur_type').value;

            fetch('/messages/envoyer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ contenu: messageContent, recepteur_id: recepteurId, recepteur_type: recepteurType })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    let newMessage = document.createElement('div');
                    newMessage.classList.add('text-end', 'p-2', 'bg-light', 'mb-2', 'rounded');
                    newMessage.textContent = messageContent;
                    document.getElementById('conversation').appendChild(newMessage);
                    document.getElementById('message-content').value = '';
                }
            });
        });
    });
</script>
@endsection
