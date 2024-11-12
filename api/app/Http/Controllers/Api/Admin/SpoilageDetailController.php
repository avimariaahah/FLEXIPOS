<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;

class SpoilageDetailController
{
    private $spoilageDetailService;

    public function __construct(SpoilageDetailServiceInterface $spoilageDetailService)
    {
        $this->spoilageDetailService = $spoilageDetailService;
    }

    public function store(SpoilageDetailStoreRequest $request)
    {
        // Create a new spoilage detail record
        $spoilageDetail = $this->spoilageDetailService->createSpoilageDetail($request->validated());
        return response()->json($spoilageDetail, 201);
    }

    public function update(SpoilageDetailUpdateRequest $request, int $spoilageDetailID)
    {
        // Update an existing spoilage detail record
        $success = $this->spoilageDetailService->updateSpoilageDetail($request->validated(), $spoilageDetailID);
        return response()->json(['success' => $success]);
    }

    public function destroy(int $spoilageDetailID)
    {
        // Delete a spoilage detail record by ID
        $success = $this->spoilageDetailService->removeSpoilageDetail($spoilageDetailID);
        return response()->json(['success' => $success]);
    }
}