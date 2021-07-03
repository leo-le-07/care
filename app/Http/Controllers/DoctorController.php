<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\DoctorService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    private $doctorService;

    public function __construct(){

        $this->doctorService = new DoctorService();
    }

    public function index(Request $request)
    {
        $params = $this->getSearchParams($request);

        $doctors = $this->doctorService->search($params);

        return $this->successResponse($doctors, 'Get all doctors');
    }


    public function show($id)
    {
        $doctor = $this->doctorService->show($id);

        if(!$doctor){
            return $this->errorResponse('Doctor not found', 404);
        }
        return $this->successResponse($doctor, 'Get detail doctor');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:255|unique:doctors,name',
        ]);

        if($validator->fails()){
            return $this->errorResponse('Fail validation', 412, $validator->errors());
        }

        $attributes = $request->only(['name', 'logo', 'description', 'phone', 'address']);

        $doctor = $this->doctorService->create($attributes);

        if(!$doctor){
            return $this->errorResponse('Doctor not found', 404);
        }
        return $this->successResponse($doctor, 'Create doctor successfully');

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'=>'max:255|unique:doctors,name,'.$id,
        ]);

        if($validator->fails()){
            
            return $this->errorResponse('Fail validation', 412, $validator->errors());
        }

        $attributes = $request->only(['name', 'logo', 'description', 'phone', 'address']);

        $doctor = $this->doctorService->update($attributes, $id);

        if(!$doctor){
            return $this->errorResponse('Update fail', 404);
        }
        return $this->successResponse($doctor, 'Update doctor successfully');
    }

    public function destroy($id)
    {
        $doctor = $this->doctorService->delete($id);

        if(!$doctor){
            return $this->errorResponse('Delete fail', 404);
        }
        return $this->successResponse($doctor,'Delete doctor successfully');
    }

    private function getSearchParams(Request $request){
        $search = [];

        $search['keyword'] = $request->input('keyword');
        
        return $search;
    }
}
