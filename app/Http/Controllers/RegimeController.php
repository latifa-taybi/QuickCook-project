<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Models\Regime;
use App\Http\Requests\StoreRegimeRequest;
use App\Http\Requests\UpdateRegimeRequest;
use App\Http\Resources\RegimeRessource;
use App\Interfaces\RegimeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RegimeController extends Controller
{
    private RegimeRepositoryInterface $regimeRepositoryInterface;

    public function __construct(RegimeRepositoryInterface $regimeRepositoryInterface)
    {
        $this->regimeRepositoryInterface = $regimeRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->regimeRepositoryInterface->index();
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
        $data =[
            'name' => $request->name,
            'description' => $request->description
        ];
        
        $this->regimeRepositoryInterface->store($data);

        return redirect()->route('regimes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Regime $regime)
    {
        $regime = $this->regimeRepositoryInterface->getById($regime->id);
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
        $updateData =[
            'name' => $request->name,
            'description' => $request->description
        ];
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regime $regime)
    {
        $this->regimeRepositoryInterface->delete($regime->id);

    }
}
