<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="#csrf-token" name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
</head>
<body id="app">
    @include('layouts.partials.nav')

    <div class="container">

        @if (isset($currentView))
            <component is="{{ $currentView }}" inline-template>
        @endif

            @yield('content')

            @yield('modals')
        @if (isset($currentView))
            </component>
        @endif
    </div>


    <script src="/js/app.js"></script>
</body>
</html>
