<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookCategoryEnum;
use App\Enums\SubCategoryEnum;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return inertia::render('admin/books/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories=BookCategoryEnum::cases();
        $sub_categories=SubCategoryEnum::cases();
        return inertia::render('admin/books/create',compact('categories','sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated=$request->validate([
            'name'=>'required|max:255|string',
            'publisher'=>'required|max:255|string',
            'category'=>'required|max:50|string',
            'sub_category'=>'required|max:50|string',
            'description'=>'required|string',
            'pages'=>'required|integer',
            'image'=>'required|image|max:2048|mimes:png,jpg,jpeg',
        ]);

        DB::transaction(function () use ($validated, $request){
            $book=Book::create([
                'name'=>$validated['name'],
                'publisher'=>$validated['publisher'],
                'category'=>$validated['category'],
                'sub_category'=>$validated['sub_category'],
                'description'=>$validated['description'],
                'pages'=>$validated['pages'],
            ]);
            if($files=$request->image){
                $book->addMedia($files)->toMediaCollection('bookImage');
            }
        });

        return redirect()->back()->with([
            'toast' => [
                'message' => 'Book created successfully',
                'type' => 'success'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
