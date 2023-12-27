<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookCategoryEnum;
use App\Enums\SubCategoryEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $books=Book::query()
            ->when(request('search'),function ($query){
                $query->where('name','like','%'.request('search').'%')
                    ->orWhere('publisher','like','%'.request('search').'%');
            })
            ->paginate(request('showing')??10);
        $books=BookResource::collection($books);
        $filters=request()->only(['search','showing']);
        return inertia::render('admin/books/index', compact('books','filters'));
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
            'subcategory'=>'required|max:50|string',
            'description'=>'required|string',
            'pages'=>'required|integer',
            'isbn'=>'required|max:255|string',
            'image'=>'required|image|max:2048|mimes:png,jpg,jpeg',
        ]);

        DB::transaction(function () use ($validated, $request){
            $book=Book::create([
                'name'=>$validated['name'],
                'publisher'=>$validated['publisher'],
                'category'=>$validated['category'],
                'sub_category'=>$validated['subcategory'],
                'description'=>$validated['description'],
                'pages'=>$validated['pages'],
                'isbn'=>$validated['isbn'],
                'added_by'=>Auth::id()
            ]);
            if($files=$request->image){
                $book->addMedia($files)->toMediaCollection('bookImage');
            }
        });

        return redirect()->route('books.index')->with([
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
        $book=new BookResource(Book::with('activeLoan')->findOrFail($id));
        return inertia::render('admin/books/show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $book=new BookResource(Book::findOrFail($id));
        $categories=BookCategoryEnum::cases();
        $sub_categories=SubCategoryEnum::cases();
        return inertia::render('admin/books/edit',compact('book','categories','sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $validated=$request->validate([
            'name'=>'required|max:255|string',
            'publisher'=>'required|max:255|string',
            'category'=>'required|max:50|string',
            'subcategory'=>'required|max:50|string',
            'description'=>'required|string',
            'pages'=>'required|integer',
            'isbn'=>'required|max:255|string',
            'image'=>'nullable|image|max:2048|mimes:png,jpg,jpeg',
        ]);
        $book=Book::findOrFail($id);
        DB::transaction(function () use ($validated, $request, $book){
            $book->update([
                'name'=>$validated['name'],
                'publisher'=>$validated['publisher'],
                'category'=>$validated['category'],
                'sub_category'=>$validated['subcategory'],
                'description'=>$validated['description'],
                'pages'=>$validated['pages'],
                'isbn'=>$validated['isbn'],
            ]);
            if ($files=$request->image){
                $book->getFirstMedia('bookImage')?->clearMediaCollection('bookImage');
                $book->addMedia($files)->toMediaCollection('bookImage');
            }
        });

        return redirect()->route('books.index')->with([
            'toast' => [
                'message' => 'Book updated successfully',
                'type' => 'success'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book=Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with([
            'toast' => [
                'message' => 'Book deleted successfully',
                'type' => 'success'
            ]
        ]);
    }
}
