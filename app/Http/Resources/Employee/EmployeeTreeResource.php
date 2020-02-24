<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeTreeResource extends JsonResource
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
            'name' => $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . " ($position)",
            'id' => $this->id,
            'pid' => !is_null($this->parent_id) ? $this->parent_id : 0,
            'children' => EmployeeTreeResource::collection($this->whenLoaded('children')),
        ];
    }
}
