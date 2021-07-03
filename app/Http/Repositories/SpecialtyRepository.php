<?php

namespace App\Http\Repositories;

use App\Models\Specialty;
use Illuminate\Support\Facades\Log;


class SpecialtyRepository
{

    public function search($search = []){

        if(filled($search['keyword'])){

            return Specialty::where('name', 'LIKE', '%'.$search['keyword'].'%')->get();
        }

        return Specialty::all();
    }

    public function findById($id){

        return Specialty::find($id);
    }

    public function create(array $attributes){

        return Specialty::create($attributes);
    }
    
    public function updateById(array $attributes, $id){

       $result = Specialty::where('id',$id)->update($attributes);

       if($result === 1){
           return Specialty::find($id);
       }

       return null;
    }

    public function deleteById($id){

        $hospital = Specialty::find($id);
        
        return $hospital->delete();
     }

}
