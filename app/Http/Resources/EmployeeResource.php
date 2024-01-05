<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'alamat' => $this->address,
            'tanggal_lahir' => $this->birthday,
            'tanggal_bergabung' => $this->join_date,
        ];
    }
}
