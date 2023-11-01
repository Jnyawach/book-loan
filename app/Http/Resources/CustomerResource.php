<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'answers'=>AnswerResource::collection($this->whenLoaded('answers')),
            'rating'=> number_format($this->answers->average('value'),1)
        ];
    }
}
