<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;
use App\Http\Repositories\DoctorRepository;


class DoctorService
{
    private $doctorRepository;

    public function __construct(){
        $this->doctorRepository = new DoctorRepository();
    }

    public function search($attributes = [])
    {
       return $this->doctorRepository->search($attributes);
    }

    public function show($id)
    {
        return $this->doctorRepository->findById($id);
    }

    public function create(array $attributes)
    {
        return $this->doctorRepository->create($attributes);
    }
    
    public function update(array $attributes, $id)
    {
        return $this->doctorRepository->updateById($attributes,$id);
    }

    public function delete($id){
        
        return $this->doctorRepository->deleteById($id);
    }

}
