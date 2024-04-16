<?php
namespace App\Actions\Employee;

use App\Models\Employee;
use Exception;

class GetSingleEmployee
{
    public function run($id)
    {
        $employee =  Employee::find($id);
        if(!$employee){
            throw new Exception(
              'Employee not found..'  
            );
        }

        return $employee;
    }
}