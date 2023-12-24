<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookLoan extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'book_id',
        'user_id',
        'loan_date',
        'return_date',
        'extended',
        'extended_date',
        'penalty_amount',
        'penalty_status',
        'status',
        'added_by',
        'due_date'
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function addedBy(){
        return $this->belongsTo(User::class,'added_by');
    }
}
