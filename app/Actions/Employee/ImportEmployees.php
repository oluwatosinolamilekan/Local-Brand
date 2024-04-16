<?php
namespace App\Actions\Employee;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class ImportEmployees
{
    public function run($file)
    {
        if ($file->getClientOriginalExtension() !== 'csv') {
            throw new Exception('Invalid file format. Please upload a CSV file.');
        }
        
        DB::beginTransaction();

        $handle = fopen($file->getPathname(), 'r');
        

        if($handle !== false){

            fgetcsv($handle);

            $columnMapping = $this->employeeHeaders();
            
            while (($row = fgetcsv($handle)) !== false) {

                $rowData = array_combine(array_values($columnMapping), $row);

                $employeeData = [
                    'employee_id' => $this->generateUniqueEmployeeId($row[0]),
                    'name_prefix' => $row[1],
                    'first_name' => $row[2],
                    'middle_initial' => $row[3],
                    'last_name' => $row[4],
                    'gender' => $row[5],
                    'email' => $row[6],
                    'date_of_birth' => $row[7],
                    'time_of_birth' => $row[8],
                    'age_in_years' => $row[9], 
                    'date_of_joining' => $row[10], 
                    'age_in_company_years' => $row[11], 
                    'phone_no' => $row[12], 
                    'place_name' => $row[13], 
                    'county' => $row[14],
                    'city' => $row[15], 
                    'zip' => $row[16], 
                    'region' => $row[17],
                    'user_name' => $row[18], 
                ];

                if ($this->isDuplicateEmail($rowData['email'])) {
                    // Log or handle duplicate email as needed
                    info("Duplicate email found: " . $rowData['email']);
                    continue; // Skip this row
                }

                Employee::create($employeeData);

            }

            fclose($handle);
        }

        DB::commit();
    }


    private function employeeHeaders()
    {
       return [
            'Emp ID' => 'employee_id',
            'Name Prefix' => 'name_prefix',
            'First Name' => 'first_name',
            'Middle Initial' => 'middle_initial',
            'Last Name' => 'last_name',
            'Gender' => 'gender',
            'E Mail' => 'email',
            'Date of Birth' => 'date_of_birth',
            'Time of Birth' => 'time_of_birth',
            'Age in Yrs.' => 'age_in_years',
            'Date of Joining' => 'date_of_joining',
            'Age in Company (Years)' => 'age_in_company_years',
            'Phone No.' => 'phone_no',
            'Place Name' => 'place_name',
            'County' => 'county',
            'City' => 'city',
            'Zip' => 'zip',
            'Region' => 'region',
            'User Name' => 'user_name',
        ];

    }

    private function generateUniqueEmployeeId($baseEmployeeId)
    {
        $uniqueEmployeeId = $baseEmployeeId;
        
        // Check if the employee id already exists
        $count = Employee::where('employee_id', $uniqueEmployeeId)->count();

        // If employee id already exists, append a number to make it unique
        if ($count > 0) {
            $rowNumber = $count + 1; // Add 1 to the count to generate a new unique id
            $uniqueEmployeeId = $baseEmployeeId . $rowNumber;
        }

        return $uniqueEmployeeId;
    }

    private function isDuplicateEmail($email)
    {
        // Check if the email already exists in the database
        return Employee::where('email', $email)->exists();
    }
}