<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;
use App\Http\Repositories\HospitalRepository;


class HospitalService
{
    private $hospitalRepository;

    public function __construct(){
        $this->hospitalRepository = new HospitalRepository();
    }

    public function search($attributes = [])
    {
       return $this->hospitalRepository->search($attributes);
    }

    public function show($id)
    {
        return $this->hospitalRepository->findById($id);
    }

    public function create(array $attributes)
    {
        return $this->hospitalRepository->create($attributes);
    }
    
    public function update(array $attributes, $id)
    {
        return $this->hospitalRepository->updateById($attributes,$id);
    }

    public function delete($id){
        
        return $this->hospitalRepository->deleteById($id);
    }

}
