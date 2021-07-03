<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;
use App\Http\Repositories\SpecialtyRepository;


class SpecialtyService
{
    private $specialtyRepository;

    public function __construct(){
        $this->specialtyRepository = new SpecialtyRepository();
    }

    public function search($attributes = [])
    {
       return $this->specialtyRepository->search($attributes);
    }

    public function show($id)
    {
        return $this->specialtyRepository->findById($id);
    }

    public function create(array $attributes)
    {
        return $this->specialtyRepository->create($attributes);
    }
    
    public function update(array $attributes, $id)
    {
        return $this->specialtyRepository->updateById($attributes,$id);
    }

    public function delete($id){
        
        return $this->specialtyRepository->deleteById($id);
    }

}
