<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('frontpage/mainmenu', [
            'categories' => $categories,
            'questions' => $questions
        ]);
    }

    /**
     * Show detail question clicked by user
     *
     * @return \Illuminate\Http\Response
     */

    public function detailQuestion(Question $question)
    {
        $question = Question::with('category', 'user')->find($question->id);

        return view('frontpage/detailquestion', [
            'question' => $question
        ]);
    }

    /**
     * Show the tags and analitic of the tags
     *
     * @return \Illuminate\Http\Response
     */

    public function indexTags()
    {

        $categories = Category::all();

        $totalquestions = DB::table('categories as c')
            ->join('questions as q', 'c.id', '=', 'q.category_id')
            ->select('c.name as name', DB::raw('count(q.category_id) as total'))
            ->groupBy('c.name')->get();


        return view('frontpage/tags', [
            'categories' => $categories,
            'totalquestions' => $totalquestions
        ]);
    }
}
