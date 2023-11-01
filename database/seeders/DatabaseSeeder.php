<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answer;
use App\Models\Customer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            QuestionSeeder::class
        ]);
        $customers=Customer::factory(100)->create();
        foreach ($customers as $customer){
            $question=Question::all();
            foreach ($question as $quiz){
                $customer->answers()->create([
                    'value'=>fake()->numberBetween(1,5),
                    'question_id'=>$quiz->id
                ]);
            }

        }

    }
}
