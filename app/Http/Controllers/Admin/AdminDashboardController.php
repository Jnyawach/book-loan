<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BorrowingStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookLoanResource;
use App\Models\Book;
use App\Models\BookLoan;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $loans=BookLoan::whereNot('status',BorrowingStatusEnum::RETURNED->value)->count();
        $borrowed=BookLoan::whereStatus(BorrowingStatusEnum::BORROWED->value)->count();
        $delayed=BookLoan::whereStatus(BorrowingStatusEnum::DELAYED->value)->count();
        $extended=BookLoan::whereStatus(BorrowingStatusEnum::EXTENDED->value)->count();
        $pending=BookLoan::whereStatus(BorrowingStatusEnum::PENDING->value)->count();
        $books=Book::count();
        $users=User::count();
        $pending_loans=BookLoanResource::collection(BookLoan::with(['user','book'])->where('status',BorrowingStatusEnum::PENDING->value)->limit(10)->get());
        return inertia::render('admin/index', compact(
            'loans','borrowed','pending_loans',
            'delayed','extended','books','users','pending'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
