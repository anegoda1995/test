<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $position = strtoupper($this->position->title);
        return [
            'text' => $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . " ($position)",
            'value' => $this->id,
        ];
    }
}
