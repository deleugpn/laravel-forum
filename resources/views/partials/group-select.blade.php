<select name="{{ (config('forum.group_mode') != 'nested') ? 'group_id[]' : 'group_id' }}" id="group_id" class="form-control"{{ (config('forum.group_mode') != 'nested') ? ' multiple' : '' }}>
    <option selected disabled>-</option>

    @if (count($groups))
        @foreach($groups as $key => $group)
            <option value="{{ $group->id }}"{{ (old('group_id') == $group->id) ? ' selected' : '' }}>{{ $group->name }}</option>

            @if ($group->descendants->count())
                @foreach ($group->descendants as $descendant)
                    <option value="{{ $descendant->id }}"{{ (old('group_id') == $descendant->id) ? ' selected' : '' }}>{{ $descendant->name }}</option>
                @endforeach
            @endif
        @endforeach
    @endif
</select>
