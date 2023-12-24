<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookLoanResource extends JsonResource
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
            'book_id' => $this->book_id,
            'user_id' => $this->user_id,
            'loan_date' => $this->loan_date,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'extended_date' => $this->extended_date,
            'extended'=>$this->extended,
            'added_by'=>$this->addedBy,
            'penalty_amount'=>$this->penalty_amount,
            'penalty_status'=>$this->penalty_status,
            'return_date'=>$this->return_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'book' => new BookResource($this->whenLoaded('book')),
        ];
    }
}
