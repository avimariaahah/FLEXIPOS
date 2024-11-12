<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpoilageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'branch_no' => $this->branch_no,
            'prepared_by_id' => $this->prepared_by_id,
            'damaged_date' => $this->damaged_date,
            'remarks' => $this->remarks,
            'approved_by_id' => $this->approved_by_id,
            'is_cancelled' => $this->is_cancelled,
            'cancelled_by' => $this->cancelled_by,
            'created_at' => $this->created_at,
        ];
    }
}
