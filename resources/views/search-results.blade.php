@extends('forum::layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('forum::forum.search_results') }}</div>

        <ul class="list-group">
            @if (count($discussions))
                @each('forum::partials.discussion', $discussions, 'discussion')
            @else
                <li class="list-group-item">
                    {{ trans('forum::forum.no_search_results') }}
                </li>
            @endif
        </ul>

        @include('forum::partials.paginator', ['resource' => $discussions])
    </div>
@endsection
