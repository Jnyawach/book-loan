<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'quiz'=>$this->quiz,
            'answers'=>AnswerResource::collection($this->whenLoaded('answers')),
            'rating'=>number_format($this->answers->average('value'),1),
            'total_ratings'=>$this->answers->count()
        ];
    }
}
