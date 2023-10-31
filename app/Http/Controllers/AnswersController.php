<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswersController extends Controller
{
    //

    public function save(Request $request){

        $validated=$request->validate([
            'name'=>'required|string|max:50',
            'email'=>'string|email|required|max:50',
            'phone'=>'required|phone:INTERNATIONAL',
            'answers'=>'required|array|max:3',
            'answers.*.quiz_id'=>'required|integer',
            'answers.*.value'=>'required|integer'
        ]);

        DB::transaction(function () use ($validated){
            $customer=Customer::create([
                'name'=>$validated['name'],
                'email'=>$validated['email'],
                'phone'=>$validated['phone']

            ]);
            if($validated['answers']){
                foreach ($validated['answers'] as $answer){
                    Answer::create([
                        'customer_id'=>$customer->id,
                        'question_id'=>$answer['quiz_id'],
                        'value'=>$answer['value']
                    ]);
                }
            }
        });

        return redirect()->back();
    }
}
