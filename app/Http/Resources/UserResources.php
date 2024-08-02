<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);
       return [
        'id'=> $this->id,
        'name'=> $this->name,
        'email'=> $this->email,
        //'creat_at'=> (new Carbon($this->creat_at)->for,
       
       ];
    }
}
