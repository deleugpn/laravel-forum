@extends('forum::layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('forum::forum.edit_post') }}</div>

        <div class="panel-body">
            <form action="{{ route('posts.update', $post->id) }}" method="PUT">
                <div class="form-group"{{ $errors->has('content') ? ' has-error' : '' }}>
                    <label for="content">{{ trans('forum::forum.content') }}</label>
                    <textarea name="content" id="content" placeholder="{{ trans('forum::forum.input_reply') }}" class="form-control">{{ $post->content }}</textarea>

                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>

                <button class="btn btn-success">{{ trans('forum::forum.save') }}</button>
            </form>
        </div>
    </div>
@endsection
