@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-9" id="sidebar">
            @include('partials.sidebar')
        </div>

        <div class="col-xs-12 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">Create Discussion</div>
                <div class="panel-body">
                    <form action="/" method="post">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title">
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content"></textarea>
                        </div>

                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
