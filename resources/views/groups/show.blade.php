@extends('forum::layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('forum::forum.discussions_plural') }}</div>

        <ul class="list-group">
            @if (count($group->discussions))
                @each('forum::partials.discussion', $group->discussions, 'discussion')
            @else
                <li class="list-group-item">
                    {{ trans('forum::forum.no_discussions_group_notice') }}
                </li>
            @endif
        </ul>

        @include('forum::partials.paginator', ['resource' => $group->discussions])
    </div>
@endsection
