<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeCommonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $position = $this->position->title;
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'position' => $position,
            'employment_date' => $this->employment_date,
            'salary' => $this->salary,
        ];
    }
}
