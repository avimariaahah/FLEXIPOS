<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Interface\Service\EmployeeServiceInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $employeeService;

    public function __construct(EmployeeServiceInterface $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        return $this->employeeService->findEmployees();
    }

    public function store(EmployeeStoreRequest $request)
    {
        return $this->employeeService->createEmployee($request);
    }

    public function show(int $employeeId)
    {
        return $this->employeeService->findEmployeeById($employeeId);
    }

    public function update(EmployeeUpdateRequest $request, int $employeeId)
    {
        return $this->employeeService->updateEmployee($request, $employeeId);
    }

    public function destroy(int $employeeId)
    {
        return $this->employeeService->removeEmployee($employeeId);
    }
}
