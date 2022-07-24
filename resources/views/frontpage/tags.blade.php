@extends('layouts.modern')

@section('modern-sidebar')
@include('layouts.modern-sidebarMainmenu')
@endsection

@section('content')
<div class="container px-9 py-3 my-6 mx-auto grid bg-gray-50 dark:bg-gray-900">
    <div class="grid grid-cols-3 gap-4">
        @foreach ($categories as $category)
        <div class="p-6 max-w-xs bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800
            dark:border-gray-700 dark:hover:bg-gray-700">

            <a href="" class="p-2 rounded-md bg-blue-200 dark:bg-gray-700 hover:bg-gray-700">
                <span class="text-gray-900 dark:text-gray-300">{{ $category->name }}</span>
            </a>
            <p class="font-normal mt-4 mb-0 text-gray-700 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Architecto dicta quas esse.
            </p>
            @foreach ($totalquestions as $totalquestion)
            @if ($category->name == $totalquestion->name)
            <p class="flex mb-0 justify-end text-sm text-gray-700 dark:text-gray-400">{{ $totalquestion->total }}
                question
            </p>
            @endif
            @endforeach
        </div>
        @endforeach
    </div>
    @endsection
