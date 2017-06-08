@extend('master.app')


@section('content')
    <div class="jumbotron" style="background: {{ $group->color }}">
        <h1>{{ $group->name }}</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Discussions</div>

        <div class="panel-body">
            @if ($discussions)
                <ul class="list-group">
                    @each('partials.discussion', $discussions, 'discussion')
                </ul>
            @else
                No discussions to display.
            @endif
        </div>
    </div>
@endsection
