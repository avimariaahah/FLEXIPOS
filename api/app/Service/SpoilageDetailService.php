<?php

namespace App\Services;

use App\Models\SpoilageDetail;
use App\Interface\Service\SpoilageDetailServiceInterface;

class SpoilageDetailService implements SpoilageDetailServiceInterface
{
    public function createSpoilageDetail(array $data): SpoilageDetail
    {
        return SpoilageDetail::create($data);
    }

    public function updateSpoilageDetail(array $data, int $id): bool
    {
        $spoilageDetail = SpoilageDetail::findOrFail($id);
        return $spoilageDetail->update($data);
    }

    public function removeSpoilageDetail(int $id): bool
    {
        $spoilageDetail = SpoilageDetail::findOrFail($id);
        return $spoilageDetail->delete();
    }
}
