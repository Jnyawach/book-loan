<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    //

    public function index(){

        $books=Book::query()
            ->when(request('search'),function ($query){
                $query->where('title','like','%'.request('search').'%')
                    ->orWhere('publisher','like','%'.request('search').'%')
                    ->orWhere('description','like','%'.request('search').'%');

            })
       ->paginate(request('showing')??10);
        $books=BookResource::collection($books);
        $filters=request()->only(['search','showing']);

        return inertia::render('welcome', compact('books','filters'));
    }
}
