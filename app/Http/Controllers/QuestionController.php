<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $questions = Question::with('user', 'category')->where('user_id', Auth::id())->paginate(5);

        return view('questions.index', [
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('questions.create', ['categories' => $categories]);
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

        $fileImage = $request->hasFile('image');

        if ($fileImage) {

            // old ways
            // $image = $request->file('image')->store('question');

            // new ways

            $this->validate($request, [
                'title'     => "required",
                'category'  => "required|numeric",
                'body'      => "required",
                'image'     => "required|image|max:2048",
            ]);

            $image =    Storage::putFile('question', $request->file('image'));

            Question::create([
                'user_id'       => $user_id,
                'title'         => $request->title,
                'category_id'   => $request->category,
                'body'          => $request->body,
                'image'         => $image,
            ]);

            return redirect()->route('questions.index')
                ->with('messages', 'Question created successfully');
        } else {

            $this->validate($request, [
                'title'     => "required",
                'category'  => "required|numeric",
                'body'      => "required",
            ]);

            Question::create([
                'user_id'       => $user_id,
                'title'         => $request->title,
                'category_id'   => $request->category,
                'body'          => $request->body,
            ]);
        }

        return redirect()->route('questions.index')
            ->with('messages', 'Question created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {

        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $categories = Category::all();

        return view('questions.edit', ['question' => $question, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $user_id = Auth::id();

        if ($user_id != $question->user_id) {
            return redirect()->route('questions.index')
                ->with('messages', 'You are not authorized to edit this question');
        } else {

            $fileImage = $request->hasFile('image');

            if ($fileImage) {

                $this->validate($request, [
                    'title'     => "required",
                    'category'  => "required|numeric",
                    'body'      => "required",
                    'image'     => "required|image|max:2048",
                ]);

                Storage::delete($question->image);

                $image =    Storage::putFile('question', $request->file('image'));

                $question->update([
                    'user_id'       => $user_id,
                    'title'         => $request->title,
                    'category_id'   => $request->category,
                    'body'          => $request->body,
                    'image'         => $image,
                ]);

                return redirect()->route('questions.index')
                    ->with('messages', 'Question updated successfully');
            } else {

                $this->validate($request, [
                    'title'     => "required",
                    'category'  => "required|numeric",
                    'body'      => "required",
                ]);

                $question->update([
                    'user_id'       => $user_id,
                    'title'         => $request->title,
                    'category_id'   => $request->category,
                    'body'          => $request->body,
                ]);
            }

            return redirect()->route('questions.index')
                ->with('messages', 'Question updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {

        if ($question->image) {
            Storage::delete($question->image);
        }

        $question->delete();

        return redirect()
            ->route('questions.index')
            ->with('messages', 'Category deleted successfully');
    }
}
