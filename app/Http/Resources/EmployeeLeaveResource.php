<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeLeaveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nomor_induk' => $this->id_number,
            'nama' => $this->name,
            'sisa_cuti' => 12 - $this->leaves_sum_duration,
        ];
    }
}
