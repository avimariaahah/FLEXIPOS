<?php

namespace App\Service;

use App\Http\Resources\EmployeeResource;
use App\Interface\Repository\EmployeeRepositoryInterface;
use App\Interface\Service\EmployeeServiceInterface;

class EmployeeService implements EmployeeServiceInterface
{
    private $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function findEmployees()
    {
        $employees = $this->employeeRepository->findMany();

        return EmployeeResource::collection($employees);
    }

    public function findEmployeeById(int $id)
    {
        $employee = $this->employeeRepository->findOne($id);

        return new EmployeeResource($employee);
    }

    public function createEmployee(object $payload)
    {
        $employee = $this->employeeRepository->create($payload);

        return new EmployeeResource($employee);
    }

    public function updateEmployee(object $payload, int $id)
    {
        $employee = $this->employeeRepository->update($payload, $id);

        return new EmployeeResource($employee);
    }

    public function removeEmployee(int $id)
    {
        return $this->employeeRepository->delete($id);
    }
}
