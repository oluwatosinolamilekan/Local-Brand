<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Actions\Employee\ListEmployee;
use App\Actions\Employee\DeleteEmployee;
use App\Http\Resources\EmployeeResource;
use App\Actions\Employee\ImportEmployees;
use App\Http\Requests\BatchUploadRequest;
use App\Actions\Employee\GetSingleEmployee;

class EmployeeController extends Controller
{
   

    public function index(Request $request)
    {
        try{
            $employees = (new ListEmployee())->run($request);

            return EmployeeResource::collection($employees);
        }catch(Exception $e){
            return $this->resourceError($e);
        }
       
    }

    public function store(BatchUploadRequest $request)
    {
        try{
            $data = $request->validated();

            $file = $request->file('file');

            (new ImportEmployees())->run($file);
    
            return response()->json(['message' => 'CSV file imported successfully'], 200);
        }catch(Exception $e){
            return $this->resourceError($e);
        }
    }

    public function show($id)
    {
        try{
            $employee = (new GetSingleEmployee())->run($id);
            return new EmployeeResource($employee);
        }catch(Exception $e){
            return $this->resourceError($e);
        }
    }

    public function delete($id)
    {
        try{
           (new DeleteEmployee())->run($id);
            return $this->resourceDeleted();
        }catch(Exception $e){
            return $this->resourceError($e);
        }
    }
}
