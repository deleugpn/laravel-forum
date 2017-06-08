<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ sprintf('%s Forum', config('app.name')) }}</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    @yield('head')
</head>
<body>
    <div class="container">
        @include('partials.header')

        <div class="row">
            <div class="col-xs-12 col-sm-9" id="sidebar">
                @include('partials.sidebar')
            </div>

            <div class="col-xs-12 col-sm-3">
                @yield('content')
            </div>
        </div>

        @include('partials.footer')
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    @yield('foot')
</body>
</html>
