@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('posts.store') }}" method="post">
                        <div class="form-group">
                            <textarea name="content" id="content" placeholder="Reply content here..." class="form-control"></textarea>
                        </div>

                        <button class="btn btn-success">Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
