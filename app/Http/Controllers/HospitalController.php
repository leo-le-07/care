<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\HospitalService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HospitalController extends Controller
{
    private $hospitalService;

    public function __construct(){

        $this->hospitalService = new HospitalService();
    }

    public function index(Request $request)
    {
        $params = $this->getSearchParams($request);

        $hospitals = $this->hospitalService->search($params);

        return $this->successResponse($hospitals, 'Get all hospitals');
    }


    public function show($id)
    {
        $hospital = $this->hospitalService->show($id);

        if(!$hospital){
            return $this->errorResponse('Hospital not found', 404);
        }
        return $this->successResponse($hospital, 'Get detail hospital');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:255|unique:hospitals,name',
        ]);

        if($validator->fails()){
            return $this->errorResponse('Fail validation', 412, $validator->errors());
        }

        $attributes = $request->only(['name', 'logo', 'description', 'phone', 'address']);

        $hospital = $this->hospitalService->create($attributes);

        if(!$hospital){
            return $this->errorResponse('Hospital not found', 404);
        }
        return $this->successResponse($hospital, 'Create hospital successfully');

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'=>'max:255|unique:hospitals,name,'.$id,
        ]);

        if($validator->fails()){
            
            return $this->errorResponse('Fail validation', 412, $validator->errors());
        }

        $attributes = $request->only(['name', 'logo', 'description', 'phone', 'address']);

        $hospital = $this->hospitalService->update($attributes, $id);

        if(!$hospital){
            return $this->errorResponse('Update fail', 404);
        }
        return $this->successResponse($hospital, 'Update hospital successfully');
    }

    public function destroy($id)
    {
        $hospital = $this->hospitalService->delete($id);

        if(!$hospital){
            return $this->errorResponse('Delete fail', 404);
        }
        return $this->successResponse($hospital,'Delete hospital successfully');
    }

    private function getSearchParams(Request $request){
        $search = [];

        $search['keyword'] = $request->input('keyword');
        
        return $search;
    }
}
