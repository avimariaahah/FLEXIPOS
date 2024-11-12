<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\SpoilageStoreRequest;
use App\Http\Requests\SpoilageUpdateRequest;
use App\Interface\Service\SpoilageServiceInterface;

class SpoilageController
{
    private $spoilageService;

    public function __construct(SpoilageServiceInterface $spoilageService)
    {
        $this->spoilageService = $spoilageService;
    }

    public function index()
    {
        // Get all spoilages with related details
        return $this->spoilageService->getAllSpoilages();
    }

    public function store(SpoilageStoreRequest $request)
    {
        // Create a new spoilage record
        return $this->spoilageService->createSpoilage($request->validated());
    }

    public function show(int $spoilageID)
    {
        // Find a specific spoilage by ID
        return $this->spoilageService->findSpoilageById($spoilageID);
    }

    public function update(SpoilageUpdateRequest $request, int $spoilageID)
    {
        // Update an existing spoilage record
        return $this->spoilageService->updateSpoilage($request->validated(), $spoilageID);
    }

    public function destroy(int $spoilageID)
    {
        // Delete a spoilage record by ID
        return $this->spoilageService->removeSpoilage($spoilageID);
    }
}
