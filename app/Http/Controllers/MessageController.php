<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Etudiant;
use App\Models\Formateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Déterminer l'utilisateur authentifié (étudiant ou formateur)
     */
    private function getAuthUser()
    {
        if (auth()->guard('etudiant')->check()) {
            return auth()->guard('etudiant')->user();
        } elseif (auth()->guard('formateur')->check()) {
            return auth()->guard('formateur')->user();
        }
        return null;
    }

    /**
     * Afficher la liste des conversations
     */
    public function index()
    {
        $user = $this->getAuthUser();
        if (!$user) return abort(403, "Non autorisé");

        // Récupération des conversations
        $conversations = Message::where('expediteur_id', $user->id)
            ->where('expediteur_type', get_class($user) == Etudiant::class ? 'etudiant' : 'formateur')
            ->orWhere('recepteur_id', $user->id)
            ->where('recepteur_type', get_class($user) == Etudiant::class ? 'etudiant' : 'formateur')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($message) use ($user) {
                return $message->expediteur_id == $user->id
                    ? $message->recepteur_id . '-' . $message->recepteur_type
                    : $message->expediteur_id . '-' . $message->expediteur_type;
            });

        return view('messages.index', compact('conversations'));
    }

    public function chatterAvec()
    {
        $user = $this->getAuthUser();
        if (!$user) return abort(403, "Non autorisé");

        // Récupération des conversations
        $conversations = Message::where('expediteur_id', $user->id)
            ->where('expediteur_type', get_class($user) == Etudiant::class ? 'etudiant' : 'formateur')
            ->orWhere('recepteur_id', $user->id)
            ->where('recepteur_type', get_class($user) == Etudiant::class ? 'etudiant' : 'formateur')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($message) use ($user) {
                return $message->expediteur_id == $user->id
                    ? $message->recepteur_id . '-' . $message->recepteur_type
                    : $message->expediteur_id . '-' . $message->expediteur_type;
            });

        return view('messages.index', compact('conversations'));
    }

    /**
     * Charger une conversation et marquer les messages comme lus
     */
    public function chargerMessages($user_id, $user_type)
    {
        $user = $this->getAuthUser();
        if (!$user) return abort(403, "Non autorisé");

        // Vérifier le type pour charger le bon modèle
        $model = $user_type === 'etudiant' ? Etudiant::class : Formateur::class;
        $interlocuteur = $model::findOrFail($user_id);

        // Charger les messages
        $messages = Message::where(function ($query) use ($user, $user_id, $user_type) {
            $query->where('expediteur_id', $user->id)
                ->where('expediteur_type', get_class($user) == Etudiant::class ? 'etudiant' : 'formateur')
                ->where('recepteur_id', $user_id)
                ->where('recepteur_type', $user_type);
        })->orWhere(function ($query) use ($user, $user_id, $user_type) {
            $query->where('expediteur_id', $user_id)
                ->where('expediteur_type', $user_type)
                ->where('recepteur_id', $user->id)
                ->where('recepteur_type', get_class($user) == Etudiant::class ? 'etudiant' : 'formateur');
        })->orderBy('created_at', 'asc')->get();

        // Marquer comme lus
        Message::where('expediteur_id', $user_id)
            ->where('expediteur_type', $user_type)
            ->where('recepteur_id', $user->id)
            ->where('recepteur_type', get_class($user) == Etudiant::class ? 'etudiant' : 'formateur')
            ->where('lu', false)
            ->update(['lu' => true]);

        return view('messages.conversation', compact('messages', 'interlocuteur'));
    }

    /**
     * Envoyer un message
     */
    public function envoyerMessage(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
            'recepteur_id' => 'required|integer',
            'recepteur_type' => 'required|string|in:etudiant,formateur'
        ]);

        $user = $this->getAuthUser();
        if (!$user) return abort(403, "Non autorisé");

        if ($user->id == $request->recepteur_id && get_class($user) == ($request->recepteur_type == 'etudiant' ? Etudiant::class : Formateur::class)) {
            return response()->json(['error' => 'Vous ne pouvez pas vous envoyer un message à vous-même'], 403);
        }

        $message = Message::create([
            'contenu' => $request->contenu,
            'expediteur_id' => $user->id,
            'expediteur_type' => get_class($user) == Etudiant::class ? 'etudiant' : 'formateur',
            'recepteur_id' => $request->recepteur_id,
            'recepteur_type' => $request->recepteur_type,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        // return response()->json(['message' => 'Message envoyé avec succès!', 'data' => $message]);
        return back()->with('success', 'Message envoyé avec succès!');
    }
}
