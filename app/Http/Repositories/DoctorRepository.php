<?php

namespace App\Http\Repositories;

use App\Models\Doctor;


class DoctorRepository 
{


    public function findByEmail($email){

        return Doctor::where('email', $email)->first();
    }

    public function create(array $attributes){

        return Doctor::create($attributes);
    }
    
    public function updateById(array $attributes, $id){

        $result = Doctor::where('id',$id)->update($attributes);

        if($result === 1){
            return Doctor::find($id);
        }
 
        return null;
    }

    public function deleteById($id){

        $user = Doctor::find($id);
        
        return $user->delete();
     }

}
