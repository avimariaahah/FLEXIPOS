<?php


namespace App\Services;

use App\Models\Spoilage;
use App\Interface\Service\SpoilageServiceInterface;

class SpoilageService implements SpoilageServiceInterface
{
    public function getAllSpoilages()
    {
        return Spoilage::with('spoilage_details')->get();
    }

    public function createSpoilage(array $data): Spoilage
    {
        return Spoilage::create($data);
    }

    public function findSpoilageById(int $id): ?Spoilage
    {
        return Spoilage::with('spoilage_details')->find($id);
    }

    public function updateSpoilage(array $data, int $id): bool
    {
        $spoilage = Spoilage::findOrFail($id);
        return $spoilage->update($data);
    }

    public function removeSpoilage(int $id): bool
    {
        $spoilage = Spoilage::findOrFail($id);
        return $spoilage->delete();
    }
}
