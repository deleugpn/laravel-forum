@extends('forum::layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('forum::forum.edit_discussion') }}</div>

        <div class="panel-body">
            <form action="{{ route('forum.discussions.update', $discussion->id) }}" method="PUT">
                {{ csrf_field() }}

                <div class="form-group"{{ $errors->has('group_id') ? ' has-error' : '' }}>
                    <label for="group">{{ trans('forum::forum.group_singular') }}</label>
                    <select name="group" id="group" class="form-control">
                        @foreach ($groups as $group)
                                <option value="{{ $group->id }}"{{ (old('group_id') == $group->id) ? ' selected' : '' }}>{{ $group->name }}</option>
                        @endforeach
                    </select>

                    @error('group_id')
                </div>

                <div class="form-group"{{ $errors->has('title') ? ' has-error' : '' }}>
                    <label for="title">{{ trans('forum::forum.label_title') }}</label>
                    <input type="text" name="title" id="title" value="{{ $discussion->title }}" class="form-control">

                    @error('title')
                </div>

                <div class="form-group"{{ $errors->has('content') ? ' has-error' : '' }}>
                    <label for="content">{{ trans('forum::forum.label_content') }}</label>
                    <textarea name="content" id="content" class="form-control">{{ $discussion->post->content }}</textarea>

                    @error('content')
                </div>

                <button class="btn btn-success">{{ trans('forum::forum.save') }}</button>
            </form>
        </div>
    </div>
@endsection
