@extends('forum::layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                {{ $discussion->title }}

                @can('manage', $discussion)
                    <div class="pull-right">
                        <form action="{{ route('forum.discussions.flag', $discussion) }}" method="POST" class="panel-options">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="is_locked" value="{{ empty($discussion->locked_at) }}">
                            <input type="submit" value="{{ $discussion->locked_at ? trans('forum::forum.unlock') : trans('forum::forum.lock') }}" class="btn btn-xs btn-{{ $discussion->locked_at ? 'danger' : 'success' }} pull-right">
                        </form>

                        <form action="{{ route('forum.discussions.flag', $discussion) }}" method="POST" class="panel-options">
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="is_stickied" value="{{ empty($discussion->stickied_at) }}">
                            <input type="submit" value="{{ $discussion->stickied_at ? trans('forum::forum.unsticky') : trans('forum::forum.sticky') }}" class="btn btn-xs btn-{{ $discussion->stickied_at ? 'danger' : 'success' }} pull-right">
                        </form>
                    </div>
                @endcan
            </div>
        </div>

        <table class="table table-bordered">
            @each('forum::partials.post', $discussion->posts, 'post')
        </table>

        @include('forum::partials.paginator', ['resource' => $discussion->posts])
    </div>

    @can('reply', $discussion)
        @include('forum::partials.quick-reply')
    @endcan
@endsection
