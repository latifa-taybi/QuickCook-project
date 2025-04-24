<?php

namespace App\Repositories;
use App\Interfaces\RegimeRepositoryInterface;
use App\Models\Regime;

class RegimeRepository implements RegimeRepositoryInterface
{
    public function index(){
        return Regime::all();
    }

    public function getById($id){
       return Regime::findOrFail($id);
    }

    public function store(array $data){
       return Regime::create($data);
    }

    public function update(array $data,$id){
       return Regime::whereId($id)->update($data);
    }
    
    public function delete($id){
       Regime::destroy($id);
    }
}
