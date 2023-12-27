<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        Book::truncate();
        Schema::enableForeignKeyConstraints();
        $user=User::whereHas('roles',function($q){
            $q->where('name','admin');
        })->first();

        if (!$user) {
           exit();
        }

        $books = $this->getSeedData('book');
        foreach ($books as $book) {
            $new_book=Book::create([
                'name' => $book->name,
                'publisher' => $book->publisher,
                'isbn' => $book->isbn,
                'category' => $book->category,
                'sub_category' => $book->sub_category,
                'description' => $book->description,
                'pages' => $book->pages,
                'added_by'=>$user->id

            ]);

            $media =  $new_book->addMedia(
                base_path("database/seeders/data/images/{$book->image}")
            )->toMediaCollection('bookImage');
        }
    }


    protected function getSeedData($file)
    {
        return collect(json_decode(
            File::get(
                base_path("database/seeders/data/{$file}.json")
            )
        ));
    }
}
