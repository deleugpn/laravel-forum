<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} {{ trans('forum::forum.name') }}</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Navbar */
        .forum .navbar {
            margin-bottom: 0;
            border: none;
        }

        /* Jumbotron header */
        .forum .jumbotron {
            padding: 24px 0;
        }

        .forum .jumbotron h3 {
            margin: 20px 0;
        }

        /* Customize container */
        .forum .container-narrow > hr {
            margin: 30px 0;
        }

        /* Sidebar */
        .forum #sidebar {
            display: none;
        }

        @media (min-width: 768px) {
            .forum #sidebar {
                display: block;
            }
        }

        .forum #sidebar .list-group.list-group-root {
            padding: 0;
            overflow: hidden;
        }

        .forum #sidebar .list-group.list-group-root .list-group {
            margin-bottom: 0;
        }

        .forum #sidebar .list-group.list-group-root .list-group-item {
            border-radius: 0;
            border-width: 1px 0 0 0;
        }

        .forum #sidebar .list-group.list-group-root > .list-group-item:first-child {
            border-top-width: 0;
        }

        .forum #sidebar .list-group.list-group-root > .list-group > .list-group-item {
            padding-left: 30px;
        }

        .forum #sidebar .list-group.list-group-root > .list-group > .list-group > .list-group-item {
            padding-left: 45px;
        }

        .forum #sidebar a.btn-block {
            margin-bottom: 15px;
        }

        .forum #sidebar .list-group {
            margin-bottom: 0;
        }

        /* Content area */
        .forum #content .panel .panel-footer .pagination {
            margin: 0;
        }

        .forum #content .list-group .list-group-item p.meta {
            margin: 0;
        }

        .forum.discussions #content .panel-options:first-of-type {
            margin-right: 5px;
            display: inline-block;
        }

        .forum.discussions #content .panel-options {
            display: inline;
        }

        .forum.discussions #content .row.post .user {
            border-right: 1px solid #ddd;
        }

        @media screen and (min-width: 768px) {
            .forum.discussions #content .quick-reply .btn-success {
                width: 50%;
            }
        }
    </style>

    @yield('head')
</head>
<body class="{{ collect(request()->segments())->implode(' ') }}">
    @include('forum::partials.header')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3" id="sidebar">
                @include('forum::partials.sidebar')
            </div>

            <div class="col-xs-12 col-sm-9" id="content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    @yield('foot')
</body>
</html>
