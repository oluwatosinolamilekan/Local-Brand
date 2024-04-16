<?php
namespace App\Actions\Employee;

use App\Models\Employee;

class ListEmployee
{
    public function run($request)
    {
        $query = Employee::query();

        $employees = $query->paginate(10);

        return $employees;
    }
}