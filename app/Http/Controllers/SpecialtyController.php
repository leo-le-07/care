<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SpecialtyService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SpecialtyController extends Controller
{
    private $specialtyService;

    public function __construct(){

        $this->specialtyService = new SpecialtyService();
    }

    public function index(Request $request)
    {
        $params = $this->getSearchParams($request);

        $specialties = $this->specialtyService->search($params);

        return $this->successResponse($specialties, 'Get all specialties');
    }


    public function show($id)
    {
        $specialty = $this->specialtyService->show($id);

        if(!$specialty){
            return $this->errorResponse('Specialty not found', 404);
        }
        return $this->successResponse($specialty, 'Get detail specialty');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:255|unique:specialties,name',
        ]);

        if($validator->fails()){
            return $this->errorResponse('Fail validation', 412, $validator->errors());
        }

        $attributes = $request->only(['name', 'image', 'description']);

        $specialty = $this->specialtyService->create($attributes);

        if(!$specialty){
            return $this->errorResponse('Specialty not found', 404);
        }
        return $this->successResponse($specialty, 'Create specialty successfully');

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'=>'max:255|unique:specialties,name,'.$id,
        ]);

        if($validator->fails()){
            
            return $this->errorResponse('Fail validation', 412, $validator->errors());
        }

        $attributes = $request->only(['name', 'image', 'description']);

        $specialty = $this->specialtyService->update($attributes, $id);

        if(!$specialty){
            return $this->errorResponse('Update fail', 404);
        }
        return $this->successResponse($specialty, 'Update specialty successfully');
    }

    public function destroy($id)
    {
        $specialty = $this->specialtyService->delete($id);

        if(!$specialty){
            return $this->errorResponse('Delete fail', 404);
        }
        return $this->successResponse($specialty,'Delete specialty successfully');
    }

    private function getSearchParams(Request $request){
        $search = [];

        $search['keyword'] = $request->input('keyword');
        
        return $search;
    }
}
