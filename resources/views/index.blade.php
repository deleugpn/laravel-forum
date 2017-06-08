@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Discussions</div>
        <div class="panel-body"></div>

        @if ($discussions)
            <ul class="list-group">
                @each('partials.discussion', $discussions, 'discussion')
            </ul>
        @else
            No discussions to display.
        @endif
    </div>
@endsection
