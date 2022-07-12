<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Think'able</title>

    <!---Template Windmill-->
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="{{ asset('js/charts-lines.js') }}" defer></script>

    <!--Css-->
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    <!--Trix Editor-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
    <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        @hasSection('modern-sidebar')
        @yield('modern-sidebar')
        @endif

        <div class="flex flex-col flex-1">
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                @include('layouts.modern-navigation')
            </header>
            <main class="h-full pb-16 overflow-y-auto">
                <!-- Remove everything INSIDE this div to a really blank page -->
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>