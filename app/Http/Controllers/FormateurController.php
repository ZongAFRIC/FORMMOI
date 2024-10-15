<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Formation;
use App\Models\Formateur;
use App\Models\Categorie;
use App\Models\Etudiant;
use App\Models\Chapitre;

class FormateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('formateur.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function mesFormations()
    {
        return view('formateur.mesformations');
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
        //
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
