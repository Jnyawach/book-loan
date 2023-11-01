<?php

namespace App\Http\Controllers;

use App\Events\RepNotificationEvent;
use App\Models\Answer;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
                $rating=array_column($validated['answers'], 'value');
                $average=array_sum($rating)/count($rating);

                if ($average<3){

                    $user=User::latest()->first();
                    RepNotificationEvent::dispatch($user,$customer);
                }
            }
        });

        return redirect()->back();
    }
}
