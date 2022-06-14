<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('user_id', '=', Auth::id())->paginate(5);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_id = Auth::id();

        $this->validate($request, [
            'name'  => 'required|max:255|alpha_spaces',
        ]);

        Category::create([
            'name' => strtolower($request->name),
            'user_id' => $user_id,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('messages', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {

        $user_id = Auth::id();

        $this->validate($request, [
            'name'  => 'required|max:255|alpha_spaces',
        ]);

        if ($category->user_id != $user_id) {

            return redirect()
                ->route('categories.index')
                ->with('messages', 'You are not authorized to edit this category.');
        } else {
            $category->update([
                'name' => strtolower($request->name),
            ]);

            return redirect()
                ->route('categories.index')
                ->with('messages', 'Category updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {

        $user_id = Auth::id();

        if ($category->user_id != $user_id) {

            return redirect()
                ->route('categories.index')
                ->with('messages', 'You are not authorized to delete this category.');
        } else {

            $category->delete();

            return redirect()
                ->route('categories.index')
                ->with('messages', 'Category deleted successfully');
        }
    }
}
