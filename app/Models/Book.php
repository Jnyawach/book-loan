<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'publisher',
        'isbn',
        'category',
        'sub_category',
        'image',
        'description',
        'pages',

    ];

    public function loans(){
        return $this->hasMany(BookLoan::class);
    }

    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by', 'id');
    }
}
