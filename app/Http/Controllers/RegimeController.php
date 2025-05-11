<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegimeRequest;
use App\Http\Requests\UpdateRegimeRequest;
use App\Interfaces\RegimeRepositoryInterface;
use Illuminate\Http\Request;

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
        $regimes = $this->regimeRepositoryInterface->index();
        return view('admin.gestionRegimes', compact('regimes'));

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegimeRequest $request)
    {
        $regimes =[
            'name' => $request->name,
            'description' => $request->description
        ];
        
        $this->regimeRepositoryInterface->store($regimes);

        return redirect()->route('regimes.index');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegimeRequest $request)
    {
        $updateData =[
            'name' => $request->name,
            'description' => $request->description
        ];

        $this->regimeRepositoryInterface->update($updateData, $request->id);
        return redirect()->route('regimes.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->regimeRepositoryInterface->delete($request->id);
        return redirect()->route('regimes.index');

    }
}
