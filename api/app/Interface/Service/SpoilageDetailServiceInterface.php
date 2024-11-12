<?php

namespace App\Interface\Service;

use App\Models\SpoilageDetail;

interface SpoilageDetailServiceInterface
{
    public function createSpoilageDetail(array $data): SpoilageDetail;

    public function updateSpoilageDetail(array $data, int $id): bool;

    public function removeSpoilageDetail(int $id): bool;
}
