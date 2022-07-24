@extends('layouts.modern')

@section('modern-sidebar')
@include('layouts.modern-sidebar')
@endsection

@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Account
    </h2>
    @if(Session::has('messages'))
    <div
        class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-teal-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
            </svg>
            <span>{{ Session::get('messages') }}</span>
        </div>
        <span>View more &RightArrow;</span>
    </div>
    @endif
    <form action="{{ route('accounts.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class=" px-4 py-3 mb-8 space-y-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Personal Info
            </h2>

            <div class="my-6">
                <div class="flex justify-start">
                    <div class="mb-3 w-96">
                        <label for="image" class="block mb-4 text-sm text-gray-700">
                            <span class="text-gray-700 dark:text-gray-400">Image</span>
                        </label>
                        <div class="flex flex-wrap justify-center">
                            @if ($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Picture"
                                class="img-preview w-1/2 h-auto rounded-full shadow-md">
                            @else
                            <img class="img-preview w-1/2  h-auto rounded-full shadow-md">
                            @endif
                        </div>
                        <button type="button" id="image-button" onclick="showInputImage()"
                            class=" text-white bg-blue-400 dark:bg-blue-500 font-medium rounded-lg text-sm mt-2 px-5 py-2.5 text-center">
                            Change Profile Picture
                        </button>
                        <div id="field-input" class="hidden">
                            <input
                                class="form-control block w-1/2 px-3 py-2 mt-1 text-base font-normal dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                type="file" id="image" name="image" onchange="previewImage()">
                        </div>
                        @error('image')
                        <p class="text-red-700 text-xs italic mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            </div>
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Username</span>
                <input
                    class="block w-1/2 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Your Name" name="name" value="{{ old('name') ?? $user->name }}" />
                @error('name')
                <p class="text-red-700 text-xs italic mt-2">
                    {{ $message }}
                </p>
                @enderror
            </label>
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Email</span>
                <input
                    class="block w-1/2 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Your email" name="email" value="{{ old('email') ?? $user->email }}" readonly />
                @error('email')
                <p class="text-red-700 text-xs italic mt-2">
                    {{ $message }}
                </p>
                @enderror
            </label>
            <button type="button"
                class="text-white bg-blue-400 dark:bg-blue-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                disabled>
                Change Password
            </button>
            <div class="flex flex-col flex-wrap mb-2 mt-2 space-y-2 md:flex-row md:items-end md:space-x-4">
                <a href="{{ route('accounts.index') }}">
                    <div
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg opacity-50 focus:outline-none">
                        Cancle
                    </div>
                </a>
                <div>
                    <button
                        class="submit px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        type="submit">
                        Update Profile
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

    // function show field input after click on button
    function showInputImage() {
        const fieldInput = document.querySelector('#field-input');
        const imageButton = document.querySelector('#image-button');
        fieldInput.classList.remove('hidden');
        imageButton.classList.add('hidden');;
    }
</script>