<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Http\Resources\QuestionResource;
use App\Models\Customer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //
   public function dashboard(){
       return inertia::render('dashboard/index');
   }

   public function customer(){
       $customers=Customer::whereHas('answers')
           ->with('answers')
           ->when(request('search'), function ($q, $search){
               $q->where('name','like','%'.$search.'%');
           })
           ->when(request('rating'), function ($q, $rating){
               $q->whereHas('answers', function ($query) use ($rating){
                   $query->having(DB::raw('avg(value)'), '>', $rating);
               });
           })
           ->paginate(request('showing')??10)->withQueryString();
       $customers=CustomerResource::collection($customers);
       $filters=request()->only('search','showing','rating');
       return inertia::render('dashboard/customers',
       compact('filters','customers'));
   }

   public function question(){
       $questions=Question::query()
           ->when(request('search'), function ($q, $search){
               $q->where('name','like','%'.$search.'%');
           })
           ->paginate(request('showing')??10)->withQueryString();
       $questions=QuestionResource::collection($questions);
       $filters=request()->only('search','showing');
       return inertia::render('dashboard/questions', compact('questions'));
   }

   public function show(string $id){
       $question=new QuestionResource(Question::findOrfail($id));
       $customers=Customer::whereHas('answers',function ($q) use ($question){
           $q->where('question_id',$question->id);
         })
           ->with(['answers'=>function ($q) use ($question){
               $q->where('question_id',$question->id);
           }])
           ->when(request('search'), function ($q, $search){
               $q->where('name','like','%'.$search.'%');
           })
           ->when(request('rating'), function ($q, $rating){
               $q->whereHas('answers', function ($query) use ($rating){
                   $query->having(DB::raw('avg(value)'), '>', $rating);
               });
           })
           ->paginate(request('showing')??10)->withQueryString();
       $customers=CustomerResource::collection($customers);
       $filters=request()->only('search','showing','rating');
       return inertia::render('dashboard/quiz-show',
       compact('question','filters','customers'));
   }
}
