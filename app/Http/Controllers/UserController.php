<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'cellphone' => 'required|string|max:255',
            'nif' => 'required|string|max:255|unique:users,nif,' . $user->id,
        ]);

        $user->update($request->all());
        return redirect()->route('profile', $user)->with('success', 'User updated successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $reviews = Review::where('user_id', $user->id)->get();
        $reviews->each->delete();

        $products = Product::where('seller', $user->id)->get();

        foreach ($products as $product) {
            $reviews = Review::where('product_id', $product->id)->get();
            $reviews->each->delete();
            $product->delete();
        }

        $user->delete();

        if (auth()->user()->id == $user->id) {

            auth()->logout();
            return redirect()->route('home');

        }

        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function profile(User $user)
    {
        return view('user.profile', ['user' => $user]);
    }
    
}
