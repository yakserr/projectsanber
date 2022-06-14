@extends('layouts.modern')

@section('modern-sidebar')
@include('layouts.modern-sidebar')
@endsection

@section('content')
<div class="container px-6 mx-auto grid">
    <!-- Validation inputs -->
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Edit Categories
    </h2>
    <form action="{{ route('categories.update' , $category) }}" method="POST">
        @csrf

        @method('PUT')

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Name</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    name="name" value="{{ old('name') ?? $category->name }}" />
                @error('name')
                <p class="text-red-700 text-xs italic mt-2">
                    {{ $message }}
                </p>
                @enderror
            </label>
        </div>
        <div class="flex flex-col flex-wrap mb-4 space-y-2 md:flex-row md:items-end md:space-x-4">
            <a href="javascript:history.back()">
                <div
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg opacity-50 focus:outline-none">
                    Cancle
                </div>
            </a>
            <div>
                <button
                    class="submit px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    type="submit">
                    Save & Update
                </button>
            </div>
        </div>
    </form>
</div>
@endsection