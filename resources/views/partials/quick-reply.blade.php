<div class="panel panel-default">
    <form action="{{ route('forum.posts.store') }}" method="POST" class="quick-reply">
        {{ csrf_field() }}

        <div class="panel-body text-center">
            <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">

            <div class="form-group"{{ $errors->has('content') ? ' has-error' : '' }}>
                <textarea name="content" id="content" rows="3" placeholder="{{ trans('forum::forum.input_reply') }}" class="form-control"></textarea>

                @if ($errors->has('content'))
                    <span class="help-block">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="panel-footer text-center">
            <input type="submit" value="{{ trans('forum::forum.submit') }}" class="btn btn-success">
        </div>
    </form>
</div>
