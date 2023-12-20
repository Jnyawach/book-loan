<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Book extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'publisher',
        'isbn',
        'category',
        'sub_category',
        'description',
        'pages',

    ];

    public function loans(){
        return $this->hasMany(BookLoan::class);
    }

    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by', 'id');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('bookImage')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('book-icon')
                    ->width(300);
                $this->addMediaConversion('book-thumb')
                    ->width(1200);
            });
    }
}
