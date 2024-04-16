<?php
namespace App\Actions\Employee;

use Exception;
use App\Models\Employee;

class DeleteEmployee
{
    public function run($id)
    {
        $employee =  Employee::find($id);
        if(!$employee){
            throw new Exception(
              'Employee not found..'  
            );
        }
        return $employee->delete();
    }
}