<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    //

    public function index(){
        $quizzes=Question::select('quiz','id')->get();

        return inertia::render('welcome', compact('quizzes'));
    }
}
