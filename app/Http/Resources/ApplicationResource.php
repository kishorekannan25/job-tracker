<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            'company' => $this->company,
            'role' => $this->role,
            'status' => $this->status,
            'applied_date' => $this->applied_date->format('Y-m-d'),
            'salary_range' => $this->salary_range,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
        ];
    }

}
