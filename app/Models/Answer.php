<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable=['question_id','customer_id','value'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
