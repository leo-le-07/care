<?php

namespace App\Http\Repositories;

use App\Models\User;


class UserRepository 
{


    public function findByEmail($email){

        return User::where('email', $email)->first();
    }

    public function create(array $attributes){

        return User::create($attributes);
    }
    
    public function updateById(array $attributes, $id){

        $result = User::where('id',$id)->update($attributes);

        if($result === 1){
            return User::find($id);
        }
 
        return null;
    }

    public function deleteById($id){

        $user = User::find($id);
        
        return $user->delete();
     }

}
