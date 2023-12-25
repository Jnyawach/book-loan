<?php

namespace App\Http\Controllers;

use App\Enums\BookCategoryEnum;
use App\Enums\SubCategoryEnum;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    //

    public function index(){

        $books=Book::with(['activeLoan'])
            ->when(request('search'),function ($query){
                $query->where('name','like','%'.request('search').'%')
                    ->orWhere('publisher','like','%'.request('search').'%')
                    ->orWhere('description','like','%'.request('search').'%');

            })
            ->when(request('category'),function ($query){
                $query->where('category',request('category'));
            })
            ->when(request('sub_category'),function ($query){
                $query->where('sub_category',request('sub_category'));
            })
       ->paginate(request('showing')??10);
        $books=BookResource::collection($books);
        $filters=request()->only(['search','showing','category','sub_category']);
        $categories=BookCategoryEnum::cases();
        $sub_categories=SubCategoryEnum::cases();

        return inertia::render('welcome',
            compact('books','filters','categories','sub_categories'));
    }
}
