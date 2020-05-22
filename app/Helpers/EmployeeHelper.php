<?php

namespace App\Helpers;

use App\User;

class EmployeeHelper
{
    public function getAllEmployees()
    {
        return User::all();
    }

    public function getEmployee(int $id)
    {
        return User::findOrFail($id);
    }

    public function createEmployee(array $data)
    {
        // dd($data);
        return User::create($data);
    }
}
