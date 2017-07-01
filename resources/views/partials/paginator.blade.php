@if ($resource->hasPages())
    <div class="panel-footer">
        {{ $resource->appends(request()->except('page'))->links() }}
    </div>
@endif
