<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $quizes=[
            'Rate your experience with our product?',
            'Rate our customer care?',
            'Are you happy with the product?'
        ];

        Schema::disableForeignKeyConstraints();
        Question::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($quizes as $quiz){
            Question::create([
                'quiz'=>$quiz
            ]);
        }
    }
}
