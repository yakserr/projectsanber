<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('account.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $file = $request->hasFile('image');

        if ($file) {

            if ($user->image) {
                Storage::delete($user->image);
            }

            $this->validate($request, [
                'name'  =>  'required|string|max:255',
                'email' =>  'required|string|email|max:255|unique:users,email,' . $user->id,
                'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('image')->store('account');

            $user->update([
                'name'  =>  $request->name,
                'email' =>  $request->email,
                'image' =>  $image,
            ]);
        } else {
            $this->validate($request, [
                'name'  =>  'required|string|max:255',
                'email' =>  'required|string|email|max:255|unique:users,email,' . $user->id,
            ]);

            $user->update([
                'name'  =>  $request->name,
                'email' =>  $request->email,
            ]);
        }

        return redirect()->route('accounts.index')
            ->with('success', 'Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}
