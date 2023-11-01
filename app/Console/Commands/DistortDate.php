<?php

namespace App\Console\Commands;

use App\Models\Answer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DistortDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'distort:date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $answers=Answer::get()->groupBy('customer_id');
        foreach ($answers as $answer){
            $date=Carbon::today()->subDays(rand(1,5));
            foreach ($answer as $reply){

                $reply->update([
                    'created_at'=>$date
                ]);
            }
        }

    }
}
