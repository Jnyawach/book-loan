<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //

    public function rating(){
        $detractors=Customer::whereHas('answers',function ($query){
            $query->selectRaw('ROUND(AVG(value)) as avg_rounded')
                ->havingRaw('avg_rounded < ?', [3]);
        })->count();
        $passives=Customer::whereHas('answers',function ($query){
            $query->selectRaw('ROUND(AVG(value)) as avg_rounded')
                ->havingRaw('avg_rounded = ?', [3]);
        })->count();
        $promoters=Customer::whereHas('answers',function ($query){
            $query->selectRaw('ROUND(AVG(value)) as avg_rounded')
                ->havingRaw('avg_rounded > ?', [3]);
        })->count();
   return[
         'label'=>['Detractors','Passives','Promoters'],
         'data'=>[$detractors,$passives,$promoters]
     ];

    }

    public function dailyRating(Request $request){
        $start=Carbon::parse($request->start)->startOfDay();
        $end=Carbon::parse($request->end)->endOfDay();
      $working_days=$this->workingDays($start,$end);

        $answers=Answer::query()
            ->whereDate()
            ->whereBetween('created_at',[$request->start,$request->end])
        ->select('created_at','customer_id','id')->get()->groupBy('created_at');
        dd($answers);
        $customers=[];
        foreach ($answers as $key=>$answer){
            $reply=$answer->groupBy('customer_id')->count();
            $customers[Carbon::parse($key)->format('D j')]=[
                'day'=>Carbon::parse($key)->format('D j'),
                'data'=>$reply
            ];
        }
        return $customers;
    }

    public function workingDays($start, $end){
        while ($start->lte($end)) {
            $dates[] = $start->toDateString();
            $start->addDay();
        }
        return $dates;
    }
}
