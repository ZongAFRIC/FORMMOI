<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.index');
    }

    public function login()
    {
        return view('page.login');
    }

    public function dashboard()
    {
        return ('dashboard dashboard dashboard');
    }

    public function dashb()
    {
        return ('dashboard dashboard dashboard');
    }

    public function dashboard1()
    {
        return ('dashboard formateur dashboard formateur formateur formateur formateur formateur formateur\nformateurformateurformateurformateurdashboard');
    }

    public function register()
    {
        return view('page.register');
    }

    // public function login()
    // {
    //     return view('page.login');
    // }

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
