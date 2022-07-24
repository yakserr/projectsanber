@extends('layouts.modern')

@section('modern-sidebar')
@include('layouts.modern-sidebarMainmenu')
@endsection

@section('content')
<div class="flex space-x-6 p-9 flex-none">
    <!--Mid Content Question-->
    <div class="right basis-4/5 space-y-3">
        <div class="flex justify-between header-content">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                All Question
            </h4>
            @auth
            <div>
                <a href="{{ route('questions.create') }}">
                    <button
                        class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Create Question
                    </button>
                </a>
            </div>
            @else
            <div>
                <a href="{{ route('login') }}">
                    <button
                        class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Login First to Create
                    </button>
                </a>
            </div>
            @endauth
        </div>
        <div class="total-question">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                {{ 'Total : ' . count($questions) . ' Questions' }}
            </h4>
        </div>
        {{-- Question --}}
        @foreach ($questions as $question)
        <a href="{{ route('detailquestion', $question->id) }}">
            <div class="min-w-0 p-3 my-3 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="grid grid-cols-8 gap-3">
                    <div class="details text-end space-y-3">
                        <div class="votes">
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                {{ count($question->comments) }}
                            </span>
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-300">Votes</span>
                        </div>
                        <div class="answer">
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                {{ count($question->comments) }}
                            </span>
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-300">Answer</span>
                        </div>
                    </div>
                    <div class="col-span-7">
                        <h4 class="font-semibold text-gray-600 dark:text-gray-300">
                            {{ $question->title }}
                        </h4>
                        <p class="truncate text-sm text-gray-600 dark:text-gray-400">
                            {!! strip_tags($question->body) !!}
                        </p>
                        <div class="footer-question flex justify-between pr-2">
                            <div class="tag">
                                <p
                                    class="text-xs px-2 py-1 items-center bg-purple-600 rounded-full font-semibold text-gray-600 dark:text-gray-300">
                                    {{ '#' . $question->category->name }}
                                </p>
                            </div>
                            <div class="content-detail flex text-xs space-x-1">
                                <div class="person text-blue-600 dark:text-blue-300">
                                    by {{ $question->user->name }}
                                </div>
                                <div class="time text-gray-600 dark:text-gray-300">
                                    asked {{ $question->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        @empty($question)
        <div class="min-w-0 p-3 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="grid grid-cols-5 gap-3">
                <div class="col-span-5">
                    <h4 class="font-semibold text-center text-gray-600 dark:text-gray-300">
                        No Question Found. Please Create One !
                    </h4>
                </div>
            </div>
        </div>
        @endempty
    </div>

    <!--Right last Activity-->
    <div class="right basis-1/5 mt-28 space-y-6">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="grid gird-rows-2 gap-4">
                <div class="filters start ">
                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                        Activity Comments
                    </h4>
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="">No</th>
                                        <th class="">Name</th>
                                    </tr>
                                </thead>
                                @foreach ($categories as $category)
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class=" text-sm">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="">
                                            <div class="flex items-center text-sm">
                                                <!-- Avatar with inset shadow -->
                                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                    <div>
                                                        <p class="font-semibold">{{ $category->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            @empty($category)
                            <div class="col-span-5">
                                <h4 class="text-sm font-semibold text-center text-gray-600 dark:text-gray-300">
                                    No Question Recently
                                </h4>
                            </div>
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
