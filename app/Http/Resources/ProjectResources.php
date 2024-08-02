<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResources extends JsonResource
{

    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        //return parent::toArray($request);
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'descreption'=> $this->descreption,
            'due_date'=> ( new Carbon($this->due_date))->format('Y-m-d'),
            'created_at'=> ( new Carbon($this->due_date))->format('Y-m-d'),
            'status'=> $this->status,
            'image_path'=> $this->image_path,
            'createdBy'=> new UserResources($this->createdBy),
            'updatedBy'=> new UserResources($this->updatedBy),
        ];
    }
}
