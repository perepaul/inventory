<?php

namespace App\Helpers;

use App\User;

class EmployeeHelper
{
    public $userModel;
    public function __construct(User $user)
    {
        $this->userModel = $user;
    }
    public function getAllEmployees()
    {
        return $this->userModel->orderBy('id','desc')->paginate();
    }

    public function getEmployee(int $id)
    {
        return $this->userModel->findOrFail($id);
    }

    public function createEmployee(array $data)
    {
        return $this->userModel->create($data);
    }
}
