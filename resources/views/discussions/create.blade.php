@extends('forum::layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('forum::forum.create_discussion') }}</div>

        <div class="panel-body">
            <form action="{{ route('forum.discussions.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                    <label for="group_id">{{ trans('forum::forum.groups_singular') }}</label>
                    @include('forum::partials.group-select')

                    @error('group_id')
                </div>

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">{{ trans('forum::forum.label_title') }}</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">

                    @error('title')
                </div>

                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content">{{ trans('forum::forum.label_content') }}</label>
                    <textarea name="content" id="content" class="form-control" rows="12">{{ old('content') }}</textarea>

                    @error('content')
                </div>

                <button class="btn btn-success">{{ trans('forum::forum.submit') }}</button>
            </form>
        </div>
    </div>
@endsection

@section('foot')
    @if (config('forum.group_mode') != 'nested')
        <script>
            $(document).ready(function () {
                var last_select = null;

                $('#group_id').on('change', function (e) {
                    if ($(this).val().length > {{ config('forum.discussion_group_limit') }}) {
                        $(this).val(last_select);
                    } else {
                        last_select = $(this).val();
                    }
                });
            });
        </script>
    @endif
@endsection
