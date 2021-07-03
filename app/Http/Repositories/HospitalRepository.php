<?php

namespace App\Http\Repositories;

use App\Models\Hospital;
use Illuminate\Support\Facades\Log;


class HospitalRepository
{

    public function search($search = []){

        if(filled($search['keyword'])){

            return Hospital::where('name', 'LIKE', '%'.$search['keyword'].'%')->get();
        }

        return Hospital::all();
    }

    public function findById($id){

        return Hospital::find($id);
    }

    public function create(array $attributes){

        return Hospital::create($attributes);
    }
    
    public function updateById(array $attributes, $id){

       $result = Hospital::where('id',$id)->update($attributes);

       if($result === 1){
           return Hospital::find($id);
       }

       return null;
    }

    public function deleteById($id){

        $hospital = Hospital::find($id);
        
        return $hospital->delete();
     }

}
