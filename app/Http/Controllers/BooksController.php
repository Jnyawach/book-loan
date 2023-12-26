<?php

namespace App\Http\Controllers;

use App\Enums\BorrowingStatusEnum;
use App\Http\Resources\BookLoanResource;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\BookLoan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BooksController extends Controller
{
    //

    public function index(string $id){
        $book=new BookResource(Book::findOrFail($id));
        $user=Auth::user();
        return inertia::render('borrow',compact('book','user'));
    }

    public function borrow(Request $request){
        $validated=$request->validate([
            'book_id'=>'required|exists:books,id',
            'user_id'=>'required|exists:users,id',
            'period'=>'required|integer',
        ]);

        $loan=BookLoan::create([
            'book_id'=>$validated['book_id'],
            'user_id'=>$validated['user_id'],
            'loan_date'=>Carbon::now(),
            'due_date'=>Carbon::now()->addDays($validated['period']),
            'status'=>BorrowingStatusEnum::PENDING->value

        ]);

        return redirect()->route('borrowing.index')
            ->with([
                'toast'=>[
                    'type'=>'success',
                    'message'=>'Book Borrowed Successfully
                ']
            ]);
    }


    public function borrowing(){
        $loans=BookLoan::where('user_id', Auth::id())->with('book')->latest()->paginate(10);
        $loans=BookLoanResource::collection($loans);
        return inertia::render('borrowing/index', compact('loans'));
    }

    public function borrowingShow(string $id){
        $loan=new  BookLoanResource(BookLoan::with('book')->where('user_id',Auth::id())->findOrFail($id));
        return inertia::render('borrowing/show',compact('loan'));
    }

    public function extension(Request $request){
        $validated=$request->validate([
            'loan_id'=>'required|exists:book_loans,id',
            'period'=>'required|integer',
        ]);
        $book_loan=BookLoan::findOrFail($validated['loan_id']);
        $book_loan->update([
            'due_date'=>Carbon::now()->addDays($validated['period']),
            'status'=>BorrowingStatusEnum::EXTENDED->value,
            'extended'=>true,
            'extended_date'=>Carbon::now()
        ]);
        return redirect()->back()->with([
            'toast'=>[
                'type'=>'success',
                'message'=>'Book Extended Successfully'
            ]
        ]);
    }
}
