@extends('layouts.modern')

@section('modern-sidebar')
@include('layouts.modern-sidebar')
@endsection

@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Create New Question
    </h2>

    <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class=" px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Title</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Your Title" name="title" value="{{ old('title') }}" />
                @error('title')
                <p class="text-red-700 text-xs italic mt-2">
                    {{ $message }}
                </p>
                @enderror
            </label>


            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Category
                </span>
                <select
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    name="category">
                    <option selected>Choose One</option>
                    @foreach($categories as $key => $category)
                    <option {{ old('category')==($key+1) ? 'selected' : '' }} value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category')
                <p class="text-red-700 text-xs italic mt-2">
                    {{ $message }}
                </p>
                @enderror
            </label>
            <div class="my-6">
                <div class="flex justify-start">
                    <div class="mb-3 w-96">
                        <label for="image" class="block mb-4 text-sm text-gray-700">
                            <span class="text-gray-700 dark:text-gray-400">Image</span>
                        </label>
                        <div class="flex flex-wrap justify-center">
                            <img class="img-preview w-full h-auto rounded-md shadow-md">
                        </div>
                        <input
                            class="form-control block w-full px-3 py-2 mt-1 text-base font-normal dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            type="file" id="image" name="image" onchange="previewImage()">
                        @error('image')
                        <p class="text-red-700 text-xs italic mt-2">
                            {{ $message }}
                        </p>
                        @enderror
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
            <div class="flex flex-col flex-wrap mb-2 mt-2 space-y-2 md:flex-row md:items-end md:space-x-4">
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
                        Save & Create
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

<script>
    function previewImage() {
        
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }; 
    }
</script>