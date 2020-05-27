<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\EmployeeHelper;
use Illuminate\Validation\Rule;
use App\Helpers\RolesAndPermissionHelper;

class EmployeeController extends Controller
{
    public $employeeHelper;
    public $RnPHelper;
    public function __construct(EmployeeHelper $employeeHelper, RolesAndPermissionHelper $RnPHelper)
    {
        $this->employeeHelper = $employeeHelper;
        $this->RnPHelper = $RnPHelper;
    }
    public function index()
    {
        $employees = $this->employeeHelper->getAllEmployees();

        return view('users.index', compact('employees'));
    }
    public function create()
    {
        $roles = $this->RnPHelper->getAllRoles();
        $permissions = $this->RnPHelper->getAllPermissions();
        return view('users.create', compact('roles', 'permissions'));
    }

    public function edit(int $id)
    {
        $employee = $this->employeeHelper->getEmployee($id);
        $roles = $this->RnPHelper->getAllRoles();
        $permissions = $this->RnPHelper->getAllPermissions();
        return view('users.edit', compact('employee', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $this->validateReq($request);
        $data = $request->except(['_token', 'permissions', 'passport', 'role', 'password_confirmation']);
        // dd($data);
        if ($request->hasFile('passport')) {
            $file = $request->file('passport');
            $data['passport'] = now() . '.' . $file->extension();
            $file->move(public_path(config('constants.profile_image_dir')), $data['passport']);
        } else {
            $data['passport'] = 'default.png';
        }
        $user = $this->employeeHelper->createEmployee($data);

        $user->attachRole($request->role);
        $user->attachPermissions($request->permissions);
        session()->flash('message', 'Employee Created Successfully');
        return redirect()->route('user.index');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validateReq($request, true, $id);
        $employee = $this->employeeHelper->getEmployee($id);
        if ($request->hasFile('passport')) {
            $file = $request->file('passport');
            $data['passport'] = now() . '.' . $file->extension();
            $file->move(public_path(config('constants.profile_image_dir')), $data['passport']);
            if ($employee->passport != config('constants.defaul_passport')) {
                unlink(public_path(config('constants.profile_image_dir')) . $employee->passport);
            }
        } else {
            $data['passport'] = 'default.png';
        }

        $employee->update($request->except(['_token', 'permissions', 'passport', 'role', 'password_confirmation']));
        $employee->syncRoles([$request->role]);
        $employee->syncPermissions($request->permissions);

        session()->flash('message', 'User updated successfully');
        return redirect()->route('user.index');
    }

    public function showProfileForm()
    {
        return view('profile.index');
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validateReq($request, true, $id);
        $employee = $this->employeeHelper->getEmployee($id);
        if ($request->hasFile('passport')) {
            $file = $request->file('passport');
            $data['passport'] = now() . '.' . $file->extension();
            $file->move(public_path(config('constants.profile_image_dir')), $data['passport']);
            if ($employee->passport != config('constants.defaul_passport')) {
                unlink(public_path(config('constants.profile_image_dir')) . $employee->passport);
            }
        } else {
            $data['passport'] = 'default.png';
        }

        $employee->update($request->except(['_token', 'permissions', 'passport', 'role', 'password_confirmation']));
        session()->flash('message', 'Profile updated successfully');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $employee = $this->employeeHelper->getEmployee($id);
        $employee->detachRoles();
        $employee->detachPermissions();
        $employee->delete();
        session()->flash('message', 'User deleted successfully');
        return redirect()->route('user.index');
    }

    private function validateReq(Request $request, $update = false, $ignore_id = null)
    {
        $uniqueRule = (($update) && !is_null($ignore_id)) ? "unique:users,username,{$ignore_id}" : "unique:users";
        $sometimes = ($update) ? 'sometimes' : '';

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [$sometimes, 'required', 'string', 'max:255', "{$uniqueRule}"],
            'password' => [
                Rule::requiredIf(function () use ($request, $update) {
                    if ($request->password == null && $update) {
                        return false;
                    }
                    return true;
                }),
                'confirmed'
            ],
            'passport' => ['sometimes', 'mimes:jpeg,jpg,png'],
            'role'  => [$sometimes, 'required'],
            'permissions' => [$sometimes, 'required']
        ]);
    }


    public function getRolePermissions($id)
    {
        return response([
            'success' => true,
            'data' => $this->RnPHelper->getRolePermissions($id, true)
        ]);
    }
}
