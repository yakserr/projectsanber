<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $questions = Question::with('category', 'user')->get();

        return view('mainmenu', [
            'categories' => $categories,
            'questions' => $questions
        ]);
    }
}
