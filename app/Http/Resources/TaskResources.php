<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;


class TaskResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'descreption'=> $this->descreption,
            'due_date'=> ( new Carbon($this->due_date))->format('Y-m-d'),
            'created_at'=> ( new Carbon($this->due_date))->format('Y-m-d'),
            'status'=> $this->status,
            'priority' => $this->priority,
            'image_path'=> $this->image_path,
            'project'=> new ProjectResources($this->project),
            'project_id'=> $this->project_id,
            'assignedUser'=> new UserResources($this->assignedUser),
            'createdBy'=> new UserResources($this->createdBy),
            'updatedBy'=> new UserResources($this->updatedBy),
        ];
    }
}
