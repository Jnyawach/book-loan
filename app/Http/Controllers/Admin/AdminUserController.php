<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\SendUserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users=User::whereHas('roles',function ($query){
            $query->where('name',RoleEnum::USER->value);
        })
            ->when(request('search'),function ($query){
                $query->where('name','like','%'.request('search').'%')
                    ->orWhere('email','like','%'.request('search').'%');
            })
            ->paginate(request('showing')??10);
        $users=UserResource::collection($users);

        $filters=request()->only(['search','showing']);
        return inertia::render('admin/users/index', compact('users','filters'));
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
       $validated=$request->validate([
           'name'=>'required|max:50',
           'email'=>'required|email|unique:users',
       ]);

       DB::transaction(function () use ($validated){
           $temp_pass=Str::random(8);
           $user=User::create([
               'name'=>$validated['name'],
               'email'=>$validated['email'],
               'password'=>Hash::make($temp_pass),
           ]);
           $user->assignRole(RoleEnum::USER->value);
           $user->notify(new SendUserDetails($temp_pass));
       });

       return redirect()->back()->with([
           'toast'=>[
               'message' => 'User created successfully',
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
        $user=User::findOrFail($id);
        $validated=$request->validate([
            'name'=>'required|max:50',
            'email'=>'required|email|unique:users,email,'.$user->id,
        ]);
        $user->update([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
        ]);
        return redirect()->back()->with([
            'toast' => [
                'message' => 'User updated successfully',
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
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with([
            'toast' => [
                'message' => 'User deleted successfully',
                'type' => 'success'
            ]
        ]);
    }
}
