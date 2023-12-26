<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BorrowingStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookLoanResource;
use App\Models\BookLoan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $statuses=BorrowingStatusEnum::cases();
        $loans=BookLoan::where('status','!=',BorrowingStatusEnum::RETURNED->value)->with(['user','book'])
            ->when(request('status'), function ($query){
                $query->where('status',request('status'));
            })
            ->when(request('search'), function ($query){
                $query->whereHas('book', function ($query){
                    $query->where('title','like','%'.request('search').'%');
                });
            })
            ->latest()->paginate(request('showing')??10);
        $loans=BookLoanResource::collection($loans);
        $filters=request()->only(['status','search','showing']);
        return inertia::render('admin/loans/index', compact('statuses','loans','filters'));
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

    public function approve(string $id){
        $loan=BookLoan::find($id);
        $loan->status=BorrowingStatusEnum::BORROWED->value;
        $loan->save();
        return redirect()->back()->with([
            'toast' => [
                'type' => 'success',
                'title' => 'Loan status updated'
            ]
        ]);
    }

    public function receive(string $id){
        $loan=BookLoan::find($id);
        $loan->status=BorrowingStatusEnum::RETURNED->value;
        $loan->save();
        return redirect()->back()->with([
            'toast' => [
                'type' => 'success',
                'title' => 'Loan status updated'
            ]
        ]);
    }
}
