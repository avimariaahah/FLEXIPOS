<?php

namespace App\Repository;

use App\Interface\Repository\EmployeeRepositoryInterface;
use App\Models\Employees;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function findMany()
    {
        return Employees::all();
    }

    public function findOne(int $id)
    {
        return Employees::findOrFail($id);
    }

    public function create(object $payload)
    {
        $employee = new Employees();
        $employee->userid = $payload->userid;
        $employee->firstname = $payload->firstname;
        $employee->lastname = $payload->lastname;
        $employee->telephone = $payload->telephone;
        $employee->designation = $payload->designation;
        $employee->isactive = $payload->isactive;
        $employee->save();

        return $employee->fresh();
    }

    public function update(object $payload, int $id)
    {
        $employee = Employees::findOrFail($id);
        $employee->userid = $payload->userid;
        $employee->firstname = $payload->firstname;
        $employee->lastname = $payload->lastname;
        $employee->telephone = $payload->telephone;
        $employee->designation = $payload->designation;
        $employee->isactive = $payload->isactive;
        $employee->save();

        return $employee->fresh();
    }

    public function delete(int $id)
    {
        $employee = Employees::findOrFail($id);

        $employee->delete();

        return true;
    }
}
