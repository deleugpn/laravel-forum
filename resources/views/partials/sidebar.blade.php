<a href="{{ route('forum.discussions.create') }}" class="btn btn-success btn-block">{{ trans('forum::forum.new_discussion') }}</a>

<div class="list-group list-group-root well">
    @if (count($groups))
        @foreach($groups as $key => $group)
            <a href="{{ route('forum.groups.show', $group) }}" class="list-group-item">
                {{ $group->name }} <span class="badge" style="background: {{ $group->color }}">&nbsp;</span>
            </a>

            @if ($group->descendants->count())
                @foreach ($group->descendants as $descendant)
                    <div class="list-group">
                        <a href="{{ route('forum.groups.show', $descendant) }}" class="list-group-item">
                            {{ $descendant->name }} <span class="badge" style="background: {{ $descendant->color }}">&nbsp;</span>
                        </a>
                    </div>
                @endforeach
            @endif
        @endforeach
    @else
        <div class="list-group-item">
            No groups to display.
        </div>
    @endif
</div>
