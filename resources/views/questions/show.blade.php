@extends('layouts.modern')

@section('modern-sidebar')
@include('layouts.modern-sidebar')
@endsection

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Show Question
        </h2>
        <a href="{{ route('questions.edit', $question) }}">
            <button
                class="flex items-center justify-between px-2 py-2 ml-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                aria-label="Edit">
                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                    </path>
                </svg>
            </button>
        </a>
    </div>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Title</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Your Title" name="title" value="{{ $question->title }}" readonly />
        </label>


        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Category</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Your Title" name="title" value="{{ $question->category->name }}" readonly />
        </label>
        <div class="my-6">
            <div class="flex justify-start">
                <div class="mb-3 w-96">
                    @if($question->image)
                    <label for="image" class="block mb-4 text-sm text-gray-700">
                        <span class="text-gray-700 dark:text-gray-400">Image</span>
                    </label>
                    <img src="{{ asset('storage/' . $question->image) }}" alt="Image Question">
                    @else
                    <label for="image" class="block mb-4 text-sm text-gray-700">
                        <span class="text-gray-700 dark:text-gray-400">No Image</span>
                    </label>
                    @endif

                </div>
            </div>
        </div>
        <div>
            <label class="block mt-4 text-sm" for="body">
                <span class="text-gray-700 dark:text-gray-400">
                    Body
                </span>

                <div class="field-input dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700">
                    <input id="body" type="hidden" name="body">
                    <trix-editor input="body">
                        {!! $question->body !!}
                    </trix-editor>
                </div>
            </label>
        </div>
        <div class="flex flex-col flex-wrap mb-2 mt-2 space-y-2 md:flex-row md:items-end md:space-x-4">
            <a href="javascript:history.back()">
                <div
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg opacity-50 focus:outline-none">
                    Back
                </div>
            </a>
        </div>
    </div>
</div>
@endsection