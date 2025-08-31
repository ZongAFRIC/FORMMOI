<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class GestFormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $formation = Formation::findOrFail($id);
        $formation = Formation::with('chapitres')->findOrFail($id);
        $nombreChapitres = $formation->chapitres->count();

        // // Calculer la moyenne des notes pour chaque formation
        // foreach ($formation as $formation) {
        //     $notes = $formation->chapitres->flatMap(function ($chapitre) {
        //         return $chapitre->avis->whereNotNull('note')->pluck('note');
        //     });

        //     // Stocker la moyenne dans un attribut temporaire
        //     $formation->moyenne_notes = $notes->isNotEmpty() ? number_format($notes->avg(), 2) : null;
        // }

        return view('admin.formation.show', compact('formation','nombreChapitres'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
