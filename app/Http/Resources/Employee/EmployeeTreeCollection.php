<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeTreeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [$this->collection];
    }
}
