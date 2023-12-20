<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'publisher' => $this->publisher,
            'category' => $this->category,
            'sub_category' => $this->sub_category,
            'description' => $this->description,
            'pages' => $this->pages,
            'isbn' => $this->isbn,
            'added_by' => $this->addedBy->name,
            'big_image' => $this->getFirstMediaUrl('bookImage'),
            'small_image' => $this->getFirstMediaUrl('bookImage','book-icon'),
            'thumb_image' => $this->getFirstMediaUrl('bookImage','book-thumb'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'loans' => BookLoanResource::collection($this->whenLoaded('loans')),
            'active_loan'=>new BookLoanResource($this->whenLoaded('activeLoan'))
        ];
    }
}
