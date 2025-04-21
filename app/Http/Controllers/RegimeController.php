<?php

namespace App\Http\Controllers;

use App\Models\Regime;
use App\Http\Requests\StoreRegimeRequest;
use App\Http\Requests\UpdateRegimeRequest;

class RegimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    public function store(StoreRegimeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Regime $regime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regime $regime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegimeRequest $request, Regime $regime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regime $regime)
    {
        //
    }
}
