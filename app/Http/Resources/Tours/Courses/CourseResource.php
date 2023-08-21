<?php

namespace App\Http\Resources\Tours\Courses;

use App\Http\Resources\Resource;


class CourseResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'  => $this->name,
            'address' => $this->address,
            'image' => $this->image
        ];
    }
}
