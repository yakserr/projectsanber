@extends('layouts.modern')

@section('modern-sidebar')
@include('layouts.modern-sidebarMainmenu')
@endsection

@section('content')
<div class="container px-9 py-3 my-6 mx-auto grid bg-gray-50 dark:bg-gray-900">
    <div class="border-b-2 p-3 border-gray-300 dark:border-gray-700">
        <div class="flex justify-between">
            <h2 class="text-3xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $question->title }}
            </h2>
            @if ($question->user->id == Auth::id())
            <a href="{{ route('questions.edit', $question) }}">
                <button
                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    aria-label="Edit">
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                        </path>
                    </svg>
                </button>
            </a>
            @endif
        </div>
        <div class="flex space-x-6">
            <p class="text-sm text-gray-700 dark:text-gray-400">
                Asked :
                <span class="text-black dark:text-gray-200">
                    {{ $question->created_at->diffForHumans() }}
                </span>
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-400">
                By :
                <span class="text-blue-700">
                    {{ $question->user->name }}
                </span>
            </p>
        </div>
    </div>
    <div class="img mt-6 p-3 flex justify-center">
        @if($question->image)
        <img class=" max-w-64 max-h-64" src="{{ asset('storage/' . $question->image) }}" alt="image question">
        @endif
    </div>
    <div class="mt-3 p-3 text-black dark:text-gray-300">
        <p>
            {!! $question->body !!}
        </p>
        <div class="mt-9 flex justify-start">
            <div class="tag">
                <p
                    class="text-sm px-2 py-1 items-center bg-purple-600 rounded-full font-semibold text-gray-200 dark:text-gray-300">
                    {{ '#' . $question->category->name }}
                </p>
            </div>

        </div>
    </div>
    <div class="p-3">
        <label class="block mt-4 text-sm" for="body">
            <span class="text-gray-700 dark:text-gray-400">
                Your Answer
            </span>

            <div class="field-input dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700">
                <input id="body" type="hidden" name="body">
                <trix-editor input="body" class="@error('body') border-red-500 @enderror ">
                    {!! old('body') !!}
                </trix-editor>
            </div>
            @error('body')
            <p class="text-red-700 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror
        </label>
    </div>
    <div class="mt-3">
        <button
            class="submit px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            type="submit">
            Create Answer
        </button>
    </div>
    @endsection