<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    protected $fillable = [
        'hospital_id',
        'name',
        'email',
        'gender',
        'description',
        'avatar',
    ];

    public function hospital(){
        return $this->belongsTo(Hospital::class);
    }
    public function specialties(){
        return $this->belongsToMany(Specialty::class,'doctors_specialties','doctor_id','specialty_id');
    }
}
